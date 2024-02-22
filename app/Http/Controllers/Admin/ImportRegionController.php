<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Imports\ImportRegions; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportRegionController extends Controller
{
    //function for view import region
    public function index(Request $request){
        return view('admin/site-master-files/import-region-file');
    }
 
    //function for import regions in data base
    public function submit_import_records(Request $request){
        request()->validate([
            'import_file'=>'required|mimes:csv'
        ]); 

        if($request->file('import_file')){
        $insert = Excel::import(new ImportRegions,$request->file('import_file'));
        if($insert){

            //echo "<pre></pre>"print_r($insert);exit;
                    return back()->with('success', 'Import regions file CSV File Uploaded Successfully.');
                    } else {
                        return back()->with('success', 'Oops Something Is Wrong');
                    }
                    } else {
                        return back()->with('success', 'Please Select .csv File');
                    }
}
}

