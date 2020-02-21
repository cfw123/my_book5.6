<?php

function st($param){
    return 'http://www.edu.hd/'.$param;
}

//function returnJson($data = [], $code = '', $message = '')
//{
//    $result = [
//        'status' => $code,
//        'msg'     => $message,
//        'data'        => $data,
//    ];
//
//    //手动编码，避免dingo/api把空对象转成空数组
//    $result = json_encode($result, JSON_UNESCAPED_UNICODE);
//
//    return response()->json($result);
//}


