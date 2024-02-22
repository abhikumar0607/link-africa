@extends('admin.layouts.master')
 @section('content')

  <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.site-master-files.sale-header')
            </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content service-add-content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary service-add">
                @if (session('site_a_success'))
                  <p class="alert alert-success">{{ session('site_a_success') }}</p>
                @endif
                @if (session('site_a_unsuccess'))
                    <p class="alert alert-danger">{{ session('site_a_unsuccess') }}</p>
                @endif
                @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
                  <form method="POST" action="{{ url('admin/site/update-site-a') }}" enctype="multipart/form-data">
                  @csrf
                @else
                  <form method="POST" action="#" enctype="multipart/form-data">
                @endif
                <div class="row"> 
               <div class="col-md-12">
                <div class="form-group">
                  <label for="site_a_list">Site A List</label>
                  <select class="form-control" name="site_a_list" id="site_a_list"> 
                    <option value="">Please Select</option>
                      @foreach($site_a_name as $site_a)
                      @if($site_a_records)
                      <option value="{{ $site_a['site_name'] }}" {{ ( $site_a['site_name'] == $site_a_records[0]['site_name']) ? 'selected' : '' }}> {{ $site_a['site_name'] }}</option>
                      @else
                      <option value="{{ $site_a['site_name'] }}">{{ $site_a['site_name'] }}</option>
                      @endif
                      @endforeach
                  </select>
                </div>
              </div>
              </div>
                <div class="form-group">
                  <label for="site_name">Site A</label>
                  <input type="text" name="site_name" id="site_a" value="@if($site_a_records){{ $site_a_records[0]['site_name'] }}@endif" class="form-control @error('site_name') is-invalid @enderror">
                  @error('site_name') 
                    <span class="invalid-feedback" role="alert"> 
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                  <input type="hidden" name="site_a_id" id="site_id" value="@if($site_a_records){{ $site_a_records[0]['id'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="contact_name">Contact Name - Site A:</label>
                  <input type="text" name="contact_name" id="contact_name_site_a" value="@if($site_a_records){{ $site_a_records[0]['contact_name'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="physical_address">Physical Address - Site A:</label>
                  <input type="text" name="physical_address" id="physical_address_site_a" value="@if($site_a_records){{ $site_a_records[0]['physical_address'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="gps_co_ordinates">GPS Co - ordinates - Site A-X:</label>
                  <input type="text" name="gps_co_ordinates" id="gps_co_ordinates_site_a_x" value="@if($site_a_records){{ $site_a_records[0]['gps_co_ordinates'] }} @endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="gps_co_ordinates2">GPS Co - ordinates - Site A-Y:</label>
                  <input type="text" name="gps_co_ordinates2" id="gps_co_ordinates_site_a_y" value="@if($site_a_records) {{ $site_a_records[0]['gps_co_ordinates2'] }} @endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="work_number">Work Number - Site A:</label>
                  <input type="text" name="work_number" id="work_number_site_a" value="@if($site_a_records) {{ $site_a_records[0]['work_number'] }} @endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="mobile_number">Mobile Number - Site A:</label>
                  <input type="text" name="mobile_number" id="mobile_number_site_a" value="@if($site_a_records) {{ $site_a_records[0]['mobile_number'] }} @endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email_address">Email Address - Site A:</label>
                  <input type="email" name="email_address" id="email_address_site_a" value="@if($site_a_records) {{ $site_a_records[0]['email_address'] }} @endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="landlord_name">landlord Name - Site A:</label>
                  <input type="text" name="landlord_name" id="landlord_name_site_a" value="@if($site_a_records) {{ $site_a_records[0]['landlord_name'] }} @endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="landlord_contact_number">landlord Contact Number A:</label>
                  <input type="text" name="landlord_contact_number" id="landlord_contact_number_a" value="@if($site_a_records) {{ $site_a_records[0]['landlord_contact_number'] }} @endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="managing_agent">Managing Agent - Site A:</label>
                  <input type="text" name="managing_agent" id="managing_agent_site_a" value="@if($site_a_records) {{ $site_a_records[0]['managing_agent'] }} @endif" class="form-control">
                </div>
             
              
                <div class="row">
                  <div class="col-12"> 
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                  @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
                      <input type="submit" value="Update" class="btn btn-success">
                    @endif
                  </div>
                </div>
              </form>
          </div>
          <!-- /.card -->
          </div>
        <div class="col-md-6">
          <div class="card card-primary service-add">
            @if (session('success'))
              <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            @if (session('unsuccess'))
                <p class="alert alert-danger">{{ session('unsuccess') }}</p>
            @endif
            @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
            @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
              <form method="POST" action="{{ url('admin/site/update-site-b') }}" enctype="multipart/form-data">
              @csrf
            @else
              <form method="POST" action="#" enctype="multipart/form-data">
            @endif
             
            <div class="row">
               <div class="col-md-12">
                <div class="form-group">
                  <label for="site_b_list">Site B List</label>
                  <select class="form-control" name="site_b_list" id="site_b_list"> 
                      <option value="">Please Select</option>  
                      @foreach($site_b_name as $site_b)
                        @if($site_b_records)
                        <option value="{{ $site_b['site_name'] }}" {{ ( $site_b['site_name'] == $site_b_records[0]['site_name']) ? 'selected' : '' }}> {{ $site_b['site_name'] }}</option>
                        @else
                        <option value="{{ $site_b['site_name'] }}">{{ $site_b['site_name'] }}</option>
                        @endif
                      @endforeach
                  </select>
                </div>
              </div>
              </div>
                <div class="form-group">
                  <label for="site_name">Site B</label>
                  <input type="text" name="b_site_name" id="site_b" value="@if($site_b_records){{ $site_b_records[0]['site_name'] }} @endif" class="form-control @error('b_site_name') is-invalid @enderror">
                  @error('b_site_name') 
                    <span class="invalid-feedback" role="alert"> 
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                  <input type="hidden" name="b_site_id" id="b_site_id" value="@if($site_b_records){{ $site_b_records[0]['id'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="b_contact_name">Contact Name - Site B:</label>
                  <input type="text" name="b_contact_name" id="contact_name_site_b" value="@if($site_b_records){{ $site_b_records[0]['contact_name'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="b_physical_address">Physical Address - Site B:</label>
                  <input type="text" name="b_physical_address" id="physical_address_site_b" value="@if($site_b_records){{ $site_b_records[0]['physical_address'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="b_gps_co_ordinates">GPS Co - ordinates - Site B-X:</label>
                  <input type="text" name="b_gps_co_ordinates" id="gps_co_ordinates_site_b_x" value="@if($site_b_records){{ $site_b_records[0]['gps_co_ordinates'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="b_gps_co_ordinates2">GPS Co - ordinates - Site B-Y:</label>
                  <input type="text" name="b_gps_co_ordinates2" id="gps_co_ordinates_site_b_y" value="@if($site_b_records){{ $site_b_records[0]['gps_co_ordinates2'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="b_work_number">Work Number - Site B:</label>
                  <input type="text" name="b_work_number" id="work_number_site_b" value="@if($site_b_records){{ $site_b_records[0]['work_number'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="b_mobile_number">Mobile Number - Site B:</label>
                  <input type="text" name="b_mobile_number" id="mobile_number_site_b" value="@if($site_b_records){{ $site_b_records[0]['mobile_number'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="b_email_address">Email Address - Site B:</label>
                  <input type="email" name="b_email_address" id="email_address_site_b" value="@if($site_b_records){{ $site_b_records[0]['email_address'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="b_landlord_name">landlord Name - Site B:</label>
                  <input type="text" name="b_landlord_name" id="landlord_name_site_b" value="@if($site_b_records){{ $site_b_records[0]['landlord_name'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="b_landlord_contact_number">landlord Contact Number B:</label>
                  <input type="text" name="b_landlord_contact_number" id="landlord_contact_number_b" value="@if($site_b_records){{ $site_b_records[0]['landlord_contact_number'] }}@endif" class="form-control">
                </div>
                <div class="form-group">
                  <label for="b_managing_agent">Managing Agent - Site B:</label> 
                  <input type="text" name="b_managing_agent" id="managing_agent_site_b" value="@if($site_b_records){{ $site_b_records[0]['managing_agent'] }}@endif" class="form-control">
                </div>
             
                <div class="row">
                  <div class="col-12"> 
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                      @if(in_array('all', $edit_access['edit_access_type']) OR in_array('sale', $edit_access['edit_access_type']))
                      <input type="submit" value="Update" class="btn btn-success">
                    @endif
                  </div>
                </div>
              </form>
          </div>
          <!-- /.card -->
        </div>
       
      </div>
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
 @endsection