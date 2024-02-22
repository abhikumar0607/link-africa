<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
   //function for view product page
   public function index(){
    return view('admin/product/add-new');  
   }
   
   //function for add product 
   public function add_product(Request $request){
     
    $name = $request['name'];
    $description = $request['description'];
     $add_product = Product::create([
    'name' => $name ,
    'description' => $description,
     ]);  
    
      //Check if data is updated or not
        if($add_product){
            return back()->with('success','Record added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }

   }
}
