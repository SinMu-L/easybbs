<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => ['required','string'],
            'password' => ['required','string']
        ],[
            'name' => '用户名错误',
            'password' => '密码错误',
        ],[
            "name" => "用户名",
            "password" => "密码"
        ]);

        if($validator->fails()){
            session()->flash('danger',$validator->errors()->first());
            return back();
        }


        $attemptLogin = Auth::attempt([
            'name' => $request->name,
            'password' => $request->password
        ]);


        if(!$attemptLogin){
            session()->flash('danger','用户名或密码错误');
            return redirect()->back();
        }

        return redirect('/')->with('success','登录成功');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', '退出成功！');
    }
}
