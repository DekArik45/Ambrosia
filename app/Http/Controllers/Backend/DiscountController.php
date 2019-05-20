<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
use App\Discount;
use App\Product;

class DiscountController extends Controller
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
        $this->data['discount'] = Discount::join('products','products.id','discounts.id_product')
        ->select('discounts.*','products.product_name')
        ->where('discounts.status','1')
        ->get();
        $this->data['product'] = Product::get();

        return view('backend.discount', $this->data);
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
        foreach ($request->product_name as $item) {

            Discount::where('id_product',$item)
            ->update([
                'status' => '0',
            ]);

            $discount = new Discount;
            $discount->id_product = $item;
            $discount->percentage = $request->percentage;
            $discount->start = $request->start;
            $discount->end = $request->end;
            $discount->status = '1';
            $discount->save();
        }
        Alert::success('Success Message', 'Insert Success')->persistent("Close");
        return redirect('/admin/discount');
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
        //
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
        Discount::where('id',$id)
            ->update([
                'id_product'=>$request->product_name,
                'percentage'=>$request->percentage,
                'start'=>$request->start,
                'end'=>$request->end,
            ]);

            Alert::success('Success', 'Data Updated')->persistent("Close");
            return redirect('/admin/discount');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Discount::find($id)->delete();
        Alert::success('Success', 'Data Deleted')->persistent("Close");
        return redirect('/admin/discount');
    }
}
