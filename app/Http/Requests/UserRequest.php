<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
//        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'              => 'required | between:2,6 ',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'email'                 => 'required|email',
        ];
    }

/*    public function messages()
    {
        return [
            //表单的字段名，规则名=>你想输出的话
            'username.required'              => '用户名 必填',
            'username.between'               => '用户名2-6个之间',
            'password.required'              => 'passord 必填',
            'password.confirmed'             => '两次密码不一致',
            'password_confirmation.required' => 'repassword 必填',
            'email.required'                 => '邮箱不能为空',
            'email.email'                    => '邮箱格式不正确',
        ];
    }*/
}
