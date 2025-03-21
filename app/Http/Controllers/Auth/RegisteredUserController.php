<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\SmsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create(Request $request)
    {
        $request->session()->forget('count');
        $request->session()->forget('code');

        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:32'],
            'phone' => ['required', 'max:32', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), Rules\Password::min(6)],
        ]);

        $request->session()->put('firstname', $request->firstname);
        $request->session()->put('phone', $request->phone);
        $request->session()->put('password', $request->password);

        $code = mt_rand(1111, 9999);
        $message = `VSEARMYANE: $code. Никому не передавайте этот код`;

        $json = SmsService::sendTo($request->phone, $message, true);

        if ($json) {
            if ($json->status == "OK") {
                foreach ($json->sms as $phone => $data) {
                    if ($data->status == "OK") {
                        $request->session()->put('code', $code);
                        $request->session()->put('count', '3');
                        return view('auth.confirm', ['message' => [], 'count' => 3]);
                    } else {
                        Log::info("Сообщение на номер $phone не отправлено. ");
                        Log::info("Код ошибки: $data->status_code. ");
                        Log::info("Текст ошибки: $data->status_text. ");

                        return redirect()->route('register')->with('error',  "Сообщение не передано." . $data->status_text);
                    }
                }
            } else {
                Log::info("Код ошибки: $json->status_code. ");
                Log::info("Текст ошибки: $json->status_text. ");
                return redirect()->route('register')->with('error',  "Сообщение не передано. " . $json->status_text);
            }
        } else {
            return redirect()->route('register')->with('error',  "Запрос не выполнился. Не удалось установить связь с сервером. ");
        }
    }


    public function confirm(Request $request)
    {
        if ($request->session()->get('count') <= 1) {
            $request->session()->forget('count');
            $request->session()->forget('code');
            return redirect()->route('register')->with('error',  "Количество попыток превышено, попробуйте через 10 мин.");
        }

        if ($request->code == $request->session()->get('code')) {

            $user = User::create([
                'firstname' => $request->session()->get('firstname'),
                'phone' => $request->session()->get('phone'),
                'password' => Hash::make($request->session()->get('password')),
            ]);

            $request->session()->forget('count');
            $request->session()->forget('code');

            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        } else {

            if ($request->session()->has('count')) {
                $request->session()->decrement('count');
            } else {
                $request->session()->put('count', '3');
            }

            return view('auth.confirm', ['message' => 'Неверный код. Попробуйте еще раз.', 'count' => $request->session()->get('count')]);
        }
    }
}
