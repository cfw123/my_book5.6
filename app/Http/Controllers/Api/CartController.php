<?php

namespace App\Http\Controllers\Api;

use App\Models\Entity\CartItem;
use App\Models\Entity\Product;
use App\Models\M3Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //service addCart
    public function addCart(Request $request, $product_id)
    {
        $m3_result         = new M3Result;
        $m3_result->status = 200;
        $m3_result->msg    = '购物车添加成功';
        // 如果当前已经登录
        $member = $request->session()->get('member', '');
        if ($member != '') {
            $cart_items = CartItem::where('member_id', $member->id)->get();

            $exist = false;
            foreach ($cart_items as $cart_item) {
                if ($cart_item->product_id == $product_id) {
                    $cart_item->count++;
                    $cart_item->save();
                    $exist = true;
                    break;
                }
            }

            if ($exist == false) {
                $cart_item             = new CartItem;
                $cart_item->product_id = $product_id;
                $cart_item->count      = 1;
                $cart_item->member_id  = $member->id;
                $cart_item->save();
            }

            return $m3_result->toJson();
        }

        $bk_cart     = $request->cookie('bk_cart');
        $bk_cart_arr = ($bk_cart != null ? explode(',', $bk_cart) : array());

        $count = 1;
        foreach ($bk_cart_arr as &$value) {   // 一定要传引用
            $index = strpos($value, ':');
            if (substr($value, 0, $index) == $product_id) {
                $count = ((int)substr($value, $index + 1)) + 1;
                $value = $product_id . ':' . $count;
                break;
            }
        }

        if ($count == 1) {
            array_push($bk_cart_arr, $product_id . ':' . $count);
        }
        $m3_result->data = implode(',', $bk_cart_arr);
        return response($m3_result->toJson())->withCookie('bk_cart', implode(',', $bk_cart_arr));
    }


//view toCart
    public function toCart(Request $request)
    {
        $cart_items = array();

        $bk_cart     = $request->cookie('bk_cart');
        $bk_cart_arr = ($bk_cart != null ? explode(',', $bk_cart) : array());

        $member = $request->session()->get('member', '');
        if ($member != '') {
            $cart_items = $this->syncCart($member->id, $bk_cart_arr);
            return response()->view('cart', ['cart_items' => $cart_items])->withCookie('bk_cart', null);
        }

        foreach ($bk_cart_arr as $key => $value) {
            $index                 = strpos($value, ':');
            $cart_item             = new CartItem;
            $cart_item->id         = $key;
            $cart_item->product_id = substr($value, 0, $index);
            $cart_item->count      = (int)substr($value, $index + 1);
            $cart_item->product    = Product::find($cart_item->product_id);
            if ($cart_item->product != null) {
                array_push($cart_items, $cart_item);
            }
        }
        $m3_result         = new M3Result;
        $m3_result->status = 200;
        $m3_result->msg    = '购物车商品详情返回成功';
        $m3_result->data   = $cart_items;
        return $m3_result->toJson();
//        return view('cart')->with('cart_items', $cart_items);
    }



    public function deleteCart(Request $request)
    {
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->msg = '删除成功';


        $product_ids = $request->input('product_ids', '');
        if($product_ids == '') {
            $m3_result->status = 1;
            $m3_result->msg = '书籍ID为空';
            return $m3_result->toJson();
        }
        $product_ids_arr = explode(',', $product_ids);

        $member = $request->session()->get('member', '');
        if($member != '') {
            // 已登录
            CartItem::whereIn('product_id', $product_ids_arr)->delete();
            return $m3_result->toJson();
        }

        $product_ids = $request->input('product_ids', '');
        if($product_ids == '') {
            $m3_result->status = 1;
            $m3_result->msg = '书籍ID为空';
            return $m3_result->toJson();
        }

        // 未登录
        $bk_cart = $request->cookie('bk_cart');
        $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array());
        foreach ($bk_cart_arr as $key => $value) {
            $index = strpos($value, ':');
            $product_id = substr($value, 0, $index);
            // 存在, 删除
            if(in_array($product_id, $product_ids_arr)) {
                array_splice($bk_cart_arr, $key, 1);
                continue;
            }
        }
        $m3_result->bk_cart = implode(',', $bk_cart_arr);
        return response($m3_result->toJson())->withCookie('bk_cart', implode(',', $bk_cart_arr));
    }


    private function syncCart($member_id, $bk_cart_arr)
    {
        $cart_items = CartItem::where('member_id', $member_id)->get();

        $cart_items_arr = array();
        foreach ($bk_cart_arr as $value) {
            $index = strpos($value, ':');
            $product_id = substr($value, 0, $index);
            $count = (int) substr($value, $index+1);

            // 判断离线购物车中product_id 是否存在 数据库中
            $exist = false;
            foreach ($cart_items as $temp) {
                if($temp->product_id == $product_id) {
                    if($temp->count < $count) {
                        $temp->count = $count;
                        $temp->save();
                    }
                    $exist = true;
                    break;
                }
            }

            // 不存在则存储进来
            if($exist == false) {
                $cart_item = new CartItem;
                $cart_item->member_id = $member_id;
                $cart_item->product_id = $product_id;
                $cart_item->count = $count;
                $cart_item->save();
                $cart_item->product = Product::find($cart_item->product_id);
                array_push($cart_items_arr, $cart_item);
            }
        }

        // 为每个对象附加产品对象便于显示
        foreach ($cart_items as $cart_item) {
            $cart_item->product = Product::find($cart_item->product_id);
            array_push($cart_items_arr, $cart_item);
        }

        return $cart_items_arr;
    }
}


