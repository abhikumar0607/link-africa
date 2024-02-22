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
                    <th>BUILD STATUS</th>
                    <th>BUILD DURATION</th>
                    <th>PLANNED START DATE</th>
                    <th>REVISED BUILD START DATE</th>
                    <th>REVISED BUILD CO DATE</th>
                    <th>ACTUAL BUILD COMPLETION DATE</th>
                    <th>ISP CONTRACTOR</th>
                    <th>OSP CONTRACTOR</th>
                    <th>PROJECT LEADER</th>
                    <th>BUILD COMPLETION</th>
                    <th>TOC SUBMITTED</th>
                    <th>TOC RECEIVED</th>
                    <th>OTOC</th>
                    <th>POTOC</th>
                    <th>COMMENTS</th>
                    <th>PO REQUESTED</th>
                    <th>PO RECEIVED</th>
                    <th>ISP A PROJECT LEADER</th>
                    <th>ISP A CIVIL CONTRACTOR</th>
                    <th>ISP A JETTING CONTRACTOR</th>
                    <th>ISP A RE INSTATEMENT CONTRACTOR</th>
                    <th>ISP A DRILLING CONTRACTOR</th>
                    <th>ISP A FLOATING CONTRACTOR</th>
                    <th>ISP A FOCUS CONTRACTOR</th>
                    <th>ISP B PROJECT LEADER</th>
                    <th>ISP B CIVIL CONTRACTOR</th>
                    <th>ISP B JETTING CONTRACTOR</th>
                    <th>ISP B RE INSTATEMENT CONTRACTOR</th>
                    <th>ISP B DRILLING CONTRACTOR</th>
                    <th>ISP B FLOATING CONTRACTOR</th>
                    <th>ISP B FOCUS CONTRACTOR</th>
                    <th>OSP PROJECT LEADER</th>
                    <th>OSP CIVIL CONTRACTOR</th>
                    <th>OSP JETTING CONTRACTOR</th>
                    <th>OSP RE INSTATEMENT CONTRACTOR</th>
                    <th>OSP DRILLING CONTRACTOR</th>
                    <th>OSP FLOATING CONTRACTOR</th>
                    <th>OSP FOCUS CONTRACTOR</th>
                    <th>SPLICING TEAM</th>
                    <th>NAME</th>
                    <th>PROVINCE</th>
                    <th>BUILD PLANNED COMPLETION DATES</th>
                    <th>OSP ASBUILD SUBMISSION</th>
                    <th>ISP ASBUILD SUBMISSION</th>
                    <th>OSP ASBUILD RECEIVED</th>
                    <th>ISP ASBUILD RECEIVED</th>
                    <th>VO SUBMITTED</th>
                    <th>VO RECEIVED</th>
                    <th>VO PO REQUESTED</th>
                    <th>VO PO RECEIVED</th>
                    <th>VO SUBMITTED2</th>
                    <th>VO RECEIVED2</th>
                    <th>VO PO REQUESTED2</th>
                    <th>VO PO RECEIVED2</th>
                    <th>VO SUBMITTED3</th>
                    <th>VO RECEIVED3</th>
                    <th>VO PO REQUESTED3</th>
                    <th>VO PO RECEIVED3</th>
                    <th>VO SUBMITTED4</th>
                    <th>VO RECEIVED4</th>
                    <th>VO PO REQUESTED4</th>
                    <th>VO PO RECEIVED4</th>
                    <th>BUILD OSP STATUS</th>
                    <th>QA REQUESTED</th>
                    <th>FAC SUBMITTED</th>
                    <th>FAC RECEIVED</th>
                    <th>ACTUAL OSP BUILD DISTANCE - TRENCH</th>
                    <th>ACTUAL OSP BUILD DISTANCE - 3RD PARTY DUCTS</th>
                    <th>ACTUAL OSP BUILD LA EXISTING DUCT</th>
                    <th>ACTUAL OSP BUILD LA EXISTING NETWORK</th>
                    <th>ACTUAL OSP BUILD DISTANCE - FOCUS</th>
                    <th>ACTUAL OSP  BUILD IN BUILDING CONDUITS</th>
                    <th>ACTUAL OSP 110 SLEEVES BUILD</th>
                    <th>ACTUAL OSP DRILLING DISTANCE BUILD</th>
                    <th>ACTUAL OSP MICRO DUCT DISTANCE BUILD</th>
                    <th>ACTUAL OPS BUILD TOTAL DISTANCE</th>
                    <th>ACTUAL BUILD COMPLETION</th>
                    <th>ACTUAL OSP MH 500 X 500 BUILD</th>
                    <th>ACTUAL  OSP MH 1000 X 500 BUILD</th>
                    <th>OSP ASB - TRENCH</th>
                    <th>OSP ASB - 3RD PARTY DUCTS</th>
                    <th>OSP ASB - LA EXISTING DUCT</th>
                    <th>OSP ASB - EXISTING NETWORK</th>
                    <th>OSP ASB - DISTANCE – FOCUS</th>
                    <th>OSP ASB – IN BUILDING CONDUITS</th>
                    <th>ISP A ASB - TRENCH</th>
                    <th>ISP A ASB - 3RD PARTY DUCTS</th>
                    <th>ISP A ASB - LA EXISTING DUCT</th>
                    <th>ISP A ASB - EXISTING NETWORK</th>
                    <th>ISP A ASB - DISTANCE – FOCUS</th>
                    <th>ISP A ASB - IN BUILDING CONDUITS</th>
                    <th>ISP B ASB - TRENCH</th>
                    <th>ISP B ASB - 3RD PARTY DUCTS</th>
                    <th>ISP B ASB - LA EXISTING DUCT</th>
                    <th>ISP B ASB - EXISTING NETWORK</th>
                    <th>ISP B ASB - DISTANCE – FOCUS</th>
                    <th>ISP B ASB - IN BUILDING CONDUITS</th>
                    <th>OTDR DISTANCE,Final Sectional Date</th>
                    <th>MAT</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all_records as $record)
                        <tr>
                            <td><a href="{{ url('admin/build/single-record',$record->id) }}">{{ $record->service_id }}</a></td>
                            <td>{{ $record->circuit_id }}</td>
                            <td>@if($record->datenew) {{ Carbon\Carbon::parse($record->datenew)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->build_status }}</td>
                            <td>{{ $record->build_duration }}</td>
                            <td>@if($record->planned_start_date) {{ Carbon\Carbon::parse($record->planned_start_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->revised_build_start_date) {{ Carbon\Carbon::parse($record->revised_build_start_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->revised_build_co_date) {{ Carbon\Carbon::parse($record->revised_build_co_date)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->actual_build_completion_date) {{ Carbon\Carbon::parse($record->actual_build_completion_date)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->isp_contractor }}</td>
                            <td>{{ $record->osp_contractor }}</td>
                            <td>{{ $record->project_leader }}</td>
                            <td>{{ $record->build_completion }}</td>
                            <td>@if($record->toc_submitted) {{ Carbon\Carbon::parse($record->toc_submitted)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->toc_received) {{ Carbon\Carbon::parse($record->toc_received)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->otoc }}</td>
                            <td>{{ $record->potoc }}</td>
                            <td>{{ $record->comments }}</td>
                            <td>@if($record->po_requested) {{ Carbon\Carbon::parse($record->po_requested)->format('m/d/Y') }} @endif</td>
                            <td>@if($record->po_received) {{ Carbon\Carbon::parse($record->po_received)->format('m/d/Y') }} @endif</td>
                            <td>{{ $record->isp_a_project_leader }}</td>
                            <td>{{ $record->isp_a_civil_contractor }}</td>
                            <td>{{ $record->isp_a_jetting_contractor }}</td>
                            <td>{{ $record->isp_a_re_instatement_contractor }}</td>
                            <td>{{ $record->isp_a_drilling_contractor }}</td>
                            <td>{{ $record->isp_a_floating_contractor }}</td>
                            <td>{{ $record->isp_a_focus_contractor }}</td>
                            <td>{{ $record->isp_b_project_leader }}</td>
                            <td>{{ $record->isp_b_civil_contractor }}</td>
                            <td>{{ $record->isp_b_jetting_contractor }}</td>
                            <td>{{ $record->isp_b_re_instatement_contractor }}</td>
                            <td>{{ $record->isp_b_drilling_contractor }}</td>
                            <td>{{ $record->isp_b_floating_contractor }}</td>
                            <td>{{ $record->isp_b_focus_contractor }}</td>
                            <td>{{ $record->osp_project_leader }}</td>
                            <td>{{ $record->osp_civil_contractor }}</td>
                            <td>{{ $record->osp_jetting_contractor }}</td>
                            <td>{{ $record->osp_re_instatement_contractor }}</td>
                            <td>{{ $record->osp_drilling_contractor }}</td>
                            <td>{{ $record->osp_focus_contractor }}</td>
                            <td>{{ $record->splicing_team }}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->province }}</td>
                            <td>{{ $record->build_planned_completion_dates }}</td>
                            <td>{{ $record->osp_asbuild_submission }}</td>
                            <td>{{ $record->isp_asbuild_submission }}</td>
                            <td>{{ $record->osp_asbuild_received }}</td>
                            <td>{{ $record->isp_asbuild_received }}</td>
                            <td>{{ $record->vo_submitted }}</td>
                            <td>{{ $record->vo_received }}</td>
                            <td>{{ $record->vo_po_requested }}</td>
                            <td>{{ $record->vo_po_received }}</td>
                            <td>{{ $record->vo_submitted2 }}</td>
                            <td>{{ $record->vo_received2 }}</td>
                            <td>{{ $record->vo_po_requested2 }}</td>
                            <td>{{ $record->vo_po_received2 }}</td>
                            <td>{{ $record->vo_submitted3 }}</td>
                            <td>{{ $record->vo_received3 }}</td>
                            <td>{{ $record->vo_po_requested3 }}</td>
                            <td>{{ $record->vo_po_received3 }}</td>
                            <td>{{ $record->vo_submitted4 }}</td>
                            <td>{{ $record->vo_received4 }}</td>
                            <td>{{ $record->vo_po_requested4 }}</td>
                            <td>{{ $record->vo_po_received4 }}</td>
                            <td>{{ $record->build_osp_status }}</td>
                            <td>{{ $record->qa_requested }}</td>
                            <td>{{ $record->fac_submitted }}</td>
                            <td>{{ $record->fac_received }}</td>
                            <td>{{ $record->actual_osp_build_distance_trench }}</td>
                            <td>{{ $record->actual_osp_build_distance_3rd_party_ducts }}</td>
                            <td>{{ $record->actual_osp_build_la_existing_duct }}</td>
                            <td>{{ $record->actual_osp_build_la_existing_network }}</td>
                            <td>{{ $record->actual_osp_build_distance_focus }}</td>
                            <td>{{ $record->actual_osp_build_in_building_conduits }}</td>
                            <td>{{ $record->actual_osp_110_sleeves_build }}</td>
                            <td>{{ $record->actual_osp_drilling_distance_build }}</td>
                            <td>{{ $record->actual_osp_micro_duct_distance_build }}</td>
                            <td>{{ $record->actual_ops_build_total_distance }}</td>
                            <td>{{ $record->actual_build_completion }}</td>
                            <td>{{ $record->actual_osp_mh_500_x_500_build }}</td>
                            <td>{{ $record->actual_osp_mh_1000_x_500_build }}</td>
                            <td>{{ $record->osp_asb_trench }}</td>
                            <td>{{ $record->osp_asb_3rd_party_ducts }}</td>
                            <td>{{ $record->osp_asb_la_existing_duct }}</td>
                            <td>{{ $record->osp_asb_existing_network }}</td>
                            <td>{{ $record->osp_asb_distance_focus }}</td>
                            <td>{{ $record->osp_asb_in_building_conduits }}</td>
                            <td>{{ $record->isp_a_asb_trench }}</td>
                            <td>{{ $record->isp_a_asb_3rd_party_ducts }}</td>
                            <td>{{ $record->isp_a_asb_la_existing_duct }}</td>
                            <td>{{ $record->isp_a_asb_existing_network }}</td>
                            <td>{{ $record->isp_a_asb_distance_focus }}</td>
                            <td>{{ $record->isp_a_asb_in_building_conduits }}</td>
                            <td>{{ $record->isp_b_asb_trench }}</td>
                            <td>{{ $record->isp_b_asb_3rd_party_ducts }}</td>
                            <td>{{ $record->isp_b_asb_la_existing_duct }}</td>
                            <td>{{ $record->isp_b_asb_existing_network }}</td>
                            <td>{{ $record->isp_b_asb_distance_focus }}</td>
                            <td>{{ $record->isp_b_asb_in_building_conduits }}</td>
                            <td>{{ $record->otdr_distance }}</td>
                            <td>{{ $record->final_sectional_date }}</td>
                            <td>{{ $record->mat }}</td>
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