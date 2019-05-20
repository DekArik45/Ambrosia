<?php

namespace App\Http\Controllers\Backend;

use App\Product;
use App\ProductCategory;
use App\ProductCategoryDetail;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Discount;
use Alert;
use DB;
use File;
use Carbon\Carbon;
class ProductController extends Controller
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
        $this->data['product'] = Product::get();
        $this->data['product_category'] = Product::join('product_category_details','product_category_details.product_id','products.id')
        ->join('product_categories','product_categories.id','product_category_details.category_id')
        ->select('product_categories.category_name','product_category_details.*')
        ->get();

        $this->data['category'] = ProductCategory::select('id','category_name')
        ->get();

        $this->data['product_image'] = ProductImage::get();
        // return $this->data['product_image'];
        return view('backend.product', $this->data);
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

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->weight = $request->weight;
        $product->save();

        $get_id_product = Product::select('id')
        ->orderBy('id','DESC')
        ->first();
        foreach ($request->category_name as $category) {
            $product_category_detail = new ProductCategoryDetail;
            $product_category_detail->product_id = $get_id_product->id;
            $product_category_detail->category_id = $category;
            $product_category_detail->save();
        }
        if($request->hasfile('image'))
        {
            $current_timestamp = Carbon::now()->timestamp;
            $i = 1;
            foreach($request->file('image') as $file)
            {
                
                    $name=$file->getClientOriginalName();
                    $path = 'files/'. $name;
                    if(File::exists($path)) {
                        $name = $current_timestamp.$file->getClientOriginalName();
                        $path = 'files/'. $name;
                    }
                    
                    $file->move(public_path().'/files/', $name);

                    $image = new ProductImage;
                    $image->product_id = $get_id_product->id;
                    $image->image_name=$path;
                    $image->save();
                $i++;    
            }
            
        }
        
        
        // return $data;
        Alert::success('Success Message', 'Insert Success')->persistent("Close");
        return redirect('/admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        Product::where('id',$product->id)
            ->update([
                'product_name'=>$request->product_name,
                'price'=>$request->price,
                'description'=>$request->description,
                'stock'=>$request->stock,
                'weight'=>$request->weight,

            ]);

            Alert::success('Success', 'Data Updated')->persistent("Close");
            return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        
        $image = ProductImage::where('product_id',$product->id)->get();
        foreach ($image as $key) {
            if(File::exists($key->image_name)) {
                File::delete($key->image_name);
                ProductImage::find($key->id)->delete();
            }
        }
        ProductCategoryDetail::where('product_id',$product->id)->delete();
        Discount::where('id_product',$product->id)->delete();
        Product::find($product->id)->delete();

        Alert::success('Success Message', 'Delete Success')->persistent("Close");
        return redirect('/admin/product');
    }

    public function deleteImage($id)
    {
        
        $image = ProductImage::where('id',$id)->first();
        
        if(File::exists($image->image_name)) {
            File::delete($image->image_name);
            ProductImage::find($id)->delete();
        }
        
        Alert::success('Success Message', 'Delete Success')->persistent("Close");
        return redirect('/admin/product');
    }

    public function deleteCategory($id)
    {
        ProductCategoryDetail::find($id)->delete();

        Alert::success('Success Message', 'Delete Success')->persistent("Close");
        return redirect('/admin/product');
    }

    public function inputImage($id, Request $request)
    {
        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasfile('image'))
        {
            $i = 1;
            foreach($request->file('image') as $file)
            {
                // if (($file->getSize() / 1000) <= 1024) {
                    $name=$file->getClientOriginalName();
                    $path = 'files/'. $name;
                    
                    if(File::exists($path)) {
                        $name = $current_timestamp.$file->getClientOriginalName();
                        $path = 'files/'. $name;
                    }

                    $file->move(public_path().'/files/', $name);
                    $image = new ProductImage;
                    $image->product_id = $id;
                    $image->image_name=$path;
                    $image->save();
                    $i++;
                // }   
            }
            
        }

        Alert::success('Success Message', 'Insert Success')->persistent("Close");
        return redirect('/admin/product');
    }

    public function inputCategory($id, Request $request)
    {
        foreach ($request->category_name as $category) {
            $data = ProductCategory::join('product_category_details','product_category_details.category_id','product_categories.id')
            ->where('product_category_details.product_id',$id)->get();

            foreach ($data as $item) {
                if ($category == $item->category_id) {
                    Alert::error('Error Message', 'Product already have '.$item->category_name.' category')->persistent("Close");
                    return redirect('/admin/product');
                }
            }

            $product_category_detail = new ProductCategoryDetail;
            $product_category_detail->product_id = $id;
            $product_category_detail->category_id = $category;
            $product_category_detail->save();
        }
        Alert::success('Success Message', 'Insert Success')->persistent("Close");
        return redirect('/admin/product');
    }
}
