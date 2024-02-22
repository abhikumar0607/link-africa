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
                      <h3 class="card-title">Edit sales Pipe Line</h3>
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
                                    @if($record[0]['date_intiated'])
                                    <input type="text" class="form-control datetimepicker-input" name="date_intiated" id="date_intiated" data-target="#custom_date_picker4" value="{{ Carbon\Carbon::parse($record[0]['date_intiated'])->format('m/d/Y') }}">
                                    @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="date_intiated" id="date_intiated" data-target="#custom_date_picker">
                                    @endif
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
                                    <option value="{{ $customers['name'] }}" <?php if($record[0]['customer_name'] ==  $customers['name']) { echo 'selected'; } ?> >{{ $customers['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                           <div class="col-4">
                            <div class="form-group">
                                <label>KAM:</label>
                                <select class="form-control" name="kam" id="kam">
                                    <option value="Carla Thomas" <?php if($record[0]['kam'] == 'Carla Thomas'){ echo 'selected'; } ?>>Carla Thomas</option>
                                    <option value="Desrae Naidoo" <?php if($record[0]['kam'] == 'Desrae Naidoo'){ echo 'selected'; } ?>>Desrae Naidoo</option>
                                    <option value="George Fevrier" <?php if($record[0]['kam'] == 'George Fevrier'){ echo 'selected'; } ?>>George Fevrier</option>
                                    <option value="Kobe Morifi" <?php if($record[0]['kam'] == 'Kobe Morifi') { echo 'selected'; } ?>>Kobe Morifi</option>
                                    <option value="Ndumiso Khumalo" <?php if($record[0]['kam'] == 'Ndumiso Khumalo') { echo 'selected'; } ?>>Ndumiso Khumalo</option> 
                                    <option value="Nokuthula Ndumo" <?php if($record[0]['kam'] == 'Nokuthula Ndumo') { echo 'selected'; } ?>>Nokuthula Ndumo</option> 
                                    <option value="Tharick Jithoo" <?php if($record[0]['kam'] == 'Tharick Jithoo') { echo 'selected'; } ?>>Tharick Jithoo</option>
                                   <option value="Zandile Sibiya" <?php if($record[0]['kam'] == 'Zandile Sibiya'){ echo 'selected'; } ?>>Zandile Sibiya</option>
                                    
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Segment:</label>
                                <select class="form-control" name="segment" id="segment">
                                    <option value="Bandwidth/BTS" <?php if($record[0]['segment'] == 'Bandwidth/BTS'){ echo 'selected'; } ?>>Bandwidth/BTS</option>
                                    <option value="BUILD" <?php if($record[0]['segment'] == 'BUILD'){ echo 'selected'; } ?>>BUILD</option> 
                                    <option value="Build & Transfer" <?php if($record[0]['segment'] == 'Build & Transfer'){ echo 'selected'; } ?>>Build & Transfer</option> 
                                    <option value="Co Build" <?php if($record[0]['segment'] == 'Co Build'){ echo 'selected'; } ?>>Co Build</option> 
                                    <option value="Lease" <?php if($record[0]['segment'] == 'Lease'){ echo 'selected'; } ?>>Lease</option>
                                    <option value="Sale" <?php if($record[0]['segment'] == 'Sale'){ echo 'selected'; } ?>>Sale</option>
                                </select>
                            </div>
                          </div>
                             <div class="col-4">
                            <div class="form-group">
                                <label>Province:</label>
                                <select class="form-control" name="province" id="province">
                                    <option value="GP" <?php if($record[0]['province'] == 'GP'){ echo 'selected'; } ?>>GP</option>
                                    <option value="NW" <?php if($record[0]['province'] == 'NW'){ echo 'selected'; } ?>>NW</option>
                                    <option value="KZN" <?php if($record[0]['province'] == 'KZN'){ echo 'selected'; } ?>>KZN</option>
                                    <option value="OFS" <?php if($record[0]['province'] == 'OFS'){ echo 'selected'; } ?>>OFS</option>
                                    <option value="PMB" <?php if($record[0]['province'] == 'PMB'){ echo 'selected'; } ?>>PMB</option>
                                    <option value="TSH" <?php if($record[0]['province'] == 'TSH'){ echo 'selected'; } ?>>TSH</option>
                                    <option value="WC" <?php if($record[0]['province'] == 'WC'){ echo 'selected'; } ?>>WC</option>
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
                                <input type="text" name="site_name" value="{{ $record[0]['site_name'] }}" id="site_name" class="form-control">
                            </div>
                          </div>
                           <div class="col-4">
                            <div class="form-group">
                                <label>Lease Term Months:</label>
                                <input type="text" name="lease_term_months" value="{{ $record[0]['lease_term_months'] }}" id="lease_term_months" class="form-control">
                            </div>
                          </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label>Expected close Month:</label>
                                <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="expected_close_month" id="expected_close_month" data-target="#custom_date_picker5" value="{{ Carbon\Carbon::parse($record[0]['expected_close_month'])->format('m/d/Y') }}">
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
                                     @foreach($product as $all_product)
                                    <option value="{{ $all_product['name'] }}" <?php if($record[0]['product'] ==  $all_product['name']) { echo 'selected'; } ?> >{{ $all_product['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Estimated MRC:</label>
                                <input type="text" name="estimated_mrc" value="{{ $record[0]['estimated_mrc'] }}" id="estimated_mrc" class="form-control">
                            </div>
                          </div>
                           <div class="col-4">
                              <div class="form-group">
                                <label>Expected Invoice Month:</label>
                                <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="expected_invoice_month" id="expected_invoice_month" data-target="#custom_date_picker6" value="{{ Carbon\Carbon::parse($record[0]['expected_invoice_month'])->format('m/d/Y') }}">
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
                                    <option value="Feasibility" <?php if($record[0]['sales_stage'] == 'Feasibility'){ echo 'selected'; } ?>>Feasibility</option>
                                     <option value="LLC Outstanding - PO" <?php if($record[0]['sales_stage'] == 'LLC Outstanding - PO'){ echo 'selected'; } ?>>LLC Outstanding - PO</option>
                                      <option value="Lost" <?php if($record[0]['sales_stage'] == 'Lost'){ echo 'selected'; } ?>>Lost</option>
                                      <option value="Negotiation" <?php if($record[0]['sales_stage'] == 'Negotiation'){ echo 'selected'; } ?>>Negotiation</option>
                                      <option value="New Opportunity" <?php if($record[0]['sales_stage'] == 'New Opportunity'){ echo 'selected'; } ?>>New Opportunity</option>
                                      <option value="Proposal/Quotation" <?php if($record[0]['sales_stage'] == 'Proposal/Quotation'){ echo 'selected'; } ?>>Proposal/Quotation</option>
                                      <option value="Purchase Order / Closed-Won" <?php if($record[0]['sales_stage'] == 'Purchase Order / Closed-Won'){ echo 'selected'; } ?>>Purchase Order / Closed-Won</option>
                                      <option value="Qualified Opportunity" <?php if($record[0]['sales_stage'] == 'Qualified Opportunity'){ echo 'selected'; } ?>>Qualified Opportunity</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group">
                                <label>Estimated NRC:</label>
                                <input type="text" name="estimated_nrc" value="{{ $record[0]['estimated_nrc'] }}" id="estimated_nrc" class="form-control">
                            </div>
                          </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label>Actual Closing Date:</label>
                                <div class="input-group date" id="custom_date_picker2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="actual_closing_date" id="actual_closing_date" data-target="#custom_date_picker2" value="{{ Carbon\Carbon::parse($record[0]['actual_closing_date'])->format('m/d/Y') }}">
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
                                    <option value="0%" <?php if($record[0]['probability'] == '0%'){ echo 'selected'; } ?>>0%</option>
                                     <option value="10%" <?php if($record[0]['probability'] == '10%'){ echo 'selected'; } ?>>10%</option>
                                      <option value="20%" <?php if($record[0]['probability'] == '20%'){ echo 'selected'; } ?>>20%</option>
                                      <option value="30%" <?php if($record[0]['probability'] == '30%'){ echo 'selected'; } ?>>30%</option>
                                      <option value="75%" <?php if($record[0]['probability'] == '75%'){ echo 'selected'; } ?>>75%</option>
                                      <option value="85%" <?php if($record[0]['probability'] == '85%'){ echo 'selected'; } ?>>85%</option>
                                      <option value="100%" <?php if($record[0]['probability'] == '100%'){ echo 'selected'; } ?>>100%</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-4">
                              <div class="form-group">
                                <label>Actual Invoice Date:</label>
                                <div class="input-group date" id="custom_date_picker3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="actual_invoice_date" id="actual_invoice_date" data-target="#custom_date_picker3" value="{{ Carbon\Carbon::parse($record[0]['actual_invoice_date'])->format('m/d/Y') }}">
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
                               <textarea id="w3review" name="comments">{{ $record[0]['comments'] }}
                             </textarea> 
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        @if($edit_access['edit_access_type'] == 'all' || $edit_access['edit_access_type'] == 'sale')
                          <button type="submit" class="btn btn-primary">Update</button>
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