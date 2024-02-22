@extends('admin.layouts.master')
 @section('content')
    <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        @include('admin.customer.customer-header')
            
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
                      <h3 class="card-title">Edit Sale</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                   @if(count($record) >= 1)
                    <form method="POST" action="{{ route('update.custumer.comment', $record[0]->id) }}" enctype="multipart/form-data" class="edit_site_master_file_record">
                        @csrf
                      <div class="card-body no-scroll-need">
                        <div class="row free-Qwe">
                       
                          <div class="col-3">
                              <div class="form-group">
                                <label>Service ID:</label>
                                <input type="text" name="" value="{{ $record[0]->service_id }}" id="service_id" class="form-control block-field">
                            </div>
                          </div>
                     
                          <div class="col-3">
                            <div class="form-group">
                                <label>Project Status:</label>
                                <input type="text" name="" value="{{ $record[0]->project_status }}" id="project_status" class="form-control block-field">
                            </div>
                          </div>

                           <div class="col-3">
                            <div class="form-group">
                                <label>Client Name:</label>
                               <input type="text" name="" value="{{ $record[0]->client_name }}" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Site A:</label>
                               <input type="text" name="" value="{{ $record[0]->site_a }}" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Site B:</label>
                               <input type="text" name="" value="{{ $record[0]->site_b }}" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Province:</label>
                               <input type="text" name="" value="{{ $record[0]->province }}" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Service Type:</label>
                               <input type="text" name="" value="{{ $record[0]->service_type }}" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Date New:</label>
                              @if($record[0]->date_new)
                               <input type="text" name="" value="{{ Carbon\Carbon::parse($record[0]->date_new)->format('m/d/Y') }}" class="form-control block-field">
                               @else
                               <input type="text" name="" value="" class="form-control block-field">
                               @endif
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Date Site Survey:</label>
                              @if($record[0]->site_survey_record)
                               <input type="text" name="" value="{{ Carbon\Carbon::parse($record[0]->site_survey_record->date_site_survey)->format('m/d/Y') }}" class="form-control block-field">
                              @else
                               <input type="text" name="" value="" class="form-control block-field">
                              @endif
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>DATE SUBMITTED FOR LANDLORD:</label>
                              @if($record[0]->landlord_record)
                               <input type="text" name="" value="{{ Carbon\Carbon::parse($record[0]->landlord_record->date_submit_for_landlord)->format('m/d/Y') }}" class="form-control block-field">
                              @else
                               <input type="text" name="" value="" class="form-control block-field">
                              @endif
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>DATE LANDLORD APPROVAL RECEIVED:</label>
                              @if($record[0]->landlord_record)
                               <input type="text" name="" value="{{ Carbon\Carbon::parse($record[0]->landlord_record->date_landlord_approval)->format('m/d/Y') }}" class="form-control block-field">
                              @else
                               <input type="text" name="" value="" class="form-control block-field">
                              @endif
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>EST. COMPLETION DATE:</label>
                              @if($est_complition_date)
                               <input type="text" name="" value="{{ Carbon\Carbon::parse($est_complition_date)->format('m/d/Y') }}" class="form-control block-field">
                              @else
                               <input type="text" name="" value="" class="form-control block-field">
                              @endif
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>PLANNED BUILD COMPLETION DATE:</label>
                              @if($record[0]->build_record->planned_build_completion_date)
                               <input type="text" name="" value="{{ Carbon\Carbon::parse($record[0]->build_record->planned_build_completion_date)->format('m/d/Y') }}" class="form-control block-field">
                              @else
                               <input type="text" name="" value="" class="form-control block-field">
                              @endif
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Service Delivery Comments:</label>
                               <input type="text" name="" value="{{ $record[0]->service_delivery_comments }}" class="form-control block-field">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>Responsible:</label>
                               <input type="text" name="" value="" class="form-control block-field">
                            </div>
                          </div>
            
                       
                          </div>
                          <div class="row secound-Qw">
                           <div class="col-md-12 inner-peth">
                           <div class="col-6">
                            <div class="form-group">
                                <label>Client Comments:</label>
                                <textarea  class="form-control" name="comments" cols="50">{{ $record[0]->comments }}</textarea>
                            </div>
                          </div>  
                          </div>
                         </div>
                        
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>        
                    </div>
                </form> 
                @else
                <h2>Result Not found</h2>
                @endif
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

 
      
 @endsection