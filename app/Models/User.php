<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authorization;
use Hash;

class User extends Authorization
{
    protected $rememberTokenName = '';

    protected $guarded = [];
    public function login(array $data)
    {
        $info = self::where('username',$data['username'])->first();
        if(!$info){
            return  false;
        }

       if(!Hash::check($data['password'],$info['password'])){
            return false;
        }

        session(['admin.user'=>$info]);
       return true;
    }
}
