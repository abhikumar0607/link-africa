<?php
namespace App\Http\Controllers\Support;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\Attachment;
use App\Models\User;
use Carbon\Carbon;
use App\Models\TicketAttachment;
use App\Models\Assest;
use App\Models\HardwareSoftware;
use Illuminate\Support\Facades\Crypt;
use App\Exports\TicketExport;
use Excel;


class HomeController extends Controller
{
    public function index(){
        $records = SupportTicket::groupBy('ticket_id')->where('status',0)->orderBY('id','DESC')->paginate(10);

        $records_closed = SupportTicket::groupBy('ticket_id')->where('status',1)->orderBY('id','DESC')->paginate(10);
        
        //echo "<pre>"; print_r($records); exit;
        return view('support-dashboard/dashboard', compact('records','records_closed'));


        
    }
    // function for close ticket
    public function close_ticket($id){
        $isUpdated = SupportTicket::where('ticket_id', $id)->update([
            'status' => 1,
            'ticket_closed_date' => Carbon::now(),
            ]);
        if($isUpdated){
            return back()->with('close_success','Ticket Closed Successfully');
        } else {
            return back()->with('close_unsuccess','Opps Something wrong!');
        }
    }
    //function for export ticket
    public function export_ticket() {
        return Excel::download(new TicketExport, 'tickets.xlsx');
    }
     public function ticket($id){
        $ticket_id = Crypt::decryptString($id);
        $records = SupportTicket::where('ticket_id', $ticket_id)->with('ticket_attachment_relation','user_name')->get()->toArray();
        $users = User::all()->toArray();
        //echo "<pre>"; print_r($records); exit;
        //$ticket_id = $id;
        return view('support-dashboard/ticket',compact('records','users'));
    }


    public function chat_logs(){
        return view('support-dashboard/chat-logs');
    }

     public function ticket_list(){
        return view('support-dashboard/ticket-list');
    }

    //hardware-softwre form
    public function hardware_form(){
        return view('support-dashboard/hardware-software-form');
    }

    //hardware-softwre all listing
    public function hardware_software_listing(){
        $record = HardwareSoftware::orderby('id','ASC')->get();
       // echo "<pre>";print_r($software_detail);exit;
        return view('support-dashboard/hardware-software-listing',compact('record'));
    }

     //assest transform form
     public function assest_transform_form(){
        return view('support-dashboard/assest-transform');
    }

    //single assest transform form
    public function single_assest_transform_form($id){
        $assest = Assest::where('id',$id)->first();
        return view('support-dashboard/single-assest-form',compact('assest'));
    }

     //single assest transform form
     public function single_software_hardware_form($id){
        $software_detail = HardwareSoftware::where('id',$id)->first();
        return view('support-dashboard/hardware-software-single',compact('software_detail'));
    }
    //submit assest form
    public function submit_assest_transform_form(Request $request){

        // echo "<pre>";print_r($request->all());exit;
         $EMP_CODE = $request['emp_code'];
         $TRANSFER_ASSET = $request['transfer_assest'];
         $DATE_OF_TRANSFER = $request['date_of_transfer'];
         $NAME = $request['name'];
         $TELEPHONE = $request['telephone'];
         $EMAIL = $request['email'];
         $DEVICE_DESCRIPTION = $request['device_description'];
         $DEVICE_MAKE_MODEL = $request['device_make_model'];
         $DEVICE_SERIAL_NUMBER = $request['device_serial_number'];
         $POWER_CORD_CHARGER = $request['power_charger'];
         $KEYS = $request['keys'];
         $ACCESS_CARD = $request['access_card'];
         $GATE_REMOTES = $request['gate_remotes'];
         $MEASURING_WHEEL = $request['measuring_wheel'];
         $COMMENTS  = $request['comments'];
         $STAFF_SIGNATURE = $request['staff_signature'];
         $LINK_AFRICA_REPRESENTATIVE = $request['link_africa_representive'];
         $DATE = $request['date'];
         $REGION = $request['region'];
         $ASSET_POSESSION = $request['assest_posession'];


         //Insert query
         $insert_record = Assest::Create([
             'emp_code'  => $EMP_CODE,
             'transfer_assest'  => $TRANSFER_ASSET,
             'date_of_transfer'  => $DATE_OF_TRANSFER,
             'name'  => $NAME,
             'telephone'  => $TELEPHONE,
             'email'  => $EMAIL,
             'device_description'  => $DEVICE_DESCRIPTION,
             'device_make_model'  => $DEVICE_MAKE_MODEL,
             'device_serial_number'  => $DEVICE_SERIAL_NUMBER,
             'power_charger'  => $POWER_CORD_CHARGER,
             'keys'  => $KEYS,
             'access_card'  => $ACCESS_CARD,
             'gate_remotes'  => $GATE_REMOTES,
             'measuring_wheel'  => $MEASURING_WHEEL,
             'comments'  => $COMMENTS,
             'staff_signature'  => $STAFF_SIGNATURE,
             'link_africa_representive'  => $LINK_AFRICA_REPRESENTATIVE,
             'date'  => $DATE,
             'region'  => $REGION,
             'assest_posession'  => $ASSET_POSESSION,
         ]);
 
         if($insert_record){
             return back()->with('message', 'Data Updated Successfully');
         }
 
     }

