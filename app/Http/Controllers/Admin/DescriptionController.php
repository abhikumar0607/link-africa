<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Description;

class DescriptionController extends Controller
{
    //Function for show index view file
    public function index(){
        $view =  view('admin/descriptions/add-new');
        return $view;
    }
    
    //function for submit new record
    public function submit_description(Request $request){
		//validation rule
        request()->validate([
            'description' => 'required', 'string', 'max:1000',
        ]);
        $description = $request['description'];
      
        //Insert query
        $is_insert =  Description::create([
            'description' => $description,
           
        ]);
        //Check if data is inserted or not
        if($is_insert){
            return back()->with('success','Description Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }
}
