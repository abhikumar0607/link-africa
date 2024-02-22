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
                  <form method="POST" action="{{ route('admin.user-management.submit-add-new') }}" enctype="multipart/form-data">
                  @csrf
                @else
                  <form method="POST" action="#" enctype="multipart/form-data">
                @endif
                <div class="form-group">
                  <label for="employee_code">Emp Code</label>
                  <input type="text" name="employee_code" value="{{ old('employee_code') }}" id="employee_code" class="form-control">
               </div>
               <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" name="first_name" value="{{ old('first_name') }}" id="first_name" class="form-control">
               </div>
               <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" name="last_name" value="{{ old('last_name') }}" id="last_name" class="form-control">
               </div>
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror">
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" value="" id="password" class="form-control  @error('password') is-invalid @enderror">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong> 
                    </span>  
                  @enderror 
               </div>
              <div class="form-group">
                  <label>Birth Date:</label>
                  <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" value="{{ old('birth_date') }}" name="birth_date" id="birth_date" data-target="#custom_date_picker5">
                      <div class="input-group-append" data-target="#custom_date_picker5" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <label for="company_rule">Company Rule</label>
                  <select class="form-control" name="company_rule" id="company_rule">
                      <option value="" selected>Please Select</option>
                      <option value="LINK_AFRICA">LINK_AFRICA</option>
                      <option value="LINK_AFRICA_EPC">LINK_AFRICA_EPC</option>
                  </select>
               </div>   
               <div class="form-group">
                  <label for="cost_center">Cost Centre </label>
                  <select class="form-control" name="cost_center" id="cost_center">
                      <option value="" selected>Please Select</option>
                      <option value="Gauteng">Gauteng</option>
                      <option value="Durban">Durban</option>
                      <option value="Cape_Town">Cape Town</option>
                  </select>
               </div>  
               <div class="form-group">
                  <label for="department">Department</label>
                  <select class="form-control" name="department" id="department">
                      <option value="" selected>Please Select</option>
                      <option value="Executive">Executive</option>
                      <option value="Human_Recources">Human Recources</option>
                      <option value="Building">Building</option>
                      <option value="Permissions">Permissions</option>
                      <option value="OPS">OPS</option>
                      <option value="PMO">PMO</option>
                      <option value="Finance">Finance</option>
                      <option value="Sales">Sales</option>
                      <option value="IT">IT</option>
                      <option value="Planning">Planning</option>
                      <option value="Finance">Finance</option>
                      <option value="Regional_Management">Regional Management</option>
                      <option value="SHEQ">SHEQ</option>
                      <option value="Fulfillment">Fulfillment</option>
                  </select>
               </div>   
               <div class="form-group">
                  <label for="team">Team</label>
                  <select class="form-control" name="team" id="team">
                      <option value="" selected>Please Select</option>
                      <option value="Exco">Exco</option>
                      <option value="Human Resources">Human Resources</option>
                      <option value="Manco">Manco</option>
                      <option value="Admin">Admin</option>
                      <option value="IS">IS</option>
                      <option value="Wayleaves">Wayleaves</option>
                      <option value="Splicing">Splicing</option>
                      <option value="PMO">PMO</option>
                      <option value="Finance">Finance</option>
                      <option value="NOC">NOC</option>
                      <option value="Drill">Drill</option>
                      <option value="Project Lead">Project Lead</option>
                      <option value="Re-Instatement">Re-Instatement</option>
                      <option value="Management">Management</option>
                      <option value="Reception">Reception</option>
                      <option value="Planning">Planning</option>
                      <option value="Focus/Haul">Focus/Haul</option>
                      <option value="QA">QA</option>
                      <option value="AS Build">AS Build</option>
                      <option value="Jetting">Jetting</option>
                      <option value="Scan">Scan</option>
                      <option value="Survey">Survey</option>
                      <option value="GIS">GIS</option>
                      <option value="FTTB">FTTB</option>
                      <option value="Warehouse">Warehouse</option> 
                  </select>
               </div>
               <div class="form-group">
               <label for="edit_form_access">Form Access/Edit Access Type</label><br>
               <input type="checkbox" id="Sales" name="edit_form_access[]" value="sale">
               <label for="Sales">Sales</label><br>
               <input type="checkbox" id="Planning" name="edit_form_access[]" value="planning">
               <label for="Planning">Planning</label><br>
               <input type="checkbox" id="Permission" name="edit_form_access[]" value="permission">
               <label for="Permission">Permission</label><br>
               <input type="checkbox" id="Build" name="edit_form_access[]" value="build">
               <label for="Build">Build</label><br>
               <input type="checkbox" id="Service Delivery" name="edit_form_access[]" value="service_delivery">
               <label for="Service Delivery">Service Delivery</label><br>
               <input type="checkbox" id="Read Only" name="edit_form_access[]" value="read-only">
               <label for="Read Only">Read Only</label><br>
               </div>  
               <div class="form-group">
               <label for="edit_form_access">Regions</label><br>
               <input type="checkbox" id="Eastern" name="region[]" value="Eastern Region">
               <label for="Eastern Region">Eastern Region</label><br>
               <input type="checkbox" id="Northern" name="region[]" value="Northern Region">
               <label for="Northern Region">Northern Region</label><br>
               <input type="checkbox" id="Western" name="region[]" value="Western Region">
               <label for="Western Region">Western Region</label><br>
               </div>

               <div class="form-group">
                  <label for="user_status">User Status</label>
                  <select class="form-control" name="user_status" id="user_status">
                      <option value="" selected>Please Select</option>
                      <option value="Active">Active</option>
                      <option value="Pending">Pending</option>
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