    //update assest form
    public function update_assest_transform_form(Request $request){

       // echo "<pre>";print_r($request->all());exit;
        $EMP_CODE = $request['emp_code'];
        $TRANSFER_ASSET = $request['transfer_assest'];
        $DATE_OF_TRANSFER = $request['date_of_transfer'];
        $NAME = $request['name'];
        $TELEPHONE = $request['telephone'];
        $EMAIL = $request['email'];
        $DEVICE_DESCRIPTION = $request['device_description'];
        $DEVICE_MAKE_MODEL = $request['device_make_model'];
        $DEVICE_SERIAL_NUMBER = $request['device_serial_number'];
        $POWER_CORD_CHARGER = $request['power_charger'];
        $KEYS = $request['keys'];
        $ACCESS_CARD = $request['access_card'];
        $GATE_REMOTES = $request['gate_remotes'];
        $MEASURING_WHEEL = $request['measuring_wheel'];
        $COMMENTS  = $request['comments'];
        $STAFF_SIGNATURE = $request['staff_signature'];
        $LINK_AFRICA_REPRESENTATIVE = $request['link_africa_representive'];
        $DATE = $request['date'];
        $REGION = $request['region'];
        $ASSET_POSESSION = $request['assest_posession'];
        $id = $request['id'];


        //Insert query
        $update_record = Assest::where('id',$id)->update([
            'emp_code'  => $EMP_CODE,
        	'transfer_assest'  => $TRANSFER_ASSET,
        	'date_of_transfer'  => $DATE_OF_TRANSFER,
        	'name'  => $NAME,
        	'telephone'  => $TELEPHONE,
        	'email'  => $EMAIL,
        	'device_description'  => $DEVICE_DESCRIPTION,
        	'device_make_model'  => $DEVICE_MAKE_MODEL,
        	'device_serial_number'  => $DEVICE_SERIAL_NUMBER,
        	'power_charger'  => $POWER_CORD_CHARGER,
        	'keys'  => $KEYS,
        	'access_card'  => $ACCESS_CARD,
        	'gate_remotes'  => $GATE_REMOTES,
        	'measuring_wheel'  => $MEASURING_WHEEL,
        	'comments'  => $COMMENTS,
        	'staff_signature'  => $STAFF_SIGNATURE,
        	'link_africa_representive'  => $LINK_AFRICA_REPRESENTATIVE,
        	'date'  => $DATE,
        	'region'  => $REGION,
        	'assest_posession'  => $ASSET_POSESSION,
        ]);

        if($update_record){
            return back()->with('message', 'Data Updated Successfully');
        }

    }


