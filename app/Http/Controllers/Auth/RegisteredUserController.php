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
            'phone' => ['required', 'max:32', 'unique:' . User::class],
        ]);


        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        //$code = substr(str_shuffle($permitted_chars), 0, 8);
        $code = '12345678';

        $json = SmsService::sendTo($request->phone, 'Ваш пароль для входа (не передавайте ни кому) ' . $code, false);


        if ($json) {

            if ($json->status == "OK") {

                $user = User::create([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'password' => Hash::make($code),
                ]);

                event(new Registered($user));

                Auth::login($user);

                return redirect(RouteServiceProvider::HOME);

            } else {
                return redirect()->route('register')->with('error',  'У вас слишком много запросов. Попробуйте позже');
            }
        } else {
            return redirect()->route('register')->with('error',  "Запрос не выполнился. Не удалось установить связь с сервером. ");
        }
    }
}
