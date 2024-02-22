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
                  <a href="{{ url('support/asset-transform') }}" class="btn btn-default drop-down-management">
                  Add New Assest
                  </a>
                <table class="table table-bordered table-striped" id="example">
                  <thead>
                  <tr class="sticky">
                    <th>ID</th>
                    <th>EMP CODE</th>
                    <th>TRANSFER ASSET</th>
                    <th>DATE OF TRANSFER</th>
                    <th>NAME</th>
                    <th>TELEPHONE</th>
                    <th>EMAIL</th>
                    <th>DEVICE DESCRIPTION</th>
                    <th>DEVICE MAKE - MODEL</th>
                    <th>DEVICE SERIAL NUMBER</th>
                    <th>POWER CHORD/CHARGER</th>
                    <th>KEYS</th>
                    <th>ACCESS CARD</th>
                    <th>GATE REMOTES</th>
                    <th>MEASURING WHEEL</th>
                    <th>COMMENTS</th>
                    <th>STAFF SIGNATURE</th>
                    <th>LINK AFRICA REPRESENTATIVE</th>
                    <th>DATE</th>
                    <th>REGION</th>
                    <th>ASSET POSESSION</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                     $count = 1;
                    @endphp
                    @foreach($assest as $assest_detail)
                        <tr>
                        <td><a href="{{ url('support/single-asset-transform' ,$assest_detail->id) }}">{{ $assest_detail->id }}</a></td>
                            <td>{{ $assest_detail->emp_code }}</td>
                            <td>{{ $assest_detail->transfer_assest }}</td>
                            <td>{{ $assest_detail->date_of_transfer }}</td>
                            <td>{{ $assest_detail->name }}</td>
                            <td>{{ $assest_detail->telephone }}</td>
                            <td>{{ $assest_detail->email }}</td>
                            <td>{{ $assest_detail->device_description }}</td>
                            <td>{{ $assest_detail->device_make_model }}</td>
                            <td>{{ $assest_detail->device_serial_number }}</td>
                            <td>{{ $assest_detail->power_charger }}</td>
                            <td>{{ $assest_detail->keys }}</td>
                            <td>{{ $assest_detail->access_card }}</td>
                            <td>{{ $assest_detail->gate_remotes }}</td>
                            <td>{{ $assest_detail->measuring_wheel }}</td>
                            <td>{{ $assest_detail->comments }}</td>
                            <td>{{ $assest_detail->staff_signature }}</td>
                            <td>{{ $assest_detail->link_africa_representive }}</td>
                            <td>{{ $assest_detail->date }}</td>
                            <td>{{ $assest_detail->region }}</td>
                            <td>{{ $assest_detail->assest_posession }}</td>
                            
                        </tr>
                         @php $count++; @endphp
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