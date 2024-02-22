@extends('support-dashboard.layouts.master')
@section('content')
 <!-- Header content -->
<div class="col-sm-12"> 
    <!-- Main content -->
    <section class="content" style="margin-top:50px;">
      <div class="row">
        <div class="col-md-12">
              <!-- /.card-header -->
              <div class="card-body La-scroll" style="padding:20px;">
                 <a href="{{ url('support/hardware-software-requirement') }}" class="btn btn-default drop-down-management">
                  Add New Software form
                  </a>
                <table class="table table-bordered table-striped" id="example">
                  <thead>
                  <tr class="sticky">
                    <th>ID</th>
                    <th>Employee Code</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Department</th>
                    <th>Employee Job Title</th>
                    <th>Region</th>
                    <th>Email Address</th>
                    <th>Type Of Computer Requied</th>
                    <th>Telephone/Phoneline Requirements</th>
                    <th>Printer Requirements</th>
                    <th>Software Requirements</th>
                    <th>Email Password</th>
                    <th>Rainbow Password</th>
                    <th>O2CAP Password</th>
                    <th>User Signature</th>
                    <th>User Signature Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($record as $software_detail)
                        <tr>
                        <td><a href="{{ url('support/single-software-hardware', $software_detail->id) }}">{{ $software_detail->id }}</a></td>
                            <td>{{ $software_detail->employee_code }}</td>
                            <td>{{ $software_detail->first_name }}</td>
                            <td>{{ $software_detail->last_name }}</td>
                            <td>{{ $software_detail->department }}</td>
                            <td>{{ $software_detail->employe_job_title }}</td>
                            <td>{{ $software_detail->region }}</td>
                            <td>{{ $software_detail->email_address }}</td>
                            <td>{{ $software_detail->type_of_computer_required }}</td>
                            <td>{{ $software_detail->telephone_requirement }}</td>
                            <td>{{ $software_detail->print_requirement }}</td>
                            <td>{{ $software_detail->software_requirement }}</td>
                            <td>{{ $software_detail->email_password }}</td>
                            <td>{{ $software_detail->rainbow_password }}</td>
                            <td>{{ $software_detail->o2cap_password }}</td>
                            <td>{{ $software_detail->user_signature }}</td>
                            <td>{{ $software_detail->user_signature_date }}</td>
                           
                         </tr>
                        @endforeach
                  </tbody>
                </table>
                <div class="pagination">
                </div>
            </div>
            <!-- /.card-body -->
          
          <!-- /.card -->
          
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
 @endsection