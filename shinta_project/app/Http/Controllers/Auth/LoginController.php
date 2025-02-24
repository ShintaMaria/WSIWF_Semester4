<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string', // VALIDASI KOLOM USERNAME
            'password' => 'required|string|min:6',
        ]);

        // CEK APAKAH INPUTAN USERNAME BERBENTUK EMAIL ATAU USERNAME
        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // CEK APAKAH KOLOM TERSEBUT ADA DI DATABASE
        if (!in_array($loginType, ['email', 'username'])) {
            return redirect()->route('login')->with('error', 'Format login tidak valid!');
        }

        $login = [
            $loginType => $request->username,
            'password' => $request->password
        ];

        // ATTEMPT LOGIN
        if (auth()->attempt($login)) {
            return redirect($this->redirectTo);
        }

        // JIKA SALAH, MAKA TAMPILKAN ERROR
        return redirect()->route('login')->with('error', 'Email/Password salah!');
    }

}
