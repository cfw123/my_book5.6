<?php

namespace App\Models;

//class M3Result {
//
//    public $status;
//    public $message;
//
//    public function toJson()
//    {
//        return json_encode($this, JSON_UNESCAPED_UNICODE);
//    }
//
//}

class M3Result {

//    public $data = [];
    public $status;
    public $msg;

    public function toJson()
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
//        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
//        return response()->json($this)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

}