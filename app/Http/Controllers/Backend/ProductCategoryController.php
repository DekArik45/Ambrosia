<?php

namespace App\Http\Controllers\Backend;

use App\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $this->data['category'] = ProductCategory::get();;

        return view('backend.product_category', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (ProductCategory::where('category_name',$request->category)->exists()) {
            Alert::error('Error Message', 'Category Name Already Exist')->persistent("Close");
            return redirect('admin/product_category');
        }
        else{
            $category = new ProductCategory;
            $category->category_name = $request->category;
            $category->save();
            Alert::success('Success Message', 'Insert Success')->persistent("Close");
            return redirect('admin/product_category');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        if (ProductCategory::where('category_name',$request->category)->exists()) {
            Alert::error('Error', 'Category Name Already Exist')->persistent("Close");
            return redirect('admin/product_category');
        }
        else{
            ProductCategory::where('id',$productCategory->id)
            ->update([
                'category_name'=>$request->category,
            ]);
            Alert::success('Success', 'Data Updated')->persistent("Close");
            return redirect('/admin/product_category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        
        if (ProductCategory::where('id','=',$productCategory->id)->delete()) {
            Alert::success('Success', 'Data Deleted')->persistent("Close");
            return redirect('/admin/product_category');
        }
        else{
            Alert::error('Error Message', 'There is Products on this Category')->persistent("Close");
            return redirect('/admin/product_category');
        }
    }
}
