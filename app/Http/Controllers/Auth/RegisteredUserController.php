<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use App\Services\SmsService;

class RegisteredUserController extends Controller
{
    public function create(Request $request)
    {
        $request->session()->forget('count');
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:32'],
            'lastname' => ['required', 'string', 'max:32'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:8', Rules\Password::defaults()],
        ]);

        $request->session()->put('firstname', $request->firstname);
        $request->session()->put('lastname', $request->lastname);
        $request->session()->put('email', $request->email);
        $request->session()->put('password', $request->password);

        return view('auth.phone', ['messages' => []]);
    }

    public function store_phone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'max:32', 'unique:' . User::class],
        ]);

        if ($validator->fails()) {
            $fieldsWithErrorMessagesArray = $validator->messages()->get('*');
            return view('auth.phone', ['messages' => $fieldsWithErrorMessagesArray['phone']]);
        }

        $validated = $validator->safe()->only(['phone']);

        $request->session()->put('phone', $validated['phone']);

        //     $json = SmsService::callTo($validated['phone'], $_SERVER["REMOTE_ADDR"]);

        $code = rand(111111, 999999);
        $json = SmsService::sendTo($validated['phone'], 'Ваш код подтверждения ' .$code, false);


        if ($json) {
            if ($json->status == "OK") {
                 $request->session()->put('code', $code);
dump($code);
                return view('auth.code', ['count' => []]);
            } else {
                return view('auth.phone',  ['messages' => []])->with('error',  'У вас слишком много запросов. Попробуйте позже');
            }
        } else {
            return view('auth.phone', ['messages' => []])->with('error',  "Запрос не выполнился. Не удалось установить связь с сервером. ");
        }
    }

    public function store_code(Request $request)
    {
        if ($request->session()->has('count')) {
            $request->session()->decrement('count');
        } else {
            $request->session()->put('count', 3);
        }

        if ($request->session()->get('count') <= 0) {
            $request->session()->forget('count');
            return redirect()->route('register')->with('error', 'Количество попыток превышно. Попробуйте позже');
        } else {
            if ($request->code == $request->session()->get('code')) {
                
                $user = User::create([
                    'firstname' => $request->session()->get('firstname'),
                    'lastname' => $request->session()->get('lastname'),
                    'phone' => $request->session()->get('phone'),
                    'email' => $request->session()->get('email'),
                    'password' => Hash::make($request->session()->get('password')),
                ]);

                $request->session()->forget('firstname');
                $request->session()->forget('lastname');
                $request->session()->forget('phone');
                $request->session()->forget('email');
                $request->session()->forget('password');
                $request->session()->forget('code');
                $request->session()->forget('code_live');
                $request->session()->forget('count');

                event(new Registered($user));

                Auth::login($user);

                return redirect(RouteServiceProvider::HOME);
            } else {

                return view('auth.code', ['count' => $request->session()->get('count')]);
            }
        }
    }
}
