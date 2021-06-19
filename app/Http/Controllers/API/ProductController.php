<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all('id','product_name','brand','price','quantity','alert_stock','description');
        return response()->json(['products'=>$products],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validator::make(inputs,rules,error);
        $validate = Validator::make($request->all(),[
            'product_name'=>'required',
            'description'=>'required',
            'brand'=>'required',
            'price'=>'required',
            'qty'=>'required',
            'stock'=>'required',

        ],$messages = [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validate->fails()) {
            return response()->json(['msg'=>$validate->errors()],200);

        }else {
            $products = Product::create([
                'product_name'=>$request->product_name,
                'description'=>$request->description,
                'brand'=>$request->brand,
                'photo'=>null,
                'price'=>$request->price,
                'quantity'=>$request->qty,
                'alert_stock'=>$request->stock,
            ]);

            return response()->json(['createdData'=>$products,'msg'=>'Data Created Successfully!'],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($id);
        return response()->json($products,200);
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
        $products = Product::findOrFail($id);
        $products->update([
            'product_name'=>$request->name,
            'description'=>$request->detail,
            'brand'=>$request->brand,
            'photo'=>null,
            'price'=>$request->price,
            'quantity'=>$request->qty,
            'alert_stock'=>$request->stock,
        ]);
        return response()->json(['msg'=>'Updated Success'],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();
        return response()->json(['deletedProducts'=>$products,'msg'=>'Delete Success'],200);
    }
}
