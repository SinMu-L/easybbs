<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    protected $stopOnFirstFailure = true;

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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'name';
    }

        /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // dd($request->all());

        // 接收传递过来的用户名和密码
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','between:3,20'],
            'password' => ['required','string'],
        ],[
            'name.required' => '必填项',
            'name.string' => '必须是个字符串',
            'name.between' => '长度必须大于3小于20',
            'password.required' => '必填项',
            'password.string' => '必须是个字符串',
        ]);

        if ($validator->fails()) {
            // 返回登录页面，并添加 闪存
            session()->flash('danger',$validator->errors()->first());
            return redirect()->route('login');
        }


        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // 返回登录页面，并添加 闪存
        session()->flash('danger','登录失败，请检查用户名和密码');
        return redirect()->route('login');

    }
}
