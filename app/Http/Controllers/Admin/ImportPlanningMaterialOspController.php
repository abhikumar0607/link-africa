<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Imports\ImportPlanningMaterialOsp; 
use Maatwebsite\Excel\Facades\Excel;

class ImportPlanningMaterialOspController extends Controller
{
     //function for view planning material file
     public function index(){
        $view =  view('admin/planning-master-files/import-material-osp-record');
        return $view;
    }

    //function for submit import records
    public function submit_import_records(Request $request){ 
        request()->validate([
            'import_file'=>'required|mimes:csv'
        ]); 
        
        if($request->file('import_file')){
            $insert = Excel::import(new ImportPlanningMaterialOsp,request()->file('import_file'));
               
            if($insert){
                return back()->with('success', 'Import Planning Material Osp CSV File Uploaded Successfully.');
            }  else {
                return back()->with('success', 'Oops Something Is Wrong');
            }
        } else {
            return back()->with('success', 'Please Select .csv File');
        }
    }
}
