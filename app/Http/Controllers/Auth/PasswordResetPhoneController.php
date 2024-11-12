<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class PasswordResetPhoneController extends Controller
{
    public function create(Request $request): View
    {
        $request->session()->forget('count');
        $request->session()->forget('code');

        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'max:32'],
        ]);

        $json = SmsService::callTo($request->phone, $_SERVER["REMOTE_ADDR"], true);

        if ($json) {
            if ($json->status == "OK") {

                $request->session()->put('phone', $request->phone);
                $request->session()->put('code', $json->code);
                $request->session()->put('count', '3');

                return view('auth.confirm-new-password', ['message' => [], 'count' => 3]);
            } else {
                return redirect()->route('register')->with('error',  "Звонок не может быть выполнен." . $json->status_text);
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
            return redirect()->route('password.request')->with('error',  "Количество попыток превышено, попробуйте через 10 мин.");
        }

        if ($request->code == $request->session()->get('code')) {

            $request->session()->forget('count');
            $request->session()->forget('code');

            $user = User::where('phone', $request->session()->get('phone'))->first();

            if (!$user) {
                return redirect()->route('password.request')->with('error',  "Что-то пошло не так, повторите попытку позже...");
            }

            $request->session()->forget('count');
            $request->session()->forget('code');

            Auth::login($user);
            
            return redirect()->route('new-password');
        } else {

            if ($request->session()->has('count')) {
                $request->session()->decrement('count');
            } else {
                $request->session()->put('count', '3');
            }

            return view('auth.confirm-new-password', ['message' => 'Неверный код. Попробуйте еще раз.', 'count' => $request->session()->get('count')]);
        }
    }

    public function newPassword(Request $request)
    {
        $request->session()->forget('count');
        $request->session()->forget('code');

        return view('auth.new-password');
    }

    public function newPasswordStore(Request $request)
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
