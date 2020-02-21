<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        // 如果用户已经登录则直接跳转到后台首页
        if(auth()->check()){
            return redirect(route('admin.index'));
        }

        return view('admin.login.index');
    }

    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->only(['username', 'password'],$request->input('remember_me')))) {
            // 登录成功
            return redirect()->route('admin.index')->with('msg','登录成功');
        }
        return redirect()->back()->withErrors(['errors' => '登录不合法']);
    }

}
