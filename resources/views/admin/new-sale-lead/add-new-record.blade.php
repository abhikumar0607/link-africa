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
    <section class="content">
      <div class="container-fluid">
        <div class="row cmmnt-frm">
          <!-- left column -->
          <div class="col-md-12">
              <div class="card La-add-scroll">
                  <div class="card-header">
                      <h3 class="card-title">Add New sales Lead</h3>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                    @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                    @if($edit_access['edit_access_type'] == 'all' || $edit_access['edit_access_type'] == 'sale')
                    <form action="{{ route('admin.submit.lead.sale.record') }}" method="POST" enctype="multipart/form-data" id="submit_lead_sale_form_file_record" class="edit_site_master_file_record"> 
                        {{ csrf_field() }} 
                    @else
                      <form method="POST" action="#" enctype="multipart/form-data">
                    @endif
                      <div class="card-body no-scroll-need">
                        <div class="row free-Qwe">
                            <div class="col-4">
                            <div class="form-group">
                                <label>Date Intiated:</label>
                                <div class="input-group date" id="custom_date_picker4" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input @error('date_intiated') is-invalid @enderror" name="date_intiated" id="date_intiated" data-target="#custom_date_picker4" value="{{ old('date_intiated') }}">
                                     @error('date_intiated')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-append" data-target="#custom_date_picker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                           <div class="col-4">
                            <div class="form-group">
                                <label>Customer name:</label>
                                <select class="form-control" name="customer_name" id="customer_name">
                                    @foreach($all_customers as $customers)
                                    <option value="{{ $customers['name'] }}">{{ $customers['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                           <div class="col-4">
                            <div class="form-group">
                                <label>KAM:</label>
                                <select class="form-control" name="kam" id="kam">
                                    <option value="Carla Thomas">Carla Thomas</option>
                                     <option value="Desrae Naidoo">Desrae Naidoo</option>
                                      <option value="George Fevrier">George Fevrier</option>
                                      <option value="Kobe Morifi">Kobe Morifi</option>
                                      <option value="Ndumiso Khumalo">Ndumiso Khumalo</option>
                                      <option value="Tharick Jithoo">Tharick Jithoo</option>
                                      <option value="Zandile Sibiya">Zandile Sibiya</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Segment:</label>
                                <select class="form-control" name="segment" id="segment">
                                    <option value="Bandwidth/BTS">Bandwidth/BTS</option>
                                     <option value="BUILD">BUILD</option>
                                      <option value="Build & Transfer">Build & Transfer</option>
                                      <option value="Co Build">Co Build</option>
                                      <option value="Lease">Lease</option>
                                      <option value="Sale">Sale</option>
                                </select>
                            </div>
                          </div>
                             <div class="col-4">
                            <div class="form-group">
                                <label>Province:</label>
                                <select class="form-control" name="province" id="province">
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Region:</label>
                                <select class="form-control" name="region" id="region">
                                    <option value="" selected>Please Select</option>
                                    <option value="Eastern Region">Eastern Region</option>
                                    <option value="Northern Region">Northern Region</option>
                                    <option value="Western Region">Western Region</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                          </div>
                          </div>
                          <div class="row thrd-Qw">
                          <div class="col-4">
                            <div class="form-group">
                                <label>Site Name:</label>
                                <input type="text" name="site_name" value="" id="site_name" class="form-control">
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Lease term in Months:</label> 
                                <select class="form-control" name="lease_term_in_months" id="lease_term_in_months">
                                     <option value="" selected>Please Select</option>
                                    <option value="1">1 month</option>
                                    <option  value="3">3 month</option>
                                    <option  value="6">6 month</option>
                                    <option  value="12">12 month</option>
                                    <option  value="24">24 month</option>  
                                    <option  value="36">36 month</option>
                                    <option  value="60">60 month</option>
                                    <option  value="180">180 month</option>
                                </select>
                            </div>
                          </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label>Expected close Month:</label>
                                <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="expected_close_month" id="expected_close_month" data-target="#custom_date_picker5" value="">
                                    <div class="input-group-append" data-target="#custom_date_picker5" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                           <div class="col-4">
                            <div class="form-group">
                                <label>Product:</label>
                                <select class="form-control" name="product" id="product">
                                     @foreach($record as $all_record)
                                    <option value="{{ $all_record['name'] }}">{{ $all_record['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Estimated MRC:</label>
                                <input type="text" name="estimated_mrc" value="" id="estimated_mrc" class="form-control">
                            </div>
                          </div>
                           <div class="col-4">
                              <div class="form-group">
                                <label>Expected Invoice Month:</label>
                                <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="expected_invoice_month" id="expected_invoice_month" data-target="#custom_date_picker6" value="">
                                    <div class="input-group-append" data-target="#custom_date_picker6" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Sales Stage:</label>
                                <select class="form-control" name="sales_stage" id="sales_stage">
                                    <option value="Feasibility">Feasibility</option>
                                     <option value="LLC Outstanding - PO">LLC Outstanding - PO</option>
                                      <option value="Lost">Lost</option>
                                      <option value="Negotiation">Negotiation</option>
                                      <option value="New Opportunity">New Opportunity</option>
                                      <option value="Proposal/Quotation">Proposal/Quotation</option>
                                      <option value="Purchase Order / Closed-Won">Purchase Order / Closed-Won</option>
                                      <option value="Qualified Opportunity">Qualified Opportunity</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Estimated NRC:</label>
                                <input type="text" name="estimated_nrc" value="" id="estimated_nrc" class="form-control">
                            </div>
                          </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label>Actual Closing Date:</label>
                                <div class="input-group date" id="custom_date_picker2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="actual_closing_date" id="actual_closing_date" data-target="#custom_date_picker2" value="">
                                    <div class="input-group-append" data-target="#custom_date_picker2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Probability:</label>
                                <select class="form-control" name="probability" id="probability">
                                    <option value="0%">0%</option>
                                     <option value="10%">10%</option>
                                      <option value="20%">20%</option>
                                      <option value="30%">30%</option>
                                      <option value="75%">75%</option>
                                      <option value="85%">85%</option>
                                      <option value="100%">100%</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                              <div class="form-group">
                                <label>Actual Invoice Date:</label>
                                <div class="input-group date" id="custom_date_picker3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="actual_invoice_date" id="actual_invoice_date" data-target="#custom_date_picker3" value="">
                                    <div class="input-group-append" data-target="#custom_date_picker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-4">
                          </div>
                          <div class="col-md-6">
                               <h2>Comments</h2>
                               <textarea id="w3review" name="comments">
                             </textarea> 
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        @if($edit_access['edit_access_type'] == 'all' || $edit_access['edit_access_type'] == 'sale')
                          <input type="submit" value="Submit" class="btn btn-success  ">
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
 @endsection