    //assest transform all listing page
    public function assest_transform_all_listing(){
        $assest = Assest::orderby('id','ASC')->get();
        return view('support-dashboard/asset-transform-listing',compact('assest'));
    }
    //function for submit new ticket
    public function add_new_ticket(Request $request){
        $resolution_date = "";
        if($request['resolution_date']){
        $resolution_date = Carbon::parse($request['resolution_date']);
        }
        $description = $request['description']; 
        $subject = $request['subject']; 
        $ticket_id = $request['ticket'];
        $ticket_status = $request['ticket_status'];
        $requester = $request['requester'];
        $requester_email_address = $request['requester_email_address'];
        $depaertment = $request['depaertment'];
        $location = $request['location'];
        $priority = $request['priority'];
        $impact = $request['impact'];
        $service = $request['service'];
        $category = $request['category'];
        $assignement_group = $request['assignement_group'];
        $assigne = $request['assigne'];
        $external_vendor = $request['external_vendor'];
        $external_reference = $request['external_reference'];
        $resolution_date = $resolution_date;
        $resolution_comment = $request['resolution_comment'];
        $ticket_decrypt = Crypt::decryptString($ticket_id);
        $user_id = auth()->user()->id;

        // function for insert data in Support ticket table
        $isticketExits = SupportTicket::where('ticket_id', $ticket_id)->first();  
        $ticket_id = $ticket_decrypt;  
        if($isticketExits){
            $ticket_id = $isticketExits['ticket_id'];
        } 
        //condition to check if ticket id exist then insert data
        if($ticket_id){
            $submit_support = SupportTicket::create([
                'subject' => $subject,
                'description' => $description,
                'user_id' => $user_id,
                'ticket_id' => $ticket_id,
                'status' => '0', 
                'ticket_status' => $ticket_status,
                'requester' => $requester,
                'requester_email_address' => $requester_email_address,
                'depaertment' => $depaertment,
                'location' => $location,
                'priority' => $priority,
                'impact' => $impact,
                'service' => $service,
                'category' => $category,
                'assignement_group' => $assignement_group,
                'assigne' => $assigne,
                'external_vendor' => $external_vendor,
                'external_reference' => $external_reference,
                'resolution_date' => $resolution_date,
                'resolution_comment' => $resolution_comment,

            ]); 
        $lastsupportId = $submit_support->id;
        //echo $lastsupportId;exit;
        $files = [];
        if($request->hasfile('filenames'))
            {
            foreach($request->file('filenames') as $file)
            {
                $name = time().rand(1,50).'.'.$file->extension();
                $file->move('public/upload/tickets', $name) ;  
                $files[] = $name;  
                $extension = $file->getClientOriginalExtension();
                $postdata = Attachment::create([
                    'attachment_name' => $name, 
                    'attachment_type' => $extension,
                    'user_id' => $user_id,
                    'ticket_id' => $ticket_id,
                            ]);
                    $lastUserId = $postdata->id;
                    $postdata = TicketAttachment::create([
                    'ticket_id' => $ticket_id,
                    'attachment_id' => $lastUserId,
                    'support_id' => $lastsupportId
                    ]); 
            
            }
            }
                        
                return back()->with('success','Ticket Submit Successfully');
            } else {
                return back()->with('unsuccess','Opps Something wrong!');
            }
        }
        //function for edit description
        public function reply_ticket(Request $request){
            $description = $request['description']; 
            $subject = $request['subject']; 
            $ticket_id = $request['ticket'];
            $ticket_decrypt = Crypt::decryptString($ticket_id);
            $user_id = auth()->user()->id;
    
            // function for insert data in Support ticket table
            $isticketExits = SupportTicket::where('ticket_id', $ticket_id)->first();  
            $ticket_id = $ticket_decrypt;  
            if($isticketExits){
                $ticket_id = $isticketExits['ticket_id'];
            } 
            //condition to check if ticket id exist then insert data
            if($ticket_id){
                $submit_support = SupportTicket::create([
                                                    'description' => $description,
                                                    'user_id' => $user_id,
                                                    'ticket_id' => $ticket_id,
                                                    'status' => '0', 
                                                    'subject' => $subject
                                                ]); 
    //get last insert id
    $lastsupportId = $submit_support->id;
            $files = [];
            if($request->hasfile('filenames')) {
                foreach($request->file('filenames') as $file){
                    $name = time().rand(1,50).'.'.$file->extension();
                    $file->move('public/upload/tickets', $name) ;  
                    $files[] = $name;  
                    $extension = $file->getClientOriginalExtension();
                    $postdata = Attachment::create([
                        'attachment_name' => $name, 
                        'attachment_type' => $extension,
                        'user_id' => $user_id,
                        'ticket_id' => $ticket_id,
                                ]);

                        $lastUserId = $postdata->id;
                        $postdata = TicketAttachment::create([
                        'ticket_id' => $ticket_id,
                        'attachment_id' => $lastUserId,
                        'support_id' => $lastsupportId
                        ]); 
                
                }
            }
                            
                    return back()->with('success','Reply Sent Successfully');
                } else {
                    return back()->with('unsuccess','Opps Something wrong!');
                }
        }
        
