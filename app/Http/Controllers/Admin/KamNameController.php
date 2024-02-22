<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KamName;

class KamNameController extends Controller
{
    // function for view
    public function index(){
     //return view('admin/dropdown-managment/kam-name/add-new');
    }

    //function for submit kam name
    public function submit_kam_name(Request $request){
        $kam_name = $request['kam_name'];
        //validation
        $request->validate([
            'kam_name' => 'required', 'string', 'max:255',
        ]);
        //check kam name is already exit or not
        $is_kam_name = KamName::where('kam_name',$kam_name)->exists();
        if($is_kam_name){
           return back()->with('unsuccess','Kam name is already exist!');
        } else {
        //insert query
        $create_kam_name = KamName::create([
            'kam_name' => $request['kam_name'],
        ]);
        //Check if new kam name is created
        if($create_kam_name) {
            return back()->with('success','New kam name Is Created Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
      }
    }

    //function for all kam name
    public function all_kam_name(){
        $all_records = KamName::orderBy('id','DESC')->get();
        return view('admin/dropdown-managment/kam-all-list',compact('all_records'));
    }

    //function foe delete kam name
    public function delete_kam_name($id){
        $delete_kam_name = KamName::where('id', $id)->delete();

        // check record is delete or not
        if($delete_kam_name) {
            return back()->with('success','Record delete Successfully.');
        } else {
            return back()->with('unsuccess','oops something went wrong!');
        }
    }
}
