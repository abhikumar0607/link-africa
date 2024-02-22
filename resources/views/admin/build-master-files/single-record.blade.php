@extends('admin.layouts.master')
 @section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.build-master-files.build-header')
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content --> 
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Edit Build</h3></br>
                    @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
                  </div>
                  @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
                  @if(in_array('all', $edit_access['edit_access_type']) OR in_array('build', $edit_access['edit_access_type']))
                    <form action="{{ route('admin.build.update-record', $record[0]['id']) }}" method="POST" enctype="multipart/form-data" id="update_build_record"> 
                    {{ csrf_field() }} 
                  @else
                    <form method="POST" action="#" enctype="multipart/form-data">
                  @endif
                      <div class="card-body">
                        <div class="row">
                          <div class="col-3">
                              <div class="form-group">
                                <label>Service ID:</label>
                                <input type="text" class="form-control" name="service_id" value="{{ $record[0]['service_id'] }}" id="service_id">
                                @if ($errors->has('service_id'))
                                    <span class="help-block">
                                      <p>{{ $errors->first('service_id') }}</p>
                                    </span>
                                @endif
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>Circuit ID:</label>
                                <input type="text" name="circuit_id" value="{{ $record[0]['circuit_id'] }}" id="circuit_id" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                              <label>DATENEW:</label>
                                <div class="input-group date" id="custom_date_picker" data-target-input="nearest">
                                    @if($record[0]['datenew'])
                                        <input type="text" value="{{ Carbon\Carbon::parse($record[0]['datenew'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="datenew" id="datenew" data-target="#custom_date_picker">
                                    @else
                                        <input type="text" value="" class="form-control datetimepicker-input" name="datenew" id="datenew" data-target="#custom_date_picker">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>BUILD STATUS:</label>
                                <select class="form-control" name="build_status" id="build_status">
                                    <option value="">Select Project Status</option>
                                    <option value="build">build</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>BUILD DURATION:</label>
                                <input type="text" name="build_duration" value="{{ $record[0]['build_duration'] }}" id="build_duration" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label>PLANNED START DATE:</label>
                                <div class="input-group date" id="custom_date_picker2" data-target-input="nearest">
                                    @if($record[0]['planned_start_date'])
                                        <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planned_start_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="planned_start_date" id="planned_start_date" data-target="#custom_date_picker2">
                                    @else
                                       <input type="text" value="" class="form-control datetimepicker-input" name="planned_start_date" id="planned_start_date" data-target="#custom_date_picker2">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>REVISED BUILD START DATE:</label>
                                <div class="input-group date" id="custom_date_picker3" data-target-input="nearest">
                                    @if($record[0]['revised_build_start_date'])
                                        <input type="text" value="{{ Carbon\Carbon::parse($record[0]['revised_build_start_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="revised_build_start_date" id="revised_build_start_date" data-target="#custom_date_picker3">
                                    @else
                                         <input type="text" value="" class="form-control datetimepicker-input" name="revised_build_start_date" id="revised_build_start_date" data-target="#custom_date_picker3">
                                    @endif
                                    <div class="input-group-append" data-target="#custom_date_picker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        <div class="col-3">
                        <div class="form-group">
                            <label>REVISED BUILD CO DATE:</label>
                            <div class="input-group date" id="custom_date_picker4" data-target-input="nearest">
                                @if($record[0]['revised_build_co_date'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['revised_build_co_date'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="revised_build_co_date" id="revised_build_co_date" data-target="#cuom_date_picker4">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="revised_build_co_date" id="revised_build_co_date" data-target="#custom_date_picker4">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker4" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>ACTUAL BUILD COMPLETION DATE:</label>
                            <div class="input-group date" id="custom_date_picker17" data-target-input="nearest">
                                @if($record[0]['actual_build_completion_date'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['actual_build_completion_date'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="actual_build_completion_date" id="actual_build_completion_date" data-target="#cuom_date_picker17">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="actual_build_completion_date" id="actual_build_completion_date" data-target="#custom_date_picker17">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker17" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP CONTRACTOR:</label>
                                <input type="text" name="isp_contractor" value="{{ $record[0]['isp_contractor'] }}" id="isp_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP CONTRACTOR:</label>
                                <input type="text" name="osp_contractor" value="{{ $record[0]['osp_contractor'] }}" id="osp_contractor" class="form-control">
                            </div>
                          </div>
                         
                          <div class="col-3">
                            <div class="form-group">
                                <label>PROJECT LEADER:</label>
                                <input type="text" name="project_leader" value="{{ $record[0]['project_leader'] }}" id="project_leader" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>BUILD COMPLETION:</label>
                                <input type="text" name="build_completion" value="{{ $record[0]['build_completion'] }}" id="build_completion" class="form-control">
                            </div>
                          </div>
                        <div class="col-3">
                        <div class="form-group">
                            <label>TOC SUBMITTED:</label>
                            <div class="input-group date" id="custom_date_picker5" data-target-input="nearest">
                                @if($record[0]['toc_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['toc_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="toc_submitted" id="toc_submitted" data-target="#cuom_date_picker5">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="toc_submitted" id="toc_submitted" data-target="#custom_date_picker5">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker5" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                         <div class="col-3">
                        <div class="form-group">
                            <label>TOC RECEIVED:</label>
                            <div class="input-group date" id="custom_date_picker6" data-target-input="nearest">
                                @if($record[0]['toc_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['toc_received'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="toc_received" id="toc_received" data-target="#cuom_date_picker6">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="toc_received" id="toc_received" data-target="#custom_date_picker6">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker6" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OTOC:</label>
                                <input type="text" name="otoc" value="{{ $record[0]['otoc'] }}" id="otoc" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>POTOC:</label>
                                <input type="text" name="potoc" value="{{ $record[0]['potoc'] }}" id="potoc" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>COMMENTS:</label>
                                <input type="text" name="comments" value="{{ $record[0]['comments'] }}" id="comments" class="form-control">
                            </div>
                          </div>
                            <div class="col-3">
                        <div class="form-group">
                            <label>PO REQUESTED:</label>
                            <div class="input-group date" id="custom_date_picker7" data-target-input="nearest">
                                @if($record[0]['po_requested'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['po_requested'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="po_requested" id="po_requested" data-target="#cuom_date_picker7">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="po_requested" id="po_requested" data-target="#custom_date_picker7">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker7" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>PO RECEIVED:</label>
                            <div class="input-group date" id="custom_date_picker8" data-target-input="nearest">
                                @if($record[0]['po_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['po_received'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="po_received" id="po_received" data-target="#cuom_date_picker8">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="po_received" id="po_received" data-target="#custom_date_picker8">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker8" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A PROJECT LEADER:</label>
                                <input type="text" name="isp_a_project_leader" value="{{ $record[0]['isp_a_project_leader'] }}" id="isp_a_project_leader" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A CIVIL CONTRACTOR:</label>
                                <input type="text" name="isp_a_civil_contractor" value="{{ $record[0]['isp_a_civil_contractor'] }}" id="isp_a_civil_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A JETTING CONTRACTOR:</label>
                                <input type="text" name="isp_a_jetting_contractor" value="{{ $record[0]['isp_a_jetting_contractor'] }}" id="isp_a_jetting_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A RE INSTATEMENT CONTRACTOR:</label>
                                <input type="text" name="isp_a_re_instatement_contractor" value="{{ $record[0]['isp_a_re_instatement_contractor'] }}" id="isp_a_re_instatement_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A DRILLING CONTRACTOR:</label>
                                <input type="text" name="isp_a_drilling_contractor" value="{{ $record[0]['isp_a_drilling_contractor'] }}" id="isp_a_drilling_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A FLOATING CONTRACTOR:</label>
                                 <input type="text" name="isp_a_floating_contractor" value="{{ $record[0]['isp_a_floating_contractor'] }}" id="isp_a_floating_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A FOCUS CONTRACTOR:</label>
                                <input type="text" name="isp_a_focus_contractor" value="{{ $record[0]['isp_a_focus_contractor'] }}" id="isp_a_focus_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B PROJECT LEADER:</label>
                                <input type="text" name="isp_b_project_leader" value="{{ $record[0]['isp_b_project_leader'] }}" id="isp_b_project_leader" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B CIVIL CONTRACTOR:</label>
                                <input type="text" name="isp_b_civil_contractor" value="{{ $record[0]['isp_b_civil_contractor'] }}" id="isp_b_civil_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B JETTING CONTRACTOR:</label>
                                <input type="text" name="isp_b_jetting_contractor" value="{{ $record[0]['isp_b_jetting_contractor'] }}" id="isp_b_jetting_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B RE INSTATEMENT CONTRACTOR:</label>
                                <input type="text" name="isp_b_re_instatement_contractor" value="{{ $record[0]['isp_b_re_instatement_contractor'] }}" id="isp_b_re_instatement_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B DRILLING CONTRACTOR:</label>
                                <input type="text" name="isp_b_drilling_contractor" value="{{ $record[0]['isp_b_drilling_contractor'] }}" id="isp_b_drilling_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B FLOATING CONTRACTOR:</label>
                                <input type="text" name="isp_b_floating_contractor" value="{{ $record[0]['isp_b_floating_contractor'] }}" id="isp_b_floating_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B FOCUS CONTRACTOR:</label>
                                <input type="text" name="isp_b_focus_contractor" value="{{ $record[0]['isp_b_focus_contractor'] }}" id="isp_b_focus_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP PROJECT LEADER:</label>
                                <input type="text" name="osp_project_leader" value="{{ $record[0]['osp_project_leader'] }}" id="osp_project_leader" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP CIVIL CONTRACTOR:</label>
                                <input type="text" name="osp_civil_contractor" value="{{ $record[0]['osp_civil_contractor'] }}" id="osp_civil_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP JETTING CONTRACTOR:</label>
                                <input type="text" name="osp_jetting_contractor" value="{{ $record[0]['osp_jetting_contractor'] }}" id="osp_jetting_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP RE INSTATEMENT CONTRACTOR:</label>
                                <input type="text" name="osp_re_instatement_contractor" value="{{ $record[0]['osp_re_instatement_contractor'] }}" id="osp_re_instatement_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP DRILLING CONTRACTOR :</label>
                                <input type="text" name="osp_drilling_contractor" value="{{ $record[0]['osp_drilling_contractor'] }}" id="osp_drilling_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP FLOATING CONTRACTOR:</label>
                                <input type="text" name="osp_focus_contractor" value="{{ $record[0]['osp_focus_contractor'] }}" id="osp_focus_contractor" class="form-control">
                            </div>
                          </div>
                            <div class="col-3">
                            <div class="form-group">
                                <label>OSP FOCUS CONTRACTOR:</label>
                                <input type="text" name="osp_focus_contractor" value="{{ $record[0]['osp_focus_contractor'] }}" id="osp_focus_contractor" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>SPLICING TEAM:</label>
                                <input type="text" name="splicing_team" value="{{ $record[0]['splicing_team'] }}" id="splicing_team" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>NAME:</label>
                                <input type="text" name="name" value="{{ $record[0]['name'] }}" id="name" class="form-control">
                            </div>
                          </div>
                       
                            <div class="col-3">
                        <div class="form-group">
                            <label>PROVINCE:</label>
                            <div class="input-group date" id="custom_date_picker20" data-target-input="nearest">
                                @if($record[0]['province'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['province'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="province" id="province" data-target="#cuom_date_picker20">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="province" id="province" data-target="#custom_date_picker20">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker20" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                          <div class="col-3">
                        <div class="form-group">
                            <label>BUILD PLANNED COMPLETION DATES:</label>
                            <div class="input-group date" id="custom_date_picker9" data-target-input="nearest">
                                @if($record[0]['build_planned_completion_dates'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['build_planned_completion_dates'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="build_planned_completion_dates" id="build_planned_completion_dates" data-target="#cuom_date_picker9">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="build_planned_completion_dates" id="build_planned_completion_dates" data-target="#custom_date_picker9">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker9" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                           <div class="col-3">
                        <div class="form-group">
                            <label>OSP ASBUILD SUBMISSION:</label>
                            <div class="input-group date" id="custom_date_picker10" data-target-input="nearest">
                                @if($record[0]['osp_asbuild_submission'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['osp_asbuild_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-istnput" name="osp_asbuild_submission" id="osp_asbuild_submission" data-target="#cuom_date_picker10">
                                @else
                                     <input type="text" value="" class="form-control datetimepicker-input" name="osp_asbuild_submission" id="osp_asbuild_submission" data-target="#custom_date_picker10">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker10" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                           <div class="col-3">
                        <div class="form-group">
                            <label>ISP ASBUILD SUBMISSION:</label>
                            <div class="input-group date" id="custom_date_picker11" data-target-input="nearest">
                                @if($record[0]['isp_asbuild_submission'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['isp_asbuild_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="isp_asbuild_submission" id="isp_asbuild_submission" data-target="#custom_date_picker11">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="isp_asbuild_submission" id="isp_asbuild_submission" data-target="#custom_date_picker11">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker11" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                           <div class="col-3">
                        <div class="form-group">
                            <label>OSP ASBUILD RECEIVED:</label>
                            <div class="input-group date" id="custom_date_picker12" data-target-input="nearest">
                                @if($record[0]['osp_asbuild_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['osp_asbuild_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="osp_asbuild_received" id="osp_asbuild_received" data-target="#custom_date_picker12">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="osp_asbuild_received" id="osp_asbuild_received" data-target="#custom_date_picker12">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker12" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                          <div class="col-3">
                        <div class="form-group">
                            <label>ISP ASBUILD RECEIVED:</label>
                            <div class="input-group date" id="custom_date_picker13" data-target-input="nearest">
                                @if($record[0]['isp_asbuild_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['isp_asbuild_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="isp_asbuild_received" id="isp_asbuild_received" data-target="#custom_date_picker13">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="isp_asbuild_received" id="isp_asbuild_received" data-target="#custom_date_picker13">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker13" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                        <div class="form-group">
                            <label>VO SUBMITTED:</label>
                            <div class="input-group date" id="custom_date_picker14" data-target-input="nearest">
                                @if($record[0]['vo_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_submitted" id="vo_submitted" data-target="#custom_date_picker14">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_submitted" id="vo_submitted" data-target="#custom_date_picker14">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker14" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>VO RECEIVED:</label>
                            <div class="input-group date" id="custom_date_picker15" data-target-input="nearest">
                                @if($record[0]['vo_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_received" id="vo_received" data-target="#custom_date_picker15">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_received" id="vo_received" data-target="#custom_date_picker15">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker15" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>VO PO REQUESTED:</label>
                            <div class="input-group date" id="custom_date_picker16" data-target-input="nearest">
                                @if($record[0]['vo_po_requested'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_po_requested'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_po_requested" id="vo_po_requested" data-target="#custom_date_picker16">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_po_requested" id="vo_po_requested" data-target="#custom_date_picker16">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker16" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>VO PO RECEIVED:</label>
                            <div class="input-group date" id="custom_date_picker18" data-target-input="nearest">
                                @if($record[0]['vo_po_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_po_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_po_received" id="vo_po_received" data-target="#custom_date_picker18">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_po_received" id="vo_po_received" data-target="#custom_date_picker18">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker18" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>VO SUBMITTED2:</label>
                            <div class="input-group date" id="custom_date_picker19" data-target-input="nearest">
                                @if($record[0]['vo_submitted2'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_submitted2'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_submitted2" id="vo_submitted2" data-target="#custom_date_picker19">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_submitted2" id="vo_submitted2" data-target="#custom_date_picker19">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker19" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                            <label>VO RECEIVED2:</label>
                            <div class="input-group date" id="custom_date_picker21" data-target-input="nearest">
                                @if($record[0]['vo_received2'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_received2'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_received2" id="vo_received2" data-target="#custom_date_picker21">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_received2" id="vo_received2" data-target="#custom_date_picker21">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker21" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                         <div class="col-3">
                        <div class="form-group">
                            <label>VO PO REQUESTED2:</label>
                            <div class="input-group date" id="custom_date_picker22" data-target-input="nearest">
                                @if($record[0]['vo_po_requested2'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_po_requested2'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_po_requested2" id="vo_po_requested2" data-target="#custom_date_picker22">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_po_requested2" id="vo_po_requested2" data-target="#custom_date_picker22">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker22" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                        <div class="form-group">
                            <label>VO PO RECEIVED2:</label>
                            <div class="input-group date" id="custom_date_picker24" data-target-input="nearest">
                                @if($record[0]['vo_po_received2'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_po_received2'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_po_received2" id="vo_po_received2" data-target="#custom_date_picker24">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_po_received2" id="vo_po_received2" data-target="#custom_date_picker24">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker24" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                      <div class="form-group">
                            <label>VO SUBMITTED3:</label>
                            <div class="input-group date" id="custom_date_picker25" data-target-input="nearest">
                                @if($record[0]['vo_received3'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_received3'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_received3" id="vo_received3" data-target="#custom_date_picker25">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_received3" id="vo_received3" data-target="#custom_date_picker25">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker25" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                      <div class="form-group">
                            <label>VO PO REQUESTED3:</label>
                            <div class="input-group date" id="custom_date_picker28" data-target-input="nearest">
                                @if($record[0]['vo_po_requested3'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_po_requested3'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_po_requested3" id="vo_po_requested3" data-target="#custom_date_picker28">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_po_requested3" id="vo_po_requested3" data-target="#custom_date_picker28">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker28" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                         <div class="col-3">
                      <div class="form-group">
                            <label>VO PO RECEIVED3:</label>
                            <div class="input-group date" id="custom_date_picker27" data-target-input="nearest">
                                @if($record[0]['vo_po_received3'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_po_received3'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_po_received3" id="vo_po_received3" data-target="#custom_date_picker27">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_po_received3" id="vo_po_received3" data-target="#custom_date_picker27">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker27" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                      <div class="form-group">
                            <label>VO SUBMITTED4:</label>
                            <div class="input-group date" id="custom_date_picker30" data-target-input="nearest">
                                @if($record[0]['vo_submitted4'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_submitted4'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_submitted4" id="vo_submitted4" data-target="#custom_date_picker30">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_submitted4" id="vo_submitted4" data-target="#custom_date_picker30">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker30" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                       <div class="col-3">
                      <div class="form-group">
                            <label>VO RECEIVED4:</label>
                            <div class="input-group date" id="custom_date_picker31" data-target-input="nearest">
                                @if($record[0]['vo_received4'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_received4'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_received4" id="vo_received4" data-target="#custom_date_picker31">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_received4" id="vo_received4" data-target="#custom_date_picker31">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker31" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                          <div class="col-3">
                      <div class="form-group">
                            <label>VO PO REQUESTED4:</label>
                            <div class="input-group date" id="custom_date_picker33" data-target-input="nearest">
                                @if($record[0]['vo_po_requested4'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_po_requested4'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_po_requested4" id="vo_po_requested4" data-target="#custom_date_picker33">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_po_requested4" id="vo_po_requested4" data-target="#custom_date_picker33">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker33" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                          <div class="col-3">
                      <div class="form-group">
                            <label>VO PO RECEIVED4:</label>
                            <div class="input-group date" id="custom_date_picker34" data-target-input="nearest">
                                @if($record[0]['vo_po_received4'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['vo_po_received4'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="vo_po_received4" id="vo_po_received4" data-target="#custom_date_picker34">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="vo_po_received4" id="vo_po_received4" data-target="#custom_date_picker34">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker34" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                              <div class="col-3">
                           <div class="form-group">
                            <label>BUILD OSP STATUS:</label>
                            <div class="input-group date" id="custom_date_picker38" data-target-input="nearest">
                                @if($record[0]['build_osp_status'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['build_osp_status'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="build_osp_status" id="build_osp_status" data-target="#custom_date_picker38">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="build_osp_status" id="build_osp_status" data-target="#custom_date_picker38">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker38" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                            <div class="col-3">
                           <div class="form-group">
                            <label>QA REQUESTED:</label>
                            <div class="input-group date" id="custom_date_picker36" data-target-input="nearest">
                                @if($record[0]['qa_requested'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['qa_requested'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="qa_requested" id="qa_requested" data-target="#custom_date_picker36">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="qa_requested" id="qa_requested" data-target="#custom_date_picker36">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker36" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                      <div class="form-group">
                            <label>FAC SUBMITTED:</label>
                            <div class="input-group date" id="custom_date_picker37" data-target-input="nearest">
                                @if($record[0]['fac_submitted'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['fac_submitted'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="fac_submitted" id="fac_submitted" data-target="#custom_date_picker37">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="fac_submitted" id="fac_submitted" data-target="#custom_date_picker37">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker37" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                         <div class="col-3">
                      <div class="form-group">
                            <label>FAC RECEIVED:</label>
                            <div class="input-group date" id="custom_date_picker39" data-target-input="nearest">
                                @if($record[0]['fac_received'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['fac_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="fac_received" id="fac_received" data-target="#custom_date_picker39">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="fac_received" id="fac_received" data-target="#custom_date_picker39">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker39" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP BUILD DISTANCE - TRENCH:</label>
                                <input type="text" name="actual_osp_build_distance_trench" value="{{ $record[0]['actual_osp_build_distance_trench'] }}" id="actual_osp_build_distance_trench" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP BUILD DISTANCE - 3RD PARTY DUCTS:</label>
                                <input type="text" name="actual_osp_build_distance_3rd_party_ducts" value="{{ $record[0]['actual_osp_build_distance_3rd_party_ducts'] }}" id="actual_osp_build_distance_3rd_party_ducts" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP BUILD LA EXISTING DUCT:</label>
                                <input type="text" name="actual_osp_build_la_existing_duct" value="{{ $record[0]['actual_osp_build_la_existing_duct'] }}" id="actual_osp_build_la_existing_duct" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP BUILD LA EXISTING NETWORK:</label>
                                <input type="text" name="actual_osp_build_la_existing_network" value="{{ $record[0]['actual_osp_build_la_existing_network'] }}" id="actual_osp_build_la_existing_network" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP BUILD DISTANCE - FOCUS:</label>
                                <input type="text" name="actual_osp_build_distance_focus" value="{{ $record[0]['actual_osp_build_distance_focus'] }}" id="actual_osp_build_distance_focus" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP BUILD IN BUILDING CONDUITS:</label>
                                <input type="text" name="actual_osp_build_in_building_conduits" value="{{ $record[0]['actual_osp_build_in_building_conduits'] }}" id="actual_osp_build_in_building_conduits" class="form-control">
                            </div>
                          </div>
                      
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP 110 SLEEVES BUILD:</label>
                                <input type="text" name="actual_osp_110_sleeves_build" value="{{ $record[0]['actual_osp_110_sleeves_build'] }}" id="actual_osp_110_sleeves_build" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP DRILLING DISTANCE BUILD:</label>
                                <input type="text" name="actual_osp_drilling_distance_build" value="{{ $record[0]['actual_osp_drilling_distance_build'] }}" id="actual_osp_drilling_distance_build" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP MICRO DUCT DISTANCE BUILD:</label>
                                <input type="text" name="actual_osp_micro_duct_distance_build" value="{{ $record[0]['actual_osp_micro_duct_distance_build'] }}" id="actual_osp_micro_duct_distance_build" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OPS BUILD TOTAL DISTANCE:</label>
                                <input type="text" name="actual_ops_build_total_distance" value="{{ $record[0]['actual_ops_build_total_distance'] }}" id="actual_ops_build_total_distance" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL BUILD COMPLETION:</label>
                                <input type="text" name="actual_build_completion" value="{{ $record[0]['actual_build_completion'] }}" id="actual_build_completion" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP MH 500 X 500 BUILD:</label>
                                <input type="text" name="actual_osp_mh_500_x_500_build" value="{{ $record[0]['actual_osp_mh_500_x_500_build'] }}" id="actual_osp_mh_500_x_500_build" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ACTUAL OSP MH 1000 X 500 BUILD:</label>
                                <input type="text" name="actual_osp_mh_1000_x_500_build" value="{{ $record[0]['actual_osp_mh_1000_x_500_build'] }}" id="actual_osp_mh_1000_x_500_build" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP ASB - TRENCH:</label>
                                <input type="text" name="osp_asb_trench" value="{{ $record[0]['osp_asb_trench'] }}" id="osp_asb_trench" class="form-control">
                            </div>
                          </div>
                        
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP ASB - 3RD PARTY DUCTS:</label>
                                <input type="text" name="osp_asb_3rd_party_ducts" value="{{ $record[0]['osp_asb_3rd_party_ducts'] }}" id="osp_asb_3rd_party_ducts" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP ASB - LA EXISTING DUCT:</label>
                                <input type="text" name="osp_asb_la_existing_duct" value="{{ $record[0]['osp_asb_la_existing_duct'] }}" id="osp_asb_la_existing_duct" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP ASB - EXISTING NETWORK:</label>
                                <input type="text" name="osp_asb_existing_network" value="{{ $record[0]['osp_asb_existing_network'] }}" id="osp_asb_existing_network" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP ASB - DISTANCE – FOCUS:</label>
                                <input type="text" name="osp_asb_distance_focus" value="{{ $record[0]['osp_asb_distance_focus'] }}" id="osp_asb_distance_focus" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>OSP ASB – IN BUILDING CONDUITS:</label>
                                <input type="text" name="osp_asb_in_building_conduits" value="{{ $record[0]['osp_asb_in_building_conduits'] }}" id="osp_asb_in_building_conduits" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A ASB - TRENCH:</label>
                                <input type="text" name="isp_a_asb_trench" value="{{ $record[0]['isp_a_asb_trench'] }}" id="isp_a_asb_trench" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A ASB - 3RD PARTY DUCTS:</label>
                                <input type="text" name="isp_a_asb_3rd_party_ducts" value="{{ $record[0]['isp_a_asb_3rd_party_ducts'] }}" id="isp_a_asb_3rd_party_ducts" class="form-control">
                            </div>
                          </div>
                       
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A ASB - LA EXISTING DUCT:</label>
                                <input type="text" name="isp_a_asb_la_existing_duct" value="{{ $record[0]['isp_a_asb_la_existing_duct'] }}" id="isp_a_asb_la_existing_duct" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A ASB - EXISTING NETWORK:</label>
                                <input type="text" name="isp_a_asb_existing_network" value="{{ $record[0]['isp_a_asb_existing_network'] }}" id="isp_a_asb_existing_network" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A ASB - DISTANCE – FOCUS:</label>
                                <input type="text" name="isp_a_asb_distance_focus" value="{{ $record[0]['isp_a_asb_distance_focus'] }}" id="isp_a_asb_distance_focus" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP A ASB - IN BUILDING CONDUITS:</label>
                                <input type="text" name="isp_a_asb_in_building_conduits" value="{{ $record[0]['isp_a_asb_in_building_conduits'] }}" id="isp_a_asb_in_building_conduits" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B ASB - TRENCH:</label>
                                <input type="text" name="isp_b_asb_trench" value="{{ $record[0]['isp_b_asb_trench'] }}" id="isp_b_asb_trench" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B ASB - 3RD PARTY DUCTS:</label>
                                <input type="text" name="isp_b_asb_3rd_party_ducts" value="{{ $record[0]['isp_b_asb_3rd_party_ducts'] }}" id="isp_b_asb_3rd_party_ducts" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B ASB - LA EXISTING DUCT:</label>
                                <input type="text" name="isp_b_asb_la_existing_duct" value="{{ $record[0]['isp_b_asb_la_existing_duct'] }}" id="isp_b_asb_la_existing_duct" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B ASB - EXISTING NETWORK:</label>
                                <input type="text" name="isp_b_asb_existing_network" value="{{ $record[0]['isp_b_asb_existing_network'] }}" id="isp_b_asb_existing_network" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B ASB - DISTANCE – FOCUS:</label>
                                <input type="text" name="isp_b_asb_distance_focus" value="{{ $record[0]['isp_b_asb_distance_focus'] }}" id="isp_b_asb_distance_focus" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                                <label>ISP B ASB - IN BUILDING CONDUITS:</label>
                                <input type="text" name="isp_b_asb_in_building_conduits" value="{{ $record[0]['isp_b_asb_in_building_conduits'] }}" id="isp_b_asb_in_building_conduits" class="form-control">
                            </div>
                          </div>
                          <!--
                           <div class="col-3">
                            <div class="form-group">
                                <label>OTDR DISTANCE,Final Sectional Date:</label>
                                <input type="text" name="otdr_distance" value="{{ $record[0]['otdr_distance'] }}" id="otdr_distance" class="form-control">
                            </div>
                          </div>
                          --->
                             <div class="col-3">
                      <div class="form-group">
                            <label>FINAL SECTIONAL DATE:</label>
                            <div class="input-group date" id="custom_date_picker40" data-target-input="nearest">
                                @if($record[0]['final_sectional_date'])
                                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['final_sectional_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="final_sectional_date" id="final_sectional_date" data-target="#custom_date_picker40">
                                @else
                                    <input type="text" value="" class="form-control datetimepicker-input" name="final_sectional_date" id="final_sectional_date" data-target="#custom_date_picker40">
                                @endif
                                <div class="input-group-append" data-target="#custom_date_picker40" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                      </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>MAT:</label>
                                <input type="text" name="mat" value="{{ $record[0]['mat'] }}" id="mat" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                      @if(in_array('all', $edit_access['edit_access_type']) OR in_array('build', $edit_access['edit_access_type']))
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