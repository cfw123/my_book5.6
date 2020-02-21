<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class LoginController extends Controller
{
    public function index()
    {
        echo 'user login';
    }

    public function login()
    {
        $username = Input::get('username','xxxx');
        $password = Input::get('password','333');

        dump(Input::all());
        dump(Input::only(['username','age']));
        dump(Input::has('age'));
        return  $username;
        echo "<hr>";
        return  'login';
    }

    public function login2(Request $request)
    {
        $usernmae = $request->get('username',null);
        $password = $request->get('password',null);

        dump($request->all());

        dump($request->only(['username']));

        dump($request->except(['username']));

        dump($request->has('sex'));

        //判断请求类型
        dump($request->isMethod('get'));


    }

    public function loginHandle(Request $request)
    {
        //判断请求类型
        if($request->isMethod('post'))
        {
            dump($request->all());
            return 'post';
        }
        $html = <<<EOL
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>test</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="" rel="stylesheet">
</head>
<body>
	<h3>haha...</h3>
	<form action="" method="post">
		<p>
			<input type="text" name="username" placeholder="username">
		</p>
		<p>
			<input type="text" name="password" placeholder="pwd">
		</p>
		<p>
			<input type="submit" value="login user">
		</p>
	</form>
    
</body>
</html>
EOL;
    return $html;
    }
}
