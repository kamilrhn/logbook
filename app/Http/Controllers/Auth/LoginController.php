<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    // Login
    public function showLoginForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image'];

        return view(
            'auth.login',
            [
                'pageConfigs' => $pageConfigs
            ]
        );
    }

    public function actionlogin(Request $request)
    {
        // dd($request);
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        // dd($data);
        if (Auth::Attempt($data)) {
            $request->session()->regenerate();
            return redirect('/beranda');
        }

        return back()->withErrors([
            'username' => 'Username atau Password Salah',
        ]);
    }

    public function actionlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
