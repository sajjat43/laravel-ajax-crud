<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function productBlade(){
return view('product.product');
    }

    public function productView(){
        $product=Product::all();
        return response()->json($product);
    }
    public function productStore(Request $request){
       
        $image_name = null;
        if ($request->hasfile('image')) {
            $image_name = date('Ymdhis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/product', $image_name);
        }
        $product=Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'Qty'=>$request->Qty,
            'price'=>$request->price,
            'image'=>$image_name,
            
        ]);

        return response()->json($product);
    }


    // edit----product--------

    public function editProduct($id){
      $data=Product::find($id);
      return response()->json($data);
    }

    public function updateProduct(Request $request,$id){
        $product=Product::find($id)->Update([
            'name'=>$request->name,
            'description'=>$request->description,
            'Qty'=>$request->Qty,
            'price'=>$request->price,
            // 'image'=>$request->image,
        ]);
        return response()->json($product); 
    }

    public function deleteProduct(Request $request,$id){

        $product =Product::find($id)->delete();
        return response()->json($product);
    }
}