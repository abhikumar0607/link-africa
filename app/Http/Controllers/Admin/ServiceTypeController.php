<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServiceType;

class ServiceTypeController extends Controller
{
    //Function for show index view file
    public function index(){
        $view =  view('admin/service-type/add-new');
        return $view;
    }
    
    //function for submit new record
    public function submit_service_type(Request $request){
		//validation rule
        request()->validate([
            'service_name' => 'required', 'string', 'max:255',
        ]);
        $service_name = $request['service_name'];
      //check service type is exist or not
      if (ServiceType::where('service_name', '=', $service_name)->exists()) {
        return back()->with('unsuccess','Service is already taken')->withInput($request->input());
      } else {
        //Insert query
        $is_insert =  ServiceType::create([
            'service_name' => $service_name,
        
        ]);
        //Check if data is inserted or not
        if($is_insert){
            return back()->with('success','New Service Type Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
        }
        
    }

    //public function for get fields according to service type
    public function get_service_type(Request $request){
        $service_type = $request->service_type;
        $detail = ServiceType::where('service_name',$service_type)->first();
        //check if service type exit
        $data = [
            'sla_group' => '', 
            'mttr_sla' => '', 
        ];

        if($detail){
            $data = [
                'sla_group' => $detail->sla_group,
                'mttr_sla' => $detail->mttr_sla,
            ];  
       } 
       return response()->json($data); 
   }

    //function for get mtr groups all list
    public function get_mttr_sla(Request $request){
        if ($request->selected_option === 'Bespoke') {
            // Fetch mttr_sla options from the database
            $mttrSlaOptions = ServiceType::where('sla_group','Bespoke')->get();
    
            $options = [];
            foreach ($mttrSlaOptions as $mttrSla) {
                $options[] = [
                    'text' => $mttrSla->mttr_sla // Assuming you have a 'name' column in your MttrSla model
                ];
            }
    
            // Return mttr_sla options as JSON response
            return response()->json(['options' => $options]);
        } elseif($request->selected_option === 'Standard'){
            $mttrSlaOptions = ServiceType::where('service_name',$request->service_type)->get();
                $options = [];
                foreach ($mttrSlaOptions as $mttrSla) {
                    $options[] = [
                        'text' => $mttrSla->mttr_sla // Assuming you have a 'name' column in your MttrSla model
                    ];
                }
        
                // Return mttr_sla options as JSON response
                return response()->json(['options' => $options]);
        } 
    
        // Return empty options if selected_option is not 'Bespoke'
        return response()->json(['options' => []]);
}
}