<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Imports\ImportPermissionMasterFile; 
use Maatwebsite\Excel\Facades\Excel;

class ImportPermissionMasterController extends Controller
{
    //function for view permission master file
    public function index(){
        $view =  view('admin/permission-master-files/import-record-file');
        return $view;
    }
    
    //function for submit import records
    public function submit_import_records(Request $request){ 
        request()->validate([
            'import_file'=>'required|mimes:csv'
        ]); 
 
        if($request->file('import_file')){
            $insert = Excel::import(new ImportPermissionMasterFile,request()->file('import_file'));
               
            if($insert){
                return back()->with('success', 'Import Permission Master CSV File Uploaded Successfully.');
            }  else {
                return back()->with('success', 'Oops Something Is Wrong');
            }
        } else {
            return back()->with('success', 'Please Select .csv File');
        }
    }
}
