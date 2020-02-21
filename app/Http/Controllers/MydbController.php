<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use DB;

class MydbController extends Controller
{
    public function db()
    {
//        $sql = "insert into user(username,password,email) values(:username,:password,:email)";
//        $ret = DB::insert($sql,[':username'=>'admin',':password'=>'123',':email'=>'222@qq.com']);

//        $sql = "update user set username=:username where id=:id";
//        $ret = DB::update($sql,['username'=>'haha','id'=>1]);


//
//        $sql = "select * from  user where id=:id";
//        $ret = DB::selectOne($sql,['id'=>1]);

//        $sql = "select * from user";
//        $ret = DB::select($sql);

        $sql = "delete from user where id=:id";
        $ret = DB::delete($sql, ['id' => 1]);


        dump($ret);
    }

    public function db2(Request $request)
    {
//        $ret =  DB::table('user')->get();

//        $ret = DB::table('user')->get(['username']);

//        $kw = $request->get('kw','admin');
//        $ret = DB::table('user')->when($kw,function(Builder $query) use($kw){
//            $query->where('username','like',"%{$kw}%");
//        })->get();

//        $ret = DB::table('user')->where('id','>=',3)->pluck('username','id');


        $table = DB::table('user');
//        $ret = $table->insert([
//            'username'=>'user4',
//            'password'=>'user4',
//            'email'=>'1112@11.com'
//        ]);

        $data = [];
        for ($i = 5; $i <= 10; $i++):
            $data[] = [
                'username' => 'user' . $i,
                'password' => 'user' . $i,
                'email'    => '1112@11.com' . $i,
            ];
        endfor;
//        dump($data) ;
        $ret = $table->insert($data);
        dump($ret);

    }

    public function db3()
    {
//       return  Article::where('id',2)->get();

        /*     $data =[
                 'uid'=>"2",
                 'title'=>'hahahaha111',
                 'cnt'=>'hahahaha11'
             ];

            return  Article::create($data);*/

//        $ret = Article::where('id', 1)->first();

//        $ret = Article::where('id','>',7)->orWhere('id','<','3')->get();


//        $ret = Article::count();
//        $ret = Article::offset(2)->limit(2)->get();


//        $model        = Article::find(2);
//        $model->title = '2222';
//        $ret = $model->save();


//        $data=['cnt'=>'cnt2444'];
//        $ret = Article::where('id',4)->update($data);

//        $id = 2;
//        $ret=Article::destroy($id);

//        $ret = Article::get()->toArray();

//        $ret = Article::onlyTrashed()->get()->toArray();

        #恢复id为2的记录
        $model=Article::onlyTrashed()->where('id',2)->first();
//        $model->restore();
        dump($model->restore());

    }
}