        //public function for submit software and hardware form
        public function submit_hard_and_software_form(Request $request){
             
            $software_requirement = implode(', ',$request['software_requirement']); 
            // echo "<pre>";print_r($request->all());exit;
             $employee_code = $request['employee_code'];
             $first_name = $request['first_name'];
             $last_name = $request['last_name'];
             $department = $request['department'];
             $employe_job_title = $request['employe_job_title'];
             $region = $request['region'];
             $email_address = $request['email_address'];
             $type_of_computer_required = $request['type_of_computer_required'];
             $telephone_requirement = $request['telephone_requirement'];
             $print_requirement = $request['print_requirement'];
             $email_password = $request['email_password'];
             $rainbow_password = $request['rainbow_password'];
             $o2cap_password = $request['o2cap_password'];
             $user_signature = $request['user_signature'];
             $user_signature_date  = $request['user_signature_date'];
   
             //Insert query
             $insert_record = HardwareSoftware::Create([
                 'employee_code'  => $employee_code,
                 'first_name'  => $first_name,
                 'last_name'  => $last_name,
                 'department'  => $department,
                 'employe_job_title'  => $employe_job_title,
                 'region'  => $region,
                 'email_address'  => $email_address,
                 'type_of_computer_required'  => $type_of_computer_required,
                 'telephone_requirement'  => $telephone_requirement,
                 'print_requirement'  => $print_requirement,
                 'software_requirement'  => $software_requirement,
                 'email_password'  => $email_password,
                 'rainbow_password'  => $rainbow_password,
                 'o2cap_password'  => $o2cap_password,
                 'user_signature'  => $user_signature,
                 'user_signature_date'  => $user_signature_date,
             ]);
     
             if($insert_record){
                 return back()->with('message', 'Data Created Successfully');
             }
     
         }   

        //public function for update software and hardware form
        public function update_hard_and_software_form(Request $request){
             
            $software_requirement = implode(', ',$request['software_requirement']); 
            // echo "<pre>";print_r($request->all());exit;
             $employee_code = $request['employee_code'];
             $first_name = $request['first_name'];
             $last_name = $request['last_name'];
             $department = $request['department'];
             $employe_job_title = $request['employe_job_title'];
             $region = $request['region'];
             $email_address = $request['email_address'];
             $type_of_computer_required = $request['type_of_computer_required'];
             $telephone_requirement = $request['telephone_requirement'];
             $print_requirement = $request['print_requirement'];
             $email_password = $request['email_password'];
             $rainbow_password = $request['rainbow_password'];
             $o2cap_password = $request['o2cap_password'];
             $user_signature = $request['user_signature'];
             $user_signature_date  = $request['user_signature_date'];
             $id  = $request['id'];
   
             //Insert query
             $insert_record = HardwareSoftware::where('id',$id)->update([
                 'employee_code'  => $employee_code,
                 'first_name'  => $first_name,
                 'last_name'  => $last_name,
                 'department'  => $department,
                 'employe_job_title'  => $employe_job_title,
                 'region'  => $region,
                 'email_address'  => $email_address,
                 'type_of_computer_required'  => $type_of_computer_required,
                 'telephone_requirement'  => $telephone_requirement,
                 'print_requirement'  => $print_requirement,
                 'software_requirement'  => $software_requirement,
                 'email_password'  => $email_password,
                 'rainbow_password'  => $rainbow_password,
                 'o2cap_password'  => $o2cap_password,
                 'user_signature'  => $user_signature,
                 'user_signature_date'  => $user_signature_date,
             ]);
     
             if($insert_record){
                 return back()->with('message', 'Data Updated Successfully');
             }
     
         }   
}
