@extends('admin.layouts.master')
@section('content')
<!-- Header content -->
<div class="col-sm-12"> 
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    @include('admin.planning-master-files.planning-header')
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
          <h3 class="card-title">Edit Planning</h3></br>
        @if (Session::has('success'))
          <p class="success">{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('unsuccess'))
          <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
        @endif
      </div>
      @php $edit_access =  Helper::manage_edit_pages_access();  @endphp
      @if(in_array('all', $edit_access['edit_access_type']) OR in_array('planning', $edit_access['edit_access_type']))
        <form action="{{ route('admin.planning.update-record', $record[0]['id']) }}" method="POST" enctype="multipart/form-data" id="update_planning_master_file_record"> 
        {{ csrf_field() }} 
      @else
        <form method="POST" action="#" enctype="multipart/form-data">
      @endif
          <div class="card-body no-scroll-need">
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
                  <label>Date New:</label>
                        @if($record[0]['datenew'])
                            <input type="text" value="{{ Carbon\Carbon::parse($record[0]['datenew'])->format('m/d/Y') }}" class="form-control" name="date_new" id="date_new">
                        @else
                            <input type="text" value="" class="form-control" name="date_new" id="date_new">
                        @endif
                    </div>
                </div>
              <div class="col-3">
                <div class="form-group">
                    <label>planning_status:</label>
                    <select class="form-control" name="planning_status" id="planning_status">
                        <option value="">Select planning Status</option>
                        <option value="A) New Sales" <?php if($record[0]['planning_status'] == 'A) New Sales') { echo "selected"; } ?>>A) New Sales</option>
                        <option value="B) Wp1 Stage" <?php if($record[0]['planning_status'] == 'B) Wp1 Stage') { echo "selected"; } ?>>B) Wp1 Stage</option>
                        <option value="C) Wp2 Compilation" <?php if($record[0]['planning_status'] == 'C) Wp2 Compilation') { echo "selected"; } ?>>C) Wp2 Compilation</option>
                        <option value="D) Permissions"  <?php if($record[0]['planning_status'] == 'D) Permissions') { echo "selected"; } ?>>D) Permissions</option>
                        <option value="E) Financial Approval Requested" <?php if($record[0]['planning_status'] == 'E) Financial Approval Requested') { echo "selected"; } ?>>E) Financial Approval Requested</option>
                        <option value="F) Wp2 Planning Complete" <?php if($record[0]['planning_status'] == 'F) Wp2 Planning Complete') { echo "selected"; } ?>>F) Wp2 Planning Complete</option>
                        <option value="O) Terminated" <?php if($record[0]['planning_status'] == 'O) Terminated') { echo "selected"; } ?>>O) Terminated</option>
                        <option value="Site Survey Completed" <?php if($record[0]['planning_status'] == 'Site Survey Completed') { echo "selected"; } ?>>Site survey Completed</option>
                        <option value="WP2 Stage" <?php if($record[0]['planning_status'] == 'WP2 Stage') { echo "selected"; } ?>>WP2 Stage</option>
                        <option value="VO Process" <?php if($record[0]['planning_status'] == 'VO Process') { echo "selected"; } ?>>VO Process</option>
                        <option value="As Build Stage" <?php if($record[0]['planning_status'] == 'As Build Stage') { echo "selected"; } ?>>As Build Stage</option>
                        <option value="On-hold" <?php if($record[0]['planning_status'] == 'On-hold') { echo "selected"; } ?>>On-hold</option>
                        <option value="Planning Complete" <?php if($record[0]['planning_status'] == 'Planning Complete') { echo "selected"; } ?>>Planning Complete</option>
                        <option value="Return to Sales" <?php if($record[0]['planning_status'] == 'Return to Sales') { echo "selected"; } ?>>Return to Sales</option>
                    </select>
                </div>
              </div>
              
             <div class="col-3">
                <div class="form-group">
                <label>Rx IN PLANNING:</label>
                 <div class="input-group date" id="custom_date_picker13" data-target-input="nearest">
                   @if($record[0]['rx_in_planning'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['rx_in_planning'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="rx_in_planning" id="rx_in_planning" data-target="#custom_date_picker13">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="rx_in_planning" id="rx_in_planning" data-target="#custom_date_picker13">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker13" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                
                <div class="col-3">
                <div class="form-group">
                <label>PLANNING WP2 WL SUBMISSION::</label>
                 <div class="input-group date" id="custom_date_picker14" data-target-input="nearest">
                   @if($record[0]['planned_wp2_released_date'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planning_wp2_wl_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="planning_wp2_wl_submission" id="planning_wp2_wl_submission" data-target="#custom_date_picker14">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="planning_wp2_wl_submission" id="planning_wp2_wl_submission" data-target="#custom_date_picker14">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker14" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
            <div class="col-3">
                <div class="form-group">
                <label>PLANNED WP2 RELEASED DATE:</label>
                 <div class="input-group date" id="custom_date_picker" data-target-input="nearest">
                   @if($record[0]['planned_wp2_released_date'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['planned_wp2_released_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="planned_wp2_released_date" id="planned_wp2_released_date" data-target="#custom_date_picker">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="planned_wp2_released_date" id="planned_wp2_released_date" data-target="#custom_date_picker">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                
                <div class="col-3">
                <div class="form-group">
                <label>REVISED PLANNED WP2 DATE:</label>
                 <div class="input-group date" id="custom_date_picker2" data-target-input="nearest">
                   @if($record[0]['revised_planned_wp2_date'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['revised_planned_wp2_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="revised_planned_wp2_date" id="revised_planned_wp2_date" data-target="#custom_date_picker2">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="revised_planned_wp2_date" id="revised_planned_wp2_date" data-target="#custom_date_picker2">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker2" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                
                 <div class="col-3">
                <div class="form-group">
                <label>WP2 APPROVAL REQUESTED:</label>
                 <div class="input-group date" id="custom_date_picker3" data-target-input="nearest">
                   @if($record[0]['wp2_approval_requested'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['wp2_approval_requested'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="wp2_approval_requested" id="wp2_approval_requested" data-target="#custom_date_picker3">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="wp2_approval_requested" id="wp2_approval_requested" data-target="#custom_date_picker3">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker3" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                
              <div class="col-3">
                <div class="form-group">
                <label>WP2 APPROVAL RECEIVED:</label>
                 <div class="input-group date" id="custom_date_picker4" data-target-input="nearest">
                   @if($record[0]['wp2_approval_received'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['wp2_approval_received'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="wp2_approval_received" id="wp2_approval_requested" data-target="#custom_date_picker4">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="wp2_approval_received" id="wp2_approval_received" data-target="#custom_date_picker4">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
              <div class="col-3">
                <div class="form-group">
                    <label>OSP PLANNERS:</label>
                    <input type="text" name="osp_planners" value="{{ $record[0]['osp_planners'] }}" id="osp_planners" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP PLANNERS:</label>
                    <input type="text" name="isp_planners" value="{{ $record[0]['isp_planners'] }}" id="isp_planners" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>SURVEYORS:</label>
                    <input type="text" name="surveyors" value="{{ $record[0]['surveyors'] }}" id="surveyors" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP DISTANCE:</label>
                    <input type="text" name="isp_distance" value="{{ $record[0]['isp_distance'] }}" id="isp_distance" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>OSP PLANNERS2:</label>
                    <input type="text" name="osp_planners2" value="{{ $record[0]['osp_planners2'] }}" id="osp_planners2" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP PLANNERS2:</label>
                    <input type="text" name="isp_planners2" value="{{ $record[0]['isp_planners2'] }}" id="isp_planners2" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>SURVEYORS2:</label>
                    <input type="text" name="surveyors2" value="{{ $record[0]['surveyors2'] }}" id="surveyors2" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>SITE A ID:</label>
                     <input type="text" name="site_a_id" value="{{ $record[0]['site_a_id'] }}" id="site_a_id" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>SITE A STATUS:</label>
                    <input type="text" name="site_a_status" value="{{ $record[0]['site_a_status'] }}" id="site_a_status" class="form-control">
                </div>
              </div>
              
               <div class="col-3">
                <div class="form-group">
                <label>SITE A SURVEY DATE:</label>
                 <div class="input-group date" id="custom_date_picker9" data-target-input="nearest">
                   @if($record[0]['site_a_survey_date'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_a_survey_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_a_survey_date" id="site_a_survey_date" data-target="#custom_date_picker9">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="site_a_survey_date" id="site_a_survey_date" data-target="#custom_date_picker9">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker9" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
              <div class="col-3">
                <div class="form-group">
                <label>SITE A ISP SUBMISSION:</label>
                 <div class="input-group date" id="custom_date_picker10" data-target-input="nearest">
                   @if($record[0]['site_a_survey_date'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_a_isp_submission'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_a_isp_submission" id="site_a_isp_submission" data-target="#custom_date_picker10">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="site_a_isp_submission" id="site_a_isp_submission" data-target="#custom_date_picker10">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker10" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
              <div class="col-3">
                <div class="form-group">
                    <label>SITE A COMMENT:</label>
                    <input type="email" name="site_a_comment" value="{{ $record[0]['site_a_comment'] }}" id="site_a_comment" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>SITE B ID:</label>
                    <input type="text" name="site_b_id" value="{{ $record[0]['site_b_id'] }}" id="site_b_id" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>SITE B STATUS:</label>
                    <input type="text" name="site_b_status" value="{{ $record[0]['site_b_status'] }}" id="site_b_status" class="form-control">
                </div>
              </div>
              
                <div class="col-3">
                <div class="form-group">
                <label>SITE B SURVEY DATE:</label>
                 <div class="input-group date" id="custom_date_picker11" data-target-input="nearest">
                   @if($record[0]['site_b_survey_date'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_b_survey_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_b_survey_date" id="site_b_survey_date" data-target="#custom_date_picker11">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="site_b_survey_date" id="site_b_survey_date" data-target="#custom_date_picker11">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker11" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
                
                 <div class="col-3">
                <div class="form-group">
                <label>SITE B ISP SUBMISSION:</label>
                 <div class="input-group date" id="custom_date_picker12" data-target-input="nearest">
                   @if($record[0]['site_b_isp_submission'])
                    <input type="text" value="{{ Carbon\Carbon::parse($record[0]['site_b_survey_date'])->format('m/d/Y') }}" class="form-control datetimepicker-input" name="site_b_isp_submission" id="site_b_isp_submission" data-target="#custom_date_picker12">
                    @else
                    <input type="text" value="" class="form-control datetimepicker-input" name="site_b_isp_submission" id="site_b_isp_submission" data-target="#custom_date_picker12">
                  @endif
                 <div class="input-group-append" data-target="#custom_date_picker12" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                 </div>
                </div>
              <div class="col-3">
                <div class="form-group">
                    <label>SITE B COMMENT:</label>
                    <input type="text" name="site_b_comment" value="{{ $record[0]['site_b_comment'] }}" id="site_b_comment" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>COMMENT:</label>
                    <input type="text" name="comment" value="{{ $record[0]['comment'] }}" id="comment" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Cost PM:</label>
                    <input type="email" name="cost_pm" value="{{ $record[0]['cost_pm'] }}" id="cost_pm" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>PROVINCE:</label>
                    <input type="text" name="province" value="{{ $record[0]['province'] }}" id="province" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Labour Cost OSP:</label>
                    <input type="text" name="labour_cost_osp" value="{{ $record[0]['labour_cost_osp'] }}" id="labour_cost_osp" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Material Cost OSP:</label>
                    <input type="text" name="material_cost_osp" value="{{ $record[0]['material_cost_osp'] }}" id="material_cost_osp" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Total BOQ Value OSP:</label>
                    <input type="text" name="total_boq_value_osp" value="{{ $record[0]['total_boq_value_osp'] }}" id="total_boq_value_osp" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Labour Cost VO OSP:</label>
                    <input type="text" name="labour_cost_vo_osp" value="{{ $record[0]['labour_cost_vo_osp'] }}" id="labour_cost_vo_osp" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Material Cost VO OSP:</label>
                    <input type="text" name="material_cost_vo_osp" value="{{ $record[0]['material_cost_vo_osp'] }}" id="material_cost_vo_osp" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Total BOQ Value VO OSP:</label>
                    <input type="text" name="total_boq_value_vo_osp" value="{{ $record[0]['total_boq_value_vo_osp'] }}" id="total_boq_value_vo_osp" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Labour Cost VO ISP A :</label>
                    <input type="text" name="labour_cost_vo_isp_a" value="{{ $record[0]['labour_cost_vo_isp_a'] }}" id="labour_cost_vo_isp_a" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Material Cost VO ISP A:</label> 
                    <input type="text" name="material_cost_vo_isp_a" value="{{ $record[0]['material_cost_vo_isp_a'] }}" id="material_cost_vo_isp_a" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Total BOQ Value VO ISP A:</label>
                    <input type="text" name="total_boq_value_vo_isp_a" value="{{ $record[0]['total_boq_value_vo_isp_a'] }}" id="total_boq_value_vo_isp_a" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Labour Cost VO ISP B:</label>
                    <input type="text" name="labour_cost_vo_isp_b" value="{{ $record[0]['labour_cost_vo_isp_b'] }}" id="labour_cost_vo_isp_b" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Material Cost VO ISP B:</label>
                    <input type="text" name="material_cost_vo_isp_b" value="{{ $record[0]['material_cost_vo_isp_b'] }}" id="material_cost_vo_isp_b" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Total BOQ Value VO ISP B:</label>
                    <input type="text" name="total_boq_value_vo_isp_b" value="{{ $record[0]['total_boq_value_vo_isp_b'] }}" id="total_boq_value_vo_isp_b" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Total Project Cost:</label>
                    <input type="text" name="total_project_cost" value="{{ $record[0]['total_project_cost'] }}" id="total_project_cost" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>OSP STATUS PANNING:</label>
                    <input type="text" name="osp_status_panning" value="{{ $record[0]['osp_status_panning'] }}" id="osp_status_panning" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>OSP DISTANCE - TRENCH:</label>
                    <input type="text" name="osp_distance_trench" value="{{ $record[0]['osp_distance_trench'] }}" id="osp_distance_trench" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>OSP DISTANCE - 3RD PARTY DUCTS:</label>
                    <input type="text" name="osp_distance_3rd_party_ducts" value="{{ $record[0]['osp_distance_3rd_party_ducts'] }}" id="osp_distance_3rd_party_ducts" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>OSP LA EXISTING DUCT:</label>
                    <input type="text" name="osp_la_existing_duct" value="{{ $record[0]['osp_la_existing_duct'] }}" id="osp_la_existing_duct" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>OSP LA EXISTING NETWORK:</label>
                    <input type="text" name="osp_la_existing_network" value="{{ $record[0]['osp_la_existing_network'] }}" id="osp_la_existing_network" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>OSP DISTANCE - FOCUS:</label>
                    <input type="text" name="osp_distance_focus" value="{{ $record[0]['osp_distance_focus'] }}" id="osp_distance_focus" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>OSP in - Buildin Conduits:</label>
                    <input type="text" name="osp_in_buildin_conduits" value="{{ $record[0]['osp_in_buildin_conduits'] }}" id="osp_in_buildin_conduits" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>OPS TOTAL DISTANCE:</label>
                    <input type="text" name="ops_total_distance" value="{{ $record[0]['ops_total_distance'] }}" id="ops_total_distance" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP A DISTANCE - TRENCH:</label>
                    <input type="text" name="isp_a_distance_trench" value="{{ $record[0]['isp_a_distance_trench'] }}" id="isp_a_distance_trench" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP A DISTANCE - 3RD PARTY DUCTS:</label>
                    <input type="text" name="isp_a_distance_3rd_party_ducts" value="{{ $record[0]['isp_a_distance_3rd_party_ducts'] }}" id="isp_a_distance_3rd_party_ducts" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP A LA EXISTING DUCT:</label>
                    <input type="text" name="isp_a_la_existing_duct" value="{{ $record[0]['isp_a_la_existing_duct'] }}" id="isp_a_la_existing_duct" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP A LA EXISTING NETWORK:</label>
                    <input type="text" name="isp_a_la_existing_network" value="{{ $record[0]['isp_a_la_existing_network'] }}" id="isp_a_la_existing_network" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP A DISTANCE - FOCUS:</label>
                    <input type="text" name="isp_a_distance_focus" value="{{ $record[0]['isp_a_distance_focus'] }}" id="isp_a_distance_focus" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP A in - Buildin Conduits:</label>
                    <input type="text" name="isp_a_in_buildin_conduits" value="{{ $record[0]['isp_a_in_buildin_conduits'] }}" id="isp_a_in_buildin_conduits" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP A TOTAL DISTANCE:</label>
                    <input type="text" name="isp_a_total_distance" value="{{ $record[0]['isp_a_total_distance'] }}" id="isp_a_total_distance" class="form-control">
                </div>
              </div>
          
              <div class="col-3">
                <div class="form-group">
                    <label>ISP B DISTANCE - TRENCH:</label>
                    <input type="text" name="isp_b_distance_trench" value="{{ $record[0]['isp_b_distance_trench'] }}" id="isp_b_distance_trench" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP B DISTANCE - 3RD PARTY DUCTS:</label>
                    <input type="text" name="isp_b_distance_3rd_party_ducts" value="{{ $record[0]['isp_b_distance_3rd_party_ducts'] }}" id="isp_b_distance_3rd_party_ducts" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP B LA EXISTING DUCT:</label>
                    <input type="text" name="isp_b_la_existing_duct" value="{{ $record[0]['isp_b_la_existing_duct'] }}" id="isp_b_la_existing_duct" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP B LA EXISTING NETWORK:</label>
                    <input type="text" name="isp_b_la_existing_network" value="{{ $record[0]['isp_b_la_existing_network'] }}" id="isp_b_la_existing_network" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP B DISTANCE - FOCUS:</label>
                    <input type="text" name="isp_b_distance_focus" value="{{ $record[0]['isp_b_distance_focus'] }}" id="isp_b_distance_focus" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP B in - Buildin Conduits:</label>
                    <input type="text" name="isp_b_in_buildin_conduits" value="{{ $record[0]['isp_b_in_buildin_conduits'] }}" id="isp_b_in_buildin_conduits" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>ISP B TOTAL DISTANCE:</label>
                    <input type="text" name="isp_b_total_distance" value="{{ $record[0]['isp_b_total_distance'] }}" id="isp_b_total_distance" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Labour Cost ISP A:</label>
                    <input type="text" name="labour_cost_isp_a" value="{{ $record[0]['labour_cost_isp_a'] }}" id="labour_cost_isp_a" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Material Cost ISP A:</label>
                    <input type="text" name="material_cost_isp_a" value="{{ $record[0]['material_cost_isp_a'] }}" id="material_cost_isp_a" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Total BOQ Value ISP A:</label>
                    <input type="text" name="total_boq_value_isp_a" value="{{ $record[0]['total_boq_value_isp_a'] }}" id="total_boq_value_isp_a" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Labour Cost ISP B:</label>
                    <input type="text" name="labour_cost_isp_b" value="{{ $record[0]['labour_cost_isp_b'] }}" id="labour_cost_isp_b" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Material Cost ISP B:</label>
                    <input type="text" name="material_cost_isp_b" value="{{ $record[0]['material_cost_isp_b'] }}" id="material_cost_isp_b" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Total BOQ Value ISP B:</label>
                    <input type="text" name="total_boq_value_isp_b" value="{{ $record[0]['total_boq_value_isp_b'] }}" id="total_boq_value_isp_b" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Link dependency:</label>
                    <input type="text" name="link_dependency" value="{{ $record[0]['link_dependency'] }}" id="link_dependency" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label>Mat:</label>
                    <input type="text" name="mat" value="{{ $record[0]['mat'] }}" id="mat" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
          @if(in_array('all', $edit_access['edit_access_type']) OR in_array('planning', $edit_access['edit_access_type']))
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