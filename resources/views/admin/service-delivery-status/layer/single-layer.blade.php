@extends('admin.layouts.master')
 @section('content')
    <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        @include('admin.service-delivery-status.layer.layer-header')
            </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
              <div class="card La-add-scroll">
                  <div class="card-header">
                      <h3 class="card-title">Layer 2</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                    @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
                        <form action="{{ route('update.layer.detail' ,$record[0]['circuit_id']) }}" method="POST" enctype="multipart/form-data" id="add_site_master_file_record"> 
                        {{ csrf_field() }} 
                    @else
                      <form method="POST" action="#" enctype="multipart/form-data">
                    @endif
                    <div class="card-body no-scroll-need">
                        <div class="row free-Qwe">
                       
                          
                          
                   
                        <!-- Modal -->
                        <div class="col-2">
                            <div class="form-group">
                                <label>Project Status:</label>
                                <input type="text" name="project_status" value="{{ $record[0]['project_status'] }}" id="project_status" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-2">
                              <div class="form-group">
                                <label>Circuit ID:</label>
                                <input type="text" name="circuit_id" value="{{ $record[0]['circuit_id'] }}" id="circuit_id" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Date Po Order Rx:</label>
                                <input type="text" class="form-control block-field" name="date_po_order_rx"  value="{{ $record[0]['date_po_order_rx'] }}"> 
                               
                            </div>
                          </div>  
                          <div class="col-2">
                            <div class="form-group">
                                <label>Metro Area:</label>
                                <input type="text" class="form-control block-field" name="metro_area"  value="{{ $record[0]['metro_area'] }}">        
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Planning Status:</label>
                                <input type="text" class="form-control block-field" name="metro_area"  value="{{ $record[0]['planning_record']['planning_status'] }}">        
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Service Type:</label>
                                <input type="text" name="po_mservice_typerc" value="{{ $record[0]['service_type'] }}" id="po_mrc" class="form-control block-field">
                            </div>
                          </div>
                          

                          <div class="col-2">
                            <div class="form-group">
                                <label>Project ID:</label>
                                <input type="text" name="project_id" value="{{ $record[0]['project_id'] }}" id="project_id" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Order Ref No:</label>
                                <input type="text" name="order_ref_number" value="{{ $record[0]['order_ref_number'] }}" id="order_ref_number" class="form-control block-field">
                            </div>
                          </div>
                           <div class="col-2">
                            <div class="form-group">
                                <label>Client Name:</label>
                                <input type="text" name="client_name" value="{{ $record[0]['client_name'] }}" id="po_mrc" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Client Ring:</label>
                                <input type="text" name="client_ring" value="{{ $record[0]['client_ring'] }}" id="client_ring" class="form-control block-field">   
           
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Build Status</label>
                                <input type="text" name="client_ring" value="{{ $record[0]['build_record']['build_status'] }}" id="build_status" class="form-control block-field">   
                                <div id="client_ring_res" class="client-ring-list"></div> 
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                                <label>Province:</label>
                                <input type="text" class="form-control block-field" name="province" id="province" value="{{ $record[0]['province'] }}">   
            
                            </div>
                          </div>
                       
                          <div class="col-2">
                            <div class="form-group">
                                <label>Project Type:</label>
                                <input type="text" name="project_type" value="{{ $record[0]['type'] }}" id="po_mrc" class="form-control block-field">
                            </div>
                          </div>
                          
                          <div class="col-2">
                          </div>
                          </div>
                          <div class="row free-Qwe">
                          <div class="col-md-4 inner-peth">
                          <div class="col-3">
                            <div class="form-group">
                             <label>Layer 2 - Status</label>
                               <select name ="layer_status" class="form-control">
                                <option value="">Please Select</option>
                                <option value = "A) New Sales" <?php if ($record[0]['build_record']['layer_status'] == 'A) New Sales') echo ' selected="selected"'; ?>>A) New Sales</option>
                                <option value = "B) TOC P1 Received-Build" <?php if ($record[0]['build_record']['layer_status'] == 'B) TOC P1 Received-Build') echo ' selected="selected"'; ?>>B) TOC P1 Received-Build</option>
                                <option value = "C) TOC P1 Submitted-Build" <?php if ($record[0]['build_record']['layer_status'] == 'C) TOC P1 Submitted-Build') echo ' selected="selected"'; ?>>C) TOC P1 Submitted-Build</option>
                                <option value = "D) On-Hold"  <?php if ($record[0]['build_record']['layer_status'] == 'D) On-Hold') echo ' selected="selected"'; ?>>D) On-Hold</option>
                                <option value = "E) Return to Sales"  <?php if ($record[0]['build_record']['layer_status'] == 'E) Return to Sales') echo ' selected="selected"'; ?>>E) Return to Sales</option>
                                <option value = "F) Cancelled" <?php if ($record[0]['build_record']['layer_status'] == 'F) Cancelled') echo ' selected="selected"'; ?>>F) Cancelled</option>
                                <option value = "G) Terminated"  <?php if ($record[0]['build_record']['layer_status'] == 'G) Terminated') echo ' selected="selected"'; ?>>G) Terminated</option>
                                <option value = "H) Sale Data Fix"  <?php if ($record[0]['build_record']['layer_status'] == 'H) Sale Data Fix') echo ' selected="selected"'; ?>>H) Sale Data Fix</option>
                               </select>
                            </div>
                          </div>  
                         </div>
                         <div class="col-md-1">
                        </div>
                         <div class="col-md-4 inner-peth">
                         <div class="col-4 listing-design-link">
                            <div class="form-group">
                              <h2 style="font-size:18px;font-weight:700;">Uploaded Files:</h2>
                              @if(count($record[0]['attachment_record']) > 0) 
                                @foreach($record[0]['attachment_record'] as $attachment)
                                @if($attachment['page_type'] == 'layer')
                                  <li><a href="{{ url('admin/download-attachment', $attachment['id']) }}">{{ $attachment['attachment_name'] }}</a></li>
                                @endif
                                @endforeach
                                @else
                                  <p>No Document Please Upload</p>
                              @endif
                            </div>
                            </div> 
                         </div>
                         <div class="col-md-3 inner-peth">
                          <div class="form-group">
                            <div class="upload-icon">
                            <i class="fas fa-upload"></i>
                              <!-- Button trigger modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                           Upload Attachment
                          </button>
                            </div>
                          </div>  
                         </div>
                          </div>
                          <div class="row secound-Qw">
                           <div class="col-md-4 inner-peth">
                           <div class="col-3">
                            <div class="form-group">
                                <label>Site A:</label>
                                <input type="text" name="site_a" value="{{ $record[0]['site_a'] }}" id="site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Site A Status:</label>
                                <select class="form-control" name="site_a" id="site_a">
                                    <option value="">Please Select</option>
                                     @foreach($all_site_a_lists as $site_a)
                                     <option value="{{ $site_a['site_name'] }}" {{ ( $site_a['site_name'] == $record[0]['site_a']) ? 'selected' : '' }}> {{ $site_a['site_name'] }} </option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Contact Name - Site A:</label>
                                <input type="text" name="contact_name_site_a" value="{{ $record[0]['contact_name_site_a'] }}" id="contact_name_site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Physical Address - Site A:</label>
                                <input type="text" name="physical_address_site_a" value="{{ $record[0]['physical_address_site_a'] }}" id="physical_address_site_a" class="form-control block-field">
                            </div>
                          </div>
                         
                          <div class="col-3">
                            <div class="form-group">
                                <label>Work Number - Site A:</label>
                                <input type="text" name="work_number_site_a" value="{{ $record[0]['work_number_site_a'] }}" id="work_number_site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Mobile Number - Site A:</label>
                                <input type="text" name="mobile_number_site_a" value="{{ $record[0]['mobile_number_site_a'] }}" id="mobile_number_site_a" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Email Address - Site A:</label>
                                <input type="text" name="email_address_site_a" value="{{ $record[0]['email_address_site_a'] }}" id="email_address_site_a" class="form-control block-field">
                            </div>
                          </div>
                    
                          </div>
                          
                          
                          <div class="col-md-4 inner-peth">  
                          <div class="col-3">
                            <div class="form-group">
                                <label>TOC Part 1 - Receive from Implementation:</label>
                                <input type="text" name="TOC_Part_1_Receive_from_Implementation" value="{{ $record[0]['build_record']['TOC_Part_1_Receive_from_Implementation'] }}" id="TOC_Part_1_Receive_from_Implementation" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Configuration Done:</label>
                                <input type="text" name="configuration_done" value="{{ $record[0]['build_record']['configuration_done'] }}" id="configuration_done" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>TOC Part 2 - Released:</label>
                                <input type="text" name="TOC_part_2_released" value="{{ $record[0]['build_record']['TOC_part_2_released'] }}" id="TOC_part_2_released" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Termination Request Received:</label>
                                <input type="text" name="termination_request_received" value="{{ $record[0]['termination_request_received'] }}" id="termination_request_received" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Configuration Removed:</label>
                                <input type="text" name="configuration_received" value="{{ $record[0]['configuration_received'] }}" id="configuration_received" class="form-control">
                            </div>
                          </div>
                          
                           </div>

                           <div class="col-md-4 inner-peth">  
                           <div class="col-3">
                            <div class="form-group">
                                <label>Site B:</label>
                                <input type="text" name="site_b" value="{{ $record[0]['site_b'] }}" id="site_b" class="form-control block-field">
                            </div>
                          </div>    
                          <div class="col-3">
                            <div class="form-group">
                                <label>Site B Status:</label>
                                <select class="form-control" name="site_b" id="site_b">
                                    <option value="">Please Select</option>
                                    @foreach($all_site_b_lists as $site_b)
                                    <option value="{{ $site_b['site_name'] }}" {{ ( $site_b['site_name'] == $record[0]['site_b']) ? 'selected' : '' }}> {{ $site_b['site_name'] }} </option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Contact Name  - Site B:</label>
                                <input type="text" name="contact_name_site_b" value="{{ $record[0]['contact_name_site_b'] }}" id="contact_name_site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Physical Address - Site B:</label>
                                <input type="text" name="physical_address_site_b" value="{{ $record[0]['physical_address_site_b'] }}" id="physical_address_site_b" class="form-control block-field">
                            </div>
                          </div>
                          
                          <div class="col-3">
                            <div class="form-group">
                                <label>Work Number - Site B:</label>
                                <input type="text" name="work_number_site_b" value="{{ $record[0]['work_number_site_b'] }}" id="work_number_site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Mobile Number - Site B:</label>
                                <input type="text" name="mobile_number_site_b" value="{{ $record[0]['mobile_number_site_b'] }}" id="mobile_number_site_b" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Email Address - Site B:</label>
                                <input type="email" name="email_address_site_b" value="{{ $record[0]['email_address_site_b'] }}" id="email_address_site_b" class="form-control block-field">
                            </div>
                          </div>      
                          </div>
                          </div>
                            
                      </div>
                      <div class="row secound-Qw">
                           <div class="col-md-12 inner-peth">
                           <div class="col-6">
                            <div class="form-group">
                                <label>Comments:</label>
                                <textarea  class="form-control" name="layer_comment" cols="50">{{ $record[0]['layer_comment'] }}</textarea>
                            </div>
                          </div>  
                          </div>
                         </div>
                      <div class="card-footer">
                      @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                        @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
                            <button type="submit" class="btn btn-primary">Submit</button> 
                          @endif
                    </div>
                </form> 
                <!-- /.card-body -->
            </div>
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog sale-attachment">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Layer Attachment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form id="upload_attachment_new" action="#" enctype="multipart/form-data">
                                <div class="upload-icon">
                                  <i class="fas fa-upload"></i>
                                  <span>Upload Document</span>
                                  <input type="file" id="filenames" name="filenames[]" multiple>
                                  <input type="hidden" id="service_id" name="service_id" value ="{{ $record[0]['circuit_id'] }}">
                                  <input type="hidden" id="circuit_id" name="circuit_id" value = "{{ $record[0]['circuit_id'] }}">
                                  <input type="hidden" id="page_type" name="sales" value ="layer">
                                  </div>
                                  <div id="selectedFiles"></div>
                                  <label>Select Type</label><br>
                                  <select id="form_type" name="form_type">
                                    <option value ="layer">layer</option>
                                  </select>
                                  <inpput type="text" value="" name="testingggggg" id="testingggggg">
                                  <button type="submit" class="btn btn-primary att-dis">Submit</button>
                                  <div class="success_msg"></div>
                                </form>
                            </div>
                    </div>
            </div>
      </div>

 @endsection
         