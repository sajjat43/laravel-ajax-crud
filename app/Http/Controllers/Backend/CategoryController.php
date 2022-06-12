<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function list()
    {
        return view('ajax');
    }
    public function get()
    {
        $data=Category::all();
        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>'Category loaded successful.'
        ]);
    }
    public function categoryCreate(Request $request){
        
        $image_Cname = null;
        if ($request->hasfile('Cimage')) {
            $image_Cname = date('Ymdhis') . '.' . $request->file('Cimage')->getClientOriginalExtension();
            $request->file('Cimage')->storeAs('/uploads/category', $image_Cname);
        }
        $category=Category::create([
            'Cname'=>$request->Cname,
            'Cdescription'=>$request->Cdescription,
            'Cimage'=>$request->Cimage,
        ]);

        return response()->json([
            'success'=>true,
            'data'=>$category,
            'message'=>'Category created successful.'
        ]);

    }
    
}
