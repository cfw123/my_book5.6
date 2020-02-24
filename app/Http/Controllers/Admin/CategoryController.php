<?php

namespace App\Http\Controllers\Admin;

use App\Models\Entity\Category;
use App\Models\M3Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            if($category->parent_id != null && $category->parent_id != '') {
                $category->parent = Category::find($category->parent_id);
            }
        }
        return view('admin.category.index',compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id','=','')->get();
        return view('admin.category.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name', '');
        $category_no = $request->input('category_no', '');
        $parent_id = $request->input('parent_id', '');
//        $preview = $request->input('preview', '');

        $category = new Category;
        $category->name = $name;
        $category->category_no = $category_no;
//        $category->preview = $preview;
        if($parent_id != '') {
            $category->parent_id = $parent_id;
        }
        $category->save();
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        return dump($id);

        $category = Category::find($id);
        $categories = Category::where('parent_id','0')->get();

        return view('admin.category.edit',compact(['category','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

//        return dump($request->all());
        $category = Category::find($id);


        $name = $request->input('name', '');
        $category_no = $request->input('category_no', '');
        $parent_id = $request->input('parent_id', '');
//        $preview = $request->input('preview', '');

        $category->name = $name;
        $category->category_no = $category_no;
        if($parent_id != '') {
            $category->parent_id = $parent_id;
        }
//        $category->preview = $preview;
        $category->save();

        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->msg = '添加成功';

        return $m3_result->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Category::find($id)->delete();

        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '删除成功';

        return $m3_result->toJson();
    }
}
