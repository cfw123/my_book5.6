<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;

class MyCacheController extends Controller
{
    public function index()
    {

        dump(Cache::add('name','张三',10));
//        dump(Cache::put('age',18,10));
//
//        dump(cache()->has('age'));
//        dump(cache()->has('id'));

//        $ret = cache('name');
//        $ret = Cache::get('age');

//        $ret = Cache::get('id',1);

//        $ret = Cache::get('id',function(){
//            return 2222;
//        });
//
//        $ret = cache()->get('id',function(){
//            return 2233322;
//        });

//        $ret = Cache::remember('user',10,function(){
//            $ret = \DB::table('users')->where('id',1)->first();
//            return $ret;
//        });

        Cache::forever('id',1000);
        dump(cache('id'));
        dump(Cache::forget('age'));
//        dump($ret);
        return 'index';
    }
}
