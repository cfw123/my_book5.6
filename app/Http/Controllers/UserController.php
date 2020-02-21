<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    //添加用户的处理

    public function addSave(UserRequest $request)
    {
//        $this->validate($request, [
//            'username'              => 'required | between:2,6 ',
//            'password'              => 'required|confirmed',
//            'password_confirmation' => 'required',
//            'email'                 => 'required|email',
//        ], [
//            //表单的字段名，规则名=>你想输出的话
//            'username.required'              => 'username 必填',
//            'username.between'               => '用户名2-6个之间',
//            'password.required'              => 'passord 必填',
//            'password.confirmed'             => '两次密码不一致',
//            'password_confirmation.required' => 'repassword 必填',
//            'email.required'                 => '邮箱不能为空',
//            'email.email'                    => '邮箱格式不正确',
//        ]);
        dump($request->all());
    }
}
