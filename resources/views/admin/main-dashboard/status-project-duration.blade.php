@extends('admin.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.main-dashboard.dashboard-header')
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="project-data">
     <div class="container-fluid">
      <div class="table-html-desgin">
         <table>
             <thead>
               <tr>
                 <th scope="col" class="tree-tre"><span>Project Status</span></th>
                 <th scope="col" class="tree-tre">
                     
                   <span>Average of project duration</span>
                 </th>
                 <th scope="col" class="tree-tre info">
                   
                   <span>Count of service id</span>
                 </th>
               </tr>
             </thead>
             <tbody>
             <tr>
                 <th data-label="Account">A) NEW SALES</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $New_sale_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_New_sale_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">B) NEW IN-PLANNING</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $new_in_planning_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_new_in_planning_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">C) IN-SURVEY</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $in_survey_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_in_survey_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">D) IN-PLANNING</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $in_planning_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_in_planning_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">E) LANDLORD-APPROVAL</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $landlord_approval_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_landlord_approval_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">F) PERMISSIONS</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $permission_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_permission_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">H) FINANCIAL APPROVAL</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $financial_approval_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_financial_approval_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">I) NEW IN-BUILD</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $new_in_build_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_new_in_build_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">J) IN-BUILD</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $in_build_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_in_build_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">K) TOC P1 SUBMITTED-L2</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $toc_submitted_l2_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_toc_submitted_l2_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">R) ON-HOLD</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $on_hold_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_on_hold_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">S) RETURN TO SALES</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $return_to_sale_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_return_to_sale_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">V) PENDING CTS</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $pending_cts_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_pending_cts_service_id }}</span></td>
               </tr>
              
               <tr>
               @php 
                $total_average = round(($pending_cts_avg_of_project_duration + $return_to_sale_avg_of_project_duration + $on_hold_avg_of_project_duration + $toc_submitted_l2_avg_of_project_duration + $new_in_build_avg_of_project_duration + $financial_approval_avg_of_project_duration + $permission_avg_of_project_duration + $landlord_approval_avg_of_project_duration + $in_planning_avg_of_project_duration + $new_in_planning_avg_of_project_duration + $in_survey_avg_of_project_duration + $New_sale_avg_of_project_duration + $in_build_avg_of_project_duration)/13);
                $total_service_id = $count_pending_cts_service_id + $count_return_to_sale_service_id + $count_on_hold_service_id + $count_toc_submitted_l2_service_id + $count_in_build_service_id + $count_financial_approval_service_id + $count_permission_service_id + $count_landlord_approval_service_id + $count_in_planning_service_id + $count_in_survey_service_id + $count_new_in_planning_service_id + $count_New_sale_service_id + $count_new_in_build_service_id;
                @endphp
                 <td scope="row" data-label="Acount" class="something-rong"><strong>Grand Total</strong></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">Total Avearge: {{ $total_average }}</span></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">Total: {{ $total_service_id }}</span></td>
               </tr>
             </tbody>
           </table>
         
         </div>
        </div>
    </section>
  </div>
  </div>
  <!-- /.content-wrapper -->
 @endsection