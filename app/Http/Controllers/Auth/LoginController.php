<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request; // ★ 追加
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use SebastianBergmann\Environment\Console;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'withdraw');

    }

    // ★ メソッド追加
    protected function authenticated(Request $request, $user)
    {
        return $user;
    }

    protected function loggedOut(Request $request)
    {
        // セッションを再生成する
        $request->session()->regenerate();

        return response()->json();
    }

    public function withdraw(Request $request)
    {
        $request->session()->regenerate();
        
        $user = User::find($this->guard()->user()->id);
        $user->delete();
        Auth::logout();
        return redirect('/');
    }
    
}
