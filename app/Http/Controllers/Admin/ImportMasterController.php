<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Imports\ImportMasterFile; 
use Maatwebsite\Excel\Facades\Excel;

class ImportMasterController extends Controller
{
    //function for view site master file
    public function index(){
        $view =  view('admin/master-file/import-record-file');
        return $view;
    }
    
    //function for submit import records
    public function submit_import_records(Request $request){ 
        request()->validate([
            'import_file'=>'required|mimes:csv'
        ]); 
        
        if($request->file('import_file')){
            $insert = Excel::import(new ImportMasterFile,request()->file('import_file'));
               
            if($insert){
                return back()->with('success', 'Import Master CSV File Uploaded Successfully.');
            }  else {
                return back()->with('success', 'Opps Something Is Wrong');
            }
        } else {
            return back()->with('success', 'Please Select .csv File');
        }
    }
}
