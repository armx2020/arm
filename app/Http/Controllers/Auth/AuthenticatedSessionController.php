<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create(Request $request)
    {
        $request->session()->forget('count');
        return view('auth.login');
    }

    public function confirm_phone(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::once($credentials)) {
            $request->session()->put('email', $request->email);
            $request->session()->put('password', $request->password);
            $request->session()->put('remember', $request->remember);

            // sms.ru 
            // $ch = curl_init("https://sms.ru/code/call");
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            //     "phone" => Auth::user()->phone, // номер телефона пользователя
            //     "ip" => $_SERVER["REMOTE_ADDR"],
            //     // "ip" =>  '2.95.19.255',
            //     "api_id" => "AF091A73-77E1-9945-9455-280D8014D741"
            // )));

            // $body = curl_exec($ch);
            // curl_close($ch);

         //   $json = json_decode($body);
                    $json = (object) array('status' => 'OK', 'code' => 0000);
            if ($json) {
                if ($json->status == "OK") {
                    $request->session()->put('code', $json->code);
                    $request->session()->put('code_live', $json->code);

                    return view('auth.confirm-code', ['count' => []]);
                } else {
                    return redirect()->route('login')->with('error',  'У вас слишком много запросов. Попробуйте позже');
                }
            } else {
                return redirect()->route('login')->with('error',  "Запрос не выполнился. Не удалось установить связь с сервером. ");
            }
        } else {
        return redirect()->route('login')->with('error', 'Неверные данные для входа');
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has('count')) {
            $request->session()->decrement('count');
        } else {
            $request->session()->put('count', 3);
        }



        if ($request->session()->get('count') <= 0) {
            $request->session()->forget('count');
            return redirect()->route('login')->with('error', 'Количество попыток превышно. Попробуйте позже');
        } else {
            if ($request->code == $request->session()->get('code')) {
                if (Auth::attempt([
                    'email'    => $request->session()->get('email'),
                    'password' => $request->session()->get('password'),
                ], $request->session()->get('remember'))) {
                    $request->session()->forget('phone');
                    $request->session()->forget('email');
                    $request->session()->forget('password');
                    $request->session()->forget('code_live');
                    $request->session()->forget('code');
                    $request->session()->forget('count');

                    $request->session()->regenerate();

                    return redirect()->intended('dashboard');
                } else {
                    return redirect()->route('login')->with('error', 'Неверные данные для входа');
                }
            } else {
                return view('auth.confirm-code',  ['count' => $request->session()->get('count')]);
            }
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
