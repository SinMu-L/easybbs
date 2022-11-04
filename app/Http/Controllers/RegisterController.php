<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => ['required','string','between:4,20','unique:users,name'],
            'password' => ['required','string','between:6,100']
        ],[],[
            "name" => "用户名",
            "password" => "密码"
        ]);



        if($validator->fails()){
            session()->flash('errors',$validator->errors());
            return redirect('register');
        }

        $user = User::create([
            'name' => htmlspecialchars($request->name),
            'email' => '',
            'password' => bcrypt(trim(htmlspecialchars($request->password))),
        ]);

        Auth::login($user);

        return redirect('/')->with('success','注册成功');
    }


}
