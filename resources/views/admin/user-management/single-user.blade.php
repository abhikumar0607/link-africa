@extends('admin.layouts.master')
 @section('content')

  <!-- Header content -->
    <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        @include('admin.user-management.user-management-header')
            </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content service-add-content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary service-add">
                @if (session('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                @if(in_array('all', $edit_access['edit_access_type']))
                  <form method="POST" action="{{ route('admin.user-management.update-user') }}" enctype="multipart/form-data">
                  @csrf
                @else
                  <form method="POST" action="#" enctype="multipart/form-data">
                @endif
          
                <div class="form-group">
                  <label for="employee_code">Emp Code</label>
                  <input type="hidden" name="id" value="{{ $user->id }}" id="id" class="form-control">
                  <input type="text" name="employee_code" value="{{ $user->emp_code }}" id="employee_code" class="form-control">
               </div>
               <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" name="first_name" value="{{ $user->first_name }}" id="first_name" class="form-control">
               </div>
               <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" name="last_name" value="{{ $user->last_name }}" id="last_name" class="form-control">
               </div>
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" value="{{ $user->email }}" id="email" class="form-control @error('email') is-invalid @enderror">
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
               </div>
              <div class="form-group">
                  <label>Birth Date:</label>
                  <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" value="{{ Carbon\Carbon::parse($user->birth_date)->format('m/d/Y'); }}" name="birth_date" id="birth_date" data-target="#custom_date_picker5">
                      <div class="input-group-append" data-target="#custom_date_picker5" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <label for="company_rule">Company Rule</label>
                  <select class="form-control" name="company_rule" id="company_rule">
                      <option value="" selected>Please Select</option>
                      <option value="LINK_AFRICA" <?php if($user->company_rule == 'LINK_AFRICA') { echo "selected"; } ?>>LINK_AFRICA</option>
                      <option value="LINK_AFRICA_EPC" <?php if($user->company_rule == 'LINK_AFRICA_EPC') { echo "selected"; } ?>>LINK_AFRICA_EPC</option>
                  </select>
               </div>   
               <div class="form-group">
                  <label for="cost_center">Cost Centre </label>
                  <select class="form-control" name="cost_center" id="cost_center">
                      <option value="" selected>Please Select</option>
                      <option value="Gauteng" <?php if($user->cost_centre == 'Gauteng') { echo "selected"; } ?>>Gauteng</option>
                      <option value="Durban" <?php if($user->cost_centre == 'Durban') { echo "selected"; } ?>>Durban</option>
                      <option value="Cape_Town" <?php if($user->cost_centre == 'Cape_Town') { echo "selected"; } ?>>Cape Town</option>
                  </select>
               </div>  
               <div class="form-group">
                  <label for="department">Department</label>
                  <select class="form-control" name="department" id="department">
                      <option value="" selected>Please Select</option>
                      <option value="Executive"  <?php if($user->department == 'Executive') { echo "selected"; } ?>>Executive</option>
                      <option value="Human_Recources" <?php if($user->department == 'Human_Recources') { echo "selected"; } ?>>Human Recources</option>
                      <option value="Building" <?php if($user->department == 'Building') { echo "selected"; } ?>>Building</option>
                      <option value="Permissions" <?php if($user->department == 'Permissions') { echo "selected"; } ?>>Permissions</option>
                      <option value="OPS" <?php if($user->department == 'OPS') { echo "selected"; } ?>>OPS</option>
                      <option value="PMO" <?php if($user->department == 'PMO') { echo "selected"; } ?>>PMO</option>
                      <option value="Sales" <?php if($user->department == 'Sales') { echo "selected"; } ?>>Sales</option>
                      <option value="IT" <?php if($user->department == 'IT') { echo "selected"; } ?>>IT</option>
                      <option value="Planning" <?php if($user->department == 'Planning') { echo "selected"; } ?>>Planning</option>
                      <option value="Finance" <?php if($user->department == 'Finance') { echo "selected"; } ?>>Finance</option>
                      <option value="Regional_Management" <?php if($user->department == 'Regional_Management') { echo "selected"; } ?>>Regional Management</option>
                      <option value="SHEQ" <?php if($user->department == 'SHEQ') { echo "selected"; } ?>>SHEQ</option>
                      <option value="Fulfillment" <?php if($user->department == 'Fulfillment') { echo "selected"; } ?>>Fulfillment</option>
                  </select>
               </div>   
               <div class="form-group">
                  <label for="team">Team</label>
                  <select class="form-control" name="team" id="team">
                      <option value="" selected>Please Select</option>
                      <option value="Exco" <?php if($user->team == 'Exco') { echo "selected"; } ?>>Exco</option>
                      <option value="Human_Resources" <?php if($user->team == 'Human_Resources') { echo "selected"; } ?>>Human Resources</option>
                      <option value="Manco" <?php if($user->team == 'Manco') { echo "selected"; } ?>>Manco</option>
                      <option value="Admin"<?php if($user->team == 'Admin') { echo "selected"; } ?>>Admin</option>
                      <option value="IS" <?php if($user->team == 'IS') { echo "selected"; } ?>>IS</option>
                      <option value="Wayleaves" <?php if($user->team == 'Wayleaves') { echo "selected"; } ?>>Wayleaves</option>
                      <option value="Splicing" <?php if($user->team == 'Splicing') { echo "selected"; } ?>>Splicing</option>
                      <option value="PMO" <?php if($user->team == 'PMO') { echo "selected"; } ?>>PMO</option>
                      <option value="Finance" <?php if($user->team == 'Finance') { echo "selected"; } ?>>Finance</option>
                      <option value="NOC" <?php if($user->team == 'NOC') { echo "selected"; } ?>>NOC</option>
                      <option value="Drill" <?php if($user->team == 'Drill') { echo "selected"; } ?>>Drill</option>
                      <option value="Project_Lead" <?php if($user->team == 'Project_Lead') { echo "selected"; } ?>>Project Lead</option>
                      <option value="Re_Instatement" <?php if($user->team == 'Re_Instatement') { echo "selected"; } ?>>Re-Instatement</option>
                      <option value="Management" <?php if($user->team == 'Management') { echo "selected"; } ?>>Management</option>
                      <option value="Reception" <?php if($user->team == 'Reception') { echo "selected"; } ?>>Reception</option>
                      <option value="Planning" <?php if($user->team == 'Planning') { echo "selected"; } ?>>Planning</option>
                      <option value="Focus_Haul"<?php if($user->team == 'Focus_Haul') { echo "selected"; } ?>>Focus/Haul</option>
                      <option value="QA" <?php if($user->team == 'QA') { echo "selected"; } ?>>QA</option>
                      <option value="AS_Build" <?php if($user->team == 'AS_Build') { echo "selected"; } ?>>AS Build</option>
                      <option value="Jetting" <?php if($user->team == 'Jetting') { echo "selected"; } ?>>Jetting</option>
                      <option value="Scan" <?php if($user->team == 'Scan') { echo "selected"; } ?>>Scan</option>
                      <option value="Survey" <?php if($user->team == 'Survey') { echo "selected"; } ?>>Survey</option>
                      <option value="GIS" <?php if($user->team == 'GIS') { echo "selected"; } ?>>GIS</option>
                      <option value="FTTB" <?php if($user->team == 'FTTB') { echo "selected"; } ?>>FTTB</option>
                      <option value="Warehouse" <?php if($user->team == 'Warehouse') { echo "selected"; } ?>>Warehouse</option> 
                  </select>
               </div>  

               <div class="form-group">
                @php $edit_user_access = explode(",",$user['edit_form_access']); @endphp
               <label for="edit_form_access">Form Access/Edit Access Type</label><br>
               <input type="checkbox" id="Sales" name="edit_form_access[]" value="sale" <?php if(in_array("sale",$edit_user_access)){ echo "checked";} ?>>
               <label for="Sales">Sales</label><br>
               <input type="checkbox" id="Planning" name="edit_form_access[]" value="planning"<?php if(in_array("planning",$edit_user_access)){ echo "checked";} ?>>
               <label for="Planning">Planning</label><br>
               <input type="checkbox" id="Permission" name="edit_form_access[]" value="permission"<?php if(in_array("permission",$edit_user_access)){ echo "checked";} ?>>
               <label for="Permission">Permission</label><br>
               <input type="checkbox" id="Build" name="edit_form_access[]" value="build"<?php if(in_array("build",$edit_user_access)){ echo "checked";} ?>>
               <label for="Build">Build</label><br>
               <input type="checkbox" id="Service Delivery" name="edit_form_access[]" value="service_delivery"<?php if(in_array("service_delivery",$edit_user_access)){ echo "checked";} ?>>
               <label for="Service Delivery">Service Delivery</label><br>
               <input type="checkbox" id="Read Only" name="edit_form_access[]" value="read_only"<?php if(in_array("read_only",$edit_user_access)){ echo "checked";} ?>>
               <label for="Read Only">Read Only</label><br>
               </div> 
               <div class="form-group">
               @php $edit_region = explode(",",$user['regions']); @endphp
               <label for="edit_form_access">Regions</label><br>
               <input type="checkbox" id="Eastern" name="region[]" value="Eastern Region"<?php if(in_array("Eastern Region",$edit_region)){ echo "checked";} ?>>
               <label for="Eastern Region">Eastern Region</label><br>
               <input type="checkbox" id="Northern" name="region[]" value="Northern Region"<?php if(in_array("Northern Region",$edit_region)){ echo "checked";} ?>>
               <label for="Northern Region">Northern Region</label><br>
               <input type="checkbox" id="Western" name="region[]" value="Western Region"<?php if(in_array("Western Region",$edit_region)){ echo "checked";} ?>>
               <label for="Western Region">Western Region</label><br>
               </div>
               <div class="form-group">
                  <label for="user_status">User Status</label>
                  <select class="form-control" name="user_status" id="user_status">
                      <option value="" selected>Please Select</option>
                      <option value="Active" <?php if($user->user_status == 'Active') { echo "selected"; } ?>>Active</option>
                      <option value="Pending" <?php if($user->user_status == 'Pending') { echo "selected"; } ?>>Pending</option>
                  </select>
               </div> 
                <div class="row">
                  <div class="col-12"> 
                   @if(in_array('all', $edit_access['edit_access_type']))
                        <input type="submit" value="Submit" class="btn btn-success">
                    @endif
                  </div>
                </div>
              </form>
            <!-- /.card-body -->
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