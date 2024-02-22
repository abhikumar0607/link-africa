@extends('admin.layouts.master')
 @section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.permission-master-files.permission-header')
            </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="delete_responce"></div>
                @if(count($all_records) >=1 )
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SERVICE ID</th>
                    <th>Circuit ID</th>
                    <th>DATENEW</th>
                    <th>PERMISSIONS STATUS</th>
                    <th>SITE A LLA SUBMITTED</th>
                    <th>SITE A LLA ESTIMATED</th>
                    <th>SITE A LLA RECEIVED</th>
                    <th>SITE B LLA SUBMITTED</th>
                    <th>SITE B LLA ESTIMATED</th>
                    <th>SITE B LLA RECEIVED</th>
                    <th>WAYLEAVES SUBMITTED</th>
                    <th>WAYLEAVES ESTIMATED</th>
                    <th>WAYLEAVES RECEIVED</th>
                    <th>WAYLEAVES STATUS</th>
                    <th>RESOURCE</th>
                    <th>WL PLANNED SUBMITTED DATE</th>
                    <th>PROVINCE</th>
                    <th>OSP STATUS PERMISSIONS</th>
                    <th>ISP A-B STATUS</th>
                    <th>EXISTING WL REF NO</th>
                    <th>Exepected WL Received Date</th>
                    <th>Total Number Of Responses Oustanding</th>
                    <th>Final WL Submission Date</th>
                    <th>WL Expiry Date</th>
                    <th>WL OSP STATUS</th>
                    <th>Stormwater Rou Date Submitted</th>
                    <th>Stormwater Rou Date Received</th>
                    <th>Stormwater Rou Lead Time</th>
                    <th>Sewer Rou Date Submitted</th>
                    <th>Sewer Rou Date Received</th>
                    <th>Sewer Rou Lead Time</th>
                    <th>Sewer Rou Date Submitted</th>
                    <th>Sewer Rou Date Received</th>
                    <th>Sewer Rou Lead Time</th>
                    <th>Telkom Date Submitted</th>
                    <th>Telkom Date Received</th>
                    <th>Telkom Lead Time</th>
                    <th>Sasol Date Submitted</th>
                    <th>Sasol Date Received</th>
                    <th>Sasol Lead Time</th>
                    <th>Transnet Date Submitted</th>
                    <th>Transnet Date Received</th>
                    <th>Transnet Lead Time</th>
                    <th>Neotel Date Submitted</th>
                    <th>Neotel Date Received</th>
                    <th>Neotel Lead Time</th>
                    <th>DFA Date Submitted</th>
                    <th>DFA Date Received</th>
                    <th>DFA Lead Time</th>
                    <th>MTN Date Submitted</th>
                    <th>MTN Date Received</th>
                    <th>MTN Lead Time</th>
                    <th>Sanral Date Submitted</th>
                    <th>Sanral Date Received</th>
                    <th>Sanral Lead time</th>
                    <th>Dept of Transport Date Submitted</th>
                    <th>Dept of Transport Date Received</th>
                    <th>Dept of Transport Lead Time</th>
                    <th>Water & Sanitation Date Submitted</th>
                    <th>Water & Sanitation Date Received</th>
                    <th>Water & Sanitation Lead Time</th>
                    <th>Ethekwini Transport Date Submitted</th>
                    <th>Ethekwini Transport Date Received</th>
                    <th>Ethekwini Transport Lead Time</th>
                    <th>Roads Date Submitted</th>
                    <th>Roads Date Received</th>
                    <th>Roads Lead Time</th>
                    <th>Electricity Date Submitted</th>
                    <th>Electricity Date Received</th>
                    <th>Electricity Lead Time</th>
                    <th>Coastal Stormwater & Catchment Date Submitted</th>
                    <th>Coastal Stormwater & Catchment Date Received</th>
                    <th>Coastal Stormwater & Catchment Lead Time</th>
                    <th>Development & Planning  Date Submitted</th>
                    <th>Development & Planning  Date Received</th>
                    <th>Development & Planning  Lead Time</th>
                    <th>Traffic Signals Date Submitted</th>
                    <th>Traffic Signals Date Received</th>
                    <th>Traffic Signals Lead Time</th>
                    <th>Enviromental Management Date Submitted</th>
                    <th>Enviromental Management Date Received</th>
                    <th>Enviromental Management Lead Time</th>
                    <th>Transportation Planning Date Submitted</th>
                    <th>Transportation Planning Date Received</th>
                    <th>Transportation Planning  Lead Time</th>
                    <th>Technical Services Date Submitted</th>
                    <th>Technical Services Date Received</th>
                    <th>Technical Services Lead Time</th>
                    <th>Sembcorp Siza Water Date Submitted</th>
                    <th>Sembcorp Siza Water Date Received</th>
                    <th>Sembcorp Siza Water Lead Time</th>
                    <th>Legal Services Date Submitted</th>
                    <th>Legal Services Date Received</th>
                    <th>Legal Services Lead Time</th>
                    <th>Eskom Date Submitted</th>
                    <th>Eskom Date Received</th>
                    <th>Eskom Lead Time</th>
                    <th>Parks Date Submitted</th>
                    <th>Parks Date Received</th>
                    <th>Parks Lead Time</th>
                    <th>SITE OWNER</th>
                    <th>External LA WL NUM</th>
                    <th>Permissions Comments</th>
                    <th>MAT</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/permission/permission-status-single',$record->id) }}">{{ $record->service_id }}</a></td>
                            <td>{{ $record->circuit_id }}</td>
                            <td>@if($record->datenew) {{ Carbon\Carbon::parse($record->datenew)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->permissions_status }}</td>
                            <td>@if($record->site_a_lla_submitted) {{ Carbon\Carbon::parse($record->site_a_lla_submitted)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->site_a_lla_estimated }} </td>
                            <td>@if($record->site_a_lla_received) {{ Carbon\Carbon::parse($record->site_a_lla_received)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->site_b_lla_submitted) {{ Carbon\Carbon::parse($record->site_b_lla_submitted)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->site_b_lla_estimated) {{ Carbon\Carbon::parse($record->site_b_lla_estimated)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->site_b_lla_received) {{ Carbon\Carbon::parse($record->site_b_lla_received)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->wayleaves_submitted) {{ Carbon\Carbon::parse($record->wayleaves_submitted)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->wayleaves_estimated }}</td>
                            <td>@if($record->wayleaves_received) {{ Carbon\Carbon::parse($record->wayleaves_received)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->wayleaves_status }}</td>
                            <td>{{ $record->resource }}</td>
                            <td>@if($record->wl_planned_submitted_date) {{ Carbon\Carbon::parse($record->wl_planned_submitted_date)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->province }}</td>
                            <td>{{ $record->osp_status_permissions }}</td>
                            <td>{{ $record->isp_a_b_status }}</td>
                            <td>{{ $record->existing_wl_ref_no }}</td>
                            <td>@if($record->exepected_wl_received_date) {{ Carbon\Carbon::parse($record->exepected_wl_received_date)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->total_number_of_responses_oustanding }}</td>
                            <td>@if($record->final_wl_submission_date) {{ Carbon\Carbon::parse($record->final_wl_submission_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->wl_expiry_date) {{ Carbon\Carbon::parse($record->wl_expiry_date)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->wl_osp_status }}</td>
                            <td>@if($record->stormwater_rou_date_submitted) {{ Carbon\Carbon::parse($record->stormwater_rou_date_submitted)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->stormwater_rou_date_received) {{ Carbon\Carbon::parse($record->stormwater_rou_date_received)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->stormwater_rou_lead_time }}</td>
                            <td>@if($record->sewer_rou_date_submitted) {{ Carbon\Carbon::parse($record->sewer_rou_date_submitted)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->sewer_rou_date_received) {{ Carbon\Carbon::parse($record->sewer_rou_date_received)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->sewer_rou_lead_time }}</td>
                            <td>{{ $record->telkom_date_submitted }}</td>
                            <td>{{ $record->telkom_date_received }}</td>
                            <td>{{ $record->telkom_lead_time }}</td>
                            <td>{{ $record->sasol_date_submitted }}</td>
                            <td>{{ $record->sasol_date_received }}</td>
                            <td>{{ $record->sasol_lead_time }}</td>
                            <td>{{ $record->transnet_date_submitted }}</td>
                            <td>{{ $record->transnet_date_received }}</td>
                            <td>{{ $record->transnet_lead_time }}</td>
                            <td>{{ $record->neotel_date_submitted }}</td>
                            <td>{{ $record->neotel_date_received }}</td>
                            <td>{{ $record->neotel_lead_time }}</td>
                            <td>{{ $record->dfa_date_submitted }}</td>
                            <td>{{ $record->dfa_date_received }}</td>
                            <td>{{ $record->dfa_lead_time }}</td>
                            <td>{{ $record->mtn_date_submitted }}</td>
                            <td>{{ $record->mtn_date_received }}</td>
                            <td>{{ $record->mtn_lead_time }}</td>
                            <td>{{ $record->sanral_date_submitted }}</td>
                            <td>{{ $record->sanral_date_received }}</td>
                            <td>{{ $record->sanral_lead_time }}</td>
                            <td>{{ $record->dept_of_transport_date_submitted }}</td>
                            <td>{{ $record->dept_of_transport_date_received }}</td>
                            <td>{{ $record->dept_of_transport_lead_time }}</td>
                            <td>{{ $record->water_sanitation_date_submitted }}</td>
                            <td>{{ $record->water_sanitation_date_received }}</td>
                            <td>{{ $record->water_sanitation_lead_time }}</td>
                            <td>{{ $record->ethekwini_transport_date_submitted }}</td>
                            <td>{{ $record->ethekwini_transport_date_received }}</td>
                            <td>{{ $record->ethekwini_transport_lead_time }}</td>
                            <td>{{ $record->roads_date_submitted }}</td>
                            <td>{{ $record->roads_date_received }}</td>
                            <td>{{ $record->roads_lead_time }}</td>
                            <td>{{ $record->electricity_date_submitted }}</td>
                            <td>{{ $record->electricity_date_received }}</td>
                            <td>{{ $record->electricity_lead_time }}</td>
                            <td>{{ $record->coastal_stormwater_catchment_date_submitted }}</td>
                            <td>{{ $record->coastal_stormwater_catchment_date_received }}</td>
                            <td>{{ $record->coastal_stormwater_catchment_lead_time }}</td>
                            <td>{{ $record->development_planning_date_submitted }}</td>
                            <td>{{ $record->development_planning_date_received }}</td>
                            <td>{{ $record->development_planning_lead_time }}</td>
                            <td>{{ $record->traffic_signals_date_submitted }}</td>
                            <td>{{ $record->traffic_signals_date_received }}</td>
                            <td>{{ $record->traffic_signals_lead_time }}</td>
                            <td>{{ $record->enviromental_management_date_submitted }}</td>
                            <td>{{ $record->enviromental_management_date_received }}</td>
                            <td>{{ $record->enviromental_management_lead_time }}</td>
                            <td>{{ $record->transportation_planning_date_submitted }}</td>
                            <td>{{ $record->transportation_planning_date_received }}</td>
                            <td>{{ $record->transportation_planning_lead_time }}</td>
                            <td>{{ $record->technical_services_date_submitted }}</td>
                            <td>{{ $record->technical_services_date_received }}</td>
                            <td>{{ $record->technical_services_lead_time }}</td>
                            <td>{{ $record->sembcorp_siza_water_date_submitted }}</td>
                            <td>{{ $record->sembcorp_siza_water_date_received }}</td>
                            <td>{{ $record->sembcorp_siza_water_lead_time }}</td>
                            <td>{{ $record->legal_services_date_submitted }}</td>
                            <td>{{ $record->legal_services_date_received }}</td>
                            <td>{{ $record->legal_services_lead_time }}</td>
                            <td>{{ $record->eskom_date_submitted }}</td>
                            <td>{{ $record->eskom_date_received }}</td>
                            <td>{{ $record->eskom_lead_time }}</td>
                            <td>{{ $record->parks_date_submitted }}</td>
                            <td>{{ $record->parks_date_received }}</td>
                            <td>{{ $record->parks_lead_time }}</td>
                            <td>{{ $record->site_owner }}</td>
                            <td>{{ $record->external_la_wl_num }}</td>
                            <td>{{ $record->permissions_comments }}</td>
                            <td>{{ $record->mat }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="pagination">
                	{{ $all_records->render() }}
                </div>
                @else
                	<h2>No Records Found</h2>
                @endif
            </div>
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