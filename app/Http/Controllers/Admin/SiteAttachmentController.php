<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteAttachment;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class SiteAttachmentController extends Controller
{
    public function submit_attachment(Request $request){
           // insert attachments for sales
           $user_name = Auth::user()->name;
           $data = $request->all(); 
           $service_id = $data['service_id'];
           $circuit_id= $data['circuit_id'];
           $form_type= $data['form_type'];
           $page_type= $data['page_type'];
            //print_r($data['filenames'][0]);exit;
           $files = [];
           if($request->filenames > 0)
               {
               foreach($request->file('filenames') as $file)
               {

                   // Use the original name of the file
                   $originalName = $file->getClientOriginalName();
                    // Generate a unique filename using timestamp and random number
                   $uniqueFileName = time() . '_' . rand(1, 50) . '_' . $file->getClientOriginalName();
                   $file->move('public/upload/attachment', $uniqueFileName) ;  
                   $files[] = $uniqueFileName;  
                   $extension = $file->getClientOriginalExtension();
                   $postdata = SiteAttachment::create([
                       'service_id' => $service_id, 
                       'circuit_id' => $circuit_id,
                       'attachment_name' => $uniqueFileName,
                       'page_type' => $page_type,
                       'form_type' => $form_type,
                       'name' => $user_name,
                               ]);
                      
                   }
                   if($postdata){
                    echo "Attachment submitted succesfully";
                   } else {
                        echo "Oops something went wrong!";
                   }
                    
                  
               } 
               else {
                echo "Oops something went wrong!";
           }
    }

    // function for view sales attachment
    public function sales_attachment(){
        $sales_attachment = SiteAttachment::orderBy('id','DESC')->where('page_type','sales')->get();
        return view('admin.site-master-files.sales-attachment', compact('sales_attachment'));
        //echo "<pre>";print_r($sales_attachment);
    }

      // function for view planning attachment
      public function planning_attachment(){
        $planning_attachment = SiteAttachment::orderBy('id','DESC')->where('page_type','planning')->get();
        return view('admin.planning-master-files.planning-attachment', compact('planning_attachment'));
        //echo "<pre>";print_r($sales_attachment);
    }

    //function for download planning file
    public function download_planning_attachment($attachmentid){
        $attachment = SiteAttachment::select('attachment_name')->where('id',$attachmentid)->get()->toArray();
        $attachmentName = $attachment[0]['attachment_name'];
        $filePath = public_path('upload/attachment/'.$attachmentName);
        // Check if the file extension is xlsx
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        //echo $filePath;exit;

            // Check if the file extension is xlsx
            // if ($extension === 'xlsx') {
            //     $headers = array('Content-Type' => File::mimeType($filePath));
    
            //     // Serve the file as a download response
            //     return Response::download($filePath, $attachmentName, $headers);
            // } else {
                // For other files, use regular download
                return response()->download($filePath, $attachmentName);
            
    }

        // function for view permission attachment
        public function permission_attachment(){
            $permission_attachment = SiteAttachment::orderBy('id','DESC')->where('page_type','permission')->get();
            return view('admin.permission-master-files.permission-attachment', compact('permission_attachment'));
            //echo "<pre>";print_r($sales_attachment);
        }
    
         // function for view permission attachment
         public function build_attachment(){
            $build_attachment = SiteAttachment::orderBy('id','DESC')->where('page_type','build')->get();
            return view('admin.build-master-files.build-attachment', compact('build_attachment'));
            //echo "<pre>";print_r($sales_attachment);
        }
    
          // function for view permission attachment
          public function service_delivery_attachment(){
            $service_delivery_attachment = SiteAttachment::orderBy('id','DESC')->where('page_type','service_delivery')->get();
            return view('admin.service-delivery-status.service-delivery-attachment', compact('service_delivery_attachment'));
            //echo "<pre>";print_r($sales_attachment);
        }

        // function for view layer attachment
        public function layer_attachment(){
            $layer_attachment = SiteAttachment::orderBy('id','DESC')->where('page_type','build')->where('form_type','layer')->get();
            return view('admin.service-delivery-status.layer.layer-attachment', compact('layer_attachment'));
            //echo "<pre>";print_r($sales_attachment);
        }

        // function for view financial attachment
        public function financial_attachment($id){
            $financial_attachment = SiteAttachment::orderBy('id','DESC')->where('circuit_id',$id)->get();
            return view('admin.financial.financial-attachment', compact('financial_attachment'));
            //echo "<pre>";print_r($sales_attachment);
        }

        // function for delete sales attachment
        public function delete_attachment($id){

            $imagePath = SiteAttachment::select('attachment_name')->where('id', $id)->first();
            $filePath = $imagePath->attachment_name;
            //echo $filePath;exit;
            if (file_exists(public_path() . '/upload/attachment/'. $filePath)) {
                unlink(public_path() . '/upload/attachment/'. $filePath);
                $delete_attachment = SiteAttachment::find($id)->delete();
            } else {

                $delete_attachment = SiteAttachment::find($id)->delete();
            }
            
            if($delete_attachment) {
                return back()->with('success','Record delete Successfully.');
            } else {
                return back()->with('unsuccess','oops something went wrong!');
            }
        }

}
