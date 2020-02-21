<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategorychResCollection;
use App\Http\Resources\CategoryResourceCollection;
use App\Http\Resources\PdtContentRes;
use App\Http\Resources\PdtContentResCollection;
use App\Http\Resources\ProductResCollection;
use App\Models\Entity\CartItem;
use App\Models\Entity\Category;
use App\Models\Entity\PdtContent;
use App\Models\Entity\PdtImages;
use App\Models\Entity\Product;
use App\Models\M3Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class BookController extends Controller
{
    //
    public function toCategory()
    {
        Log::info("进入书籍类别");
        $data = Category::where('parent_id', 0)->get();
        return new CategoryResourceCollection($data);
    }


    public function getCategoryByParentId($parent_id)
    {

        $data = Category::where('parent_id', $parent_id)->get();
        return new CategorychResCollection($data);

    }

    public function toProduct($category_id)
    {
        Log::info("进入商品列表");
        $data = Product::where('category_id', $category_id)->get();
        return new ProductResCollection($data);
    }

    public function toPdtContent(Request $request, $product_id)
    {
        Log::info("进入商品详情");
        $product     = Product::find($product_id);
//        $pdt_content     = $product->pdtcont;
//        $pdt_images = $product->pdtimages;
        $pdt_content = PdtContent::where('product_id', $product_id)->first();
        $pdt_images  = PdtImages::where('product_id', $product_id)->get();

        $count = 0;

        $member = $request->session()->get('member', '');
        if ($member != '') {
            $cart_items = CartItem::where('member_id', $member->id)->get();
            foreach ($cart_items as $cart_item) {
                if ($cart_item->product_id == $product_id) {
                    $count = $cart_item->count;
                    break;
                }
            }
        } else {
            $bk_cart     = $request->cookie('bk_cart');
            $bk_cart_arr = ($bk_cart != null ? explode(',', $bk_cart) : array());

            foreach ($bk_cart_arr as $value) {   // 一定要传引用
                $index = strpos($value, ':');
                if (substr($value, 0, $index) == $product_id) {
                    $count = (int)substr($value, $index + 1);
                    break;
                }
            }
        }
        $data['product']=$product;
        $data['pdt_content']=$pdt_content;




        $data['pdt_images'] = $pdt_images;
        $data['count'] = $count;
        $ReturnJson = new M3Result;
        $ReturnJson->data=$data;
        $ReturnJson->status=200;
        $ReturnJson->msg='获取商品详情成功';
    return  $ReturnJson->toJson();
    }
}



;