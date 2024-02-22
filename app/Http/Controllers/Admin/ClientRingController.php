<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ClientRing;

class ClientRingController extends Controller
{
    public function index(){
        $view = view('admin/service-type/add-client-ring');
        return $view;
    }

    public function submit_service_type(Request $request){
        $client_ring = $request['client_ring'];
         //Insert query
         $is_insert =  ClientRing::create([
            'client_ring' => $client_ring,
        
        ]);
        //Check if data is inserted or not
        if($is_insert){
            return back()->with('success','New client ring Added Successfully');
        } else {
            return back()->with('unsuccess','Opps Something wrong!');
        }
    }

    public function get_client_ring(Request $request){
        $client_ring = $request['client_ring'];
        //echo $client_ring;exit;
        $record = ClientRing::where('client_ring','LIKE', $client_ring.'%')->get()->toArray();

        foreach($record as $result){   ?>
         <div class="dsign-client-ring" data-attr="<?php echo $result['client_ring'];?>">
        <?php echo $result['client_ring'];?>
        </div>

       <?php }

       // echo "<pre>"; print_r($record); echo "</pre>";exit;
    }
}
