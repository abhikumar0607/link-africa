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
                 <th class="dash-class" scope="col">Project Status</th>
                 <th scope="col" class="tree-tre">
                    
                   <span>Eastern Region</span>
                   <span>Sum of PO MRC <em>Sum of PO NRC</em></span>
                 </th>
                 <th scope="col" class="tree-tre info" >
                   <span>Northern Region</span>
                   <span>Sum of PO MRC <em>Sum of PO NRC</em></span>
                 </th>
                 <th scope="col" class="tree-tre info">
                     <span>Western Region</span>
                     <span>Sum of PO MRC <em>Sum of PO NRC</em></span>
                   </th>
                 <th class="dash-class" scope="col">Total Sum of PO MRC</th>
                 <th class="dash-class" scope="col">Total Sum of PO NRC</th>
               </tr>
             </thead>
             <tbody>
               <tr>
                @php
                $count_total_sale_mrc = $count_sale_record[0][2] + $count_sale_record[0][0] + $count_sale_record[0][1];
                @endphp
                 <th data-label="Account">A) New Sales</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($new_sale_record[0][2], 2) }}<strong>&nbsp;({{ $count_sale_record[0][2] }})</strong><em>{{ number_format($new_sale_record[0][4], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($new_sale_record[0][0], 2) }} <strong>&nbsp;({{ $count_sale_record[0][0] }})</strong><em>{{ number_format($new_sale_record[0][5], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($new_sale_record[0][1], 2) }} <strong>&nbsp;({{ $count_sale_record[0][1] }})</strong><em>{{ number_format($new_sale_record[0][6], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($new_sale_record[0][3], 2) }} <strong>&nbsp;({{ $count_total_sale_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($new_sale_record[0][7], 2) }}</td>
               </tr>
               <tr>
                @php
                $count_total_new_in_planning_mrc = $count_new_in_planning[0][2] + $count_new_in_planning[0][0] + $count_new_in_planning[0][1];
                @endphp
                 <th scope="row" data-label="Account">B) New In-Planning</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($new_in_planning_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_new_in_planning[0][2] }}) </strong><em>{{ number_format($new_in_planning_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($new_in_planning_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_new_in_planning[0][0] }}) </strong><em>{{ number_format($new_in_planning_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($new_in_planning_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_new_in_planning[0][1] }}) </strong><em>{{ number_format($new_in_planning_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($new_in_planning_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_new_in_planning_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($new_in_planning_record[0]['nrctotal'], 2) }}</td>
               </tr>
               <tr>
                @php
                $count_total_In_Survey_mrc = $count_In_Survey[0][2] + $count_In_Survey[0][0] + $count_In_Survey[0][1];
                @endphp
                 <th scope="row" data-label="Account">C) In-Survey</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($In_Survey_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_In_Survey[0][2] }}) </strong><em>{{ number_format($In_Survey_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($In_Survey_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_In_Survey[0][0] }}) </strong><em>{{ number_format($In_Survey_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($In_Survey_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_In_Survey[0][1] }}) </strong><em>{{ number_format($In_Survey_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($In_Survey_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_In_Survey_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($In_Survey_record[0]['nrctotal'], 2) }}</td>
               </tr>
               <tr>
               @php
                $count_total_In_Planning_mrc = $count_In_Planning[0][2] + $count_In_Planning[0][0] + $count_In_Planning[0][1];
                @endphp
                 <th scope="row" data-label="Acount">D) In-Planning</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($In_Planning_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_In_Planning[0][2] }}) </strong><em>{{ number_format($In_Planning_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($In_Planning_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_In_Planning[0][0] }}) </strong><em>{{ number_format($In_Planning_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($In_Planning_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_In_Planning[0][1] }}) </strong><em>{{ number_format($In_Planning_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($In_Planning_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_In_Planning_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($In_Planning_record[0]['nrctotal'], 2) }}</td>
               </tr>
               <tr>
               @php
                $count_total_Landlord_Approval_record_mrc = $count_Landlord_Approval[0][2] + $count_Landlord_Approval[0][0] + $count_Landlord_Approval[0][1];
                @endphp
                 <th scope="row" data-label="Acount">E) Landlord-Approval</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Landlord_Approval_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_Landlord_Approval[0][2] }}) </strong><em>{{ number_format($Landlord_Approval_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Landlord_Approval_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_Landlord_Approval[0][0] }}) </strong><em>{{ number_format($Landlord_Approval_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Landlord_Approval_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_Landlord_Approval[0][1] }}) </strong><em>{{ number_format($Landlord_Approval_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($Landlord_Approval_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_Landlord_Approval_record_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($Landlord_Approval_record[0]['nrctotal'], 2) }}</td>
               </tr>
               <tr>
               @php
                $count_total_Permissions_record_mrc = $count_Permissions[0][2] + $count_Permissions[0][0] + $count_Permissions[0][1];
                @endphp
                 <th scope="row" data-label="Acount">F) Permissions</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Permissions_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_Permissions[0][2] }}) </strong><em>{{ number_format($Permissions_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Permissions_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_Permissions[0][0] }}) </strong><em>{{ number_format($Permissions_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Permissions_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_Permissions[0][1] }}) </strong><em>{{ number_format($Permissions_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($Permissions_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_Permissions_record_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($Permissions_record[0]['nrctotal'], 2) }}</td>
               </tr>
             
               <tr>
               @php
                $count_total_Financial_Approval_record_mrc = $count_Financial_Approval[0][2] + $count_Financial_Approval[0][0] + $count_Financial_Approval[0][1];
                @endphp
                 <th scope="row" data-label="Acount">H) Financial Approval</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Financial_Approval_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_Financial_Approval[0][2] }}) </strong><em>{{ number_format($Financial_Approval_record[0]['easterRegionnrc'], 2) }} </em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Financial_Approval_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_Financial_Approval[0][0] }}) </strong><em>{{ number_format($Financial_Approval_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Financial_Approval_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_Financial_Approval[0][1] }}) </strong><em>{{ number_format($Financial_Approval_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($Financial_Approval_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_Financial_Approval_record_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($Financial_Approval_record[0]['nrctotal'], 2) }}</td>
               </tr>
               <tr>
               @php
                $count_total_New_In_Build_record_mrc = $count_New_In_Build[0][2] + $count_New_In_Build[0][0] + $count_New_In_Build[0][1];
                @endphp
                 <th scope="row" data-label="Acount">I) New In-Build</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($New_In_Build_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_New_In_Build[0][2] }}) </strong><em>{{ number_format($New_In_Build_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($New_In_Build_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_New_In_Build[0][0] }}) </strong><em>{{ number_format($New_In_Build_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($New_In_Build_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_New_In_Build[0][1] }}) </strong><em>{{ number_format($New_In_Build_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($New_In_Build_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_New_In_Build_record_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($New_In_Build_record[0]['nrctotal'], 2) }}</td>
               </tr>
               <tr>
               @php
                $count_total_In_Build_record_mrc = $count_In_Build[0][2] + $count_In_Build[0][0] + $count_In_Build[0][1];
                @endphp
                 <th scope="row" data-label="Acount">J) In-Build</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($In_Build_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_In_Build[0][2] }}) </strong><em>{{ number_format($In_Build_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($In_Build_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_In_Build[0][0] }}) </strong><em>{{ number_format($In_Build_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($In_Build_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_In_Build[0][1] }}) </strong><em>{{ number_format($In_Build_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($In_Build_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_In_Build_record_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($In_Build_record[0]['nrctotal'], 2) }}</td>
               </tr>
               <tr>
               @php
                $count_total_ITOC_P1_Submitted_L2_record_mrc = $count_TOC_P1_Submitted_L2[0][2] + $count_TOC_P1_Submitted_L2[0][0] + $count_TOC_P1_Submitted_L2[0][1];
                @endphp
                 <th scope="row" data-label="Acount">K) TOC P1 Submitted-L2</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($TOC_P1_Submitted_L2_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp; ({{ $count_TOC_P1_Submitted_L2[0][2] }}) </strong><em>{{ number_format($TOC_P1_Submitted_L2_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($TOC_P1_Submitted_L2_record[0]['northregionmrc'], 2) }}<strong>&nbsp; ({{ $count_TOC_P1_Submitted_L2[0][0] }}) </strong><em>{{ number_format($TOC_P1_Submitted_L2_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($TOC_P1_Submitted_L2_record[0]['westernregionmrc'], 2) }}<strong>&nbsp; ({{ $count_TOC_P1_Submitted_L2[0][1] }}) </strong><em>{{ number_format($TOC_P1_Submitted_L2_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($TOC_P1_Submitted_L2_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_ITOC_P1_Submitted_L2_record_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($TOC_P1_Submitted_L2_record[0]['nrctotal'], 2) }}</td>
               </tr>
             
               <tr>
               @php
                $count_total_On_Hold_record_mrc = $count_On_Hold[0][2] + $count_On_Hold[0][0] + $count_On_Hold[0][1];
                @endphp
                 <th scope="row" data-label="Acount">R) On-Hold</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($On_Hold_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_On_Hold[0][2] }}) </strong><em>{{ number_format($On_Hold_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($On_Hold_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_On_Hold[0][0] }}) </strong><em>{{ number_format($On_Hold_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($On_Hold_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_On_Hold[0][1] }}) </strong><em>{{ number_format($On_Hold_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($On_Hold_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_On_Hold_record_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($On_Hold_record[0]['nrctotal'], 2) }}</td>
               </tr>
               <tr>
               @php
                $count_total_Return_to_Sales_record_mrc = $count_Return_to_Sales[0][2] + $count_Return_to_Sales[0][0] + $count_Return_to_Sales[0][1];
                @endphp
                 <th scope="row" data-label="Acount">S) Return to Sales</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Return_to_Sales_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_Return_to_Sales[0][2] }}) </strong><em>{{ number_format($Return_to_Sales_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Return_to_Sales_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_Return_to_Sales[0][0] }}) </strong><em>{{ number_format($Return_to_Sales_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($Return_to_Sales_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_Return_to_Sales[0][1] }}) </strong><em>{{ number_format($Return_to_Sales_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($Return_to_Sales_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_Return_to_Sales_record_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($Return_to_Sales_record[0]['nrctotal'], 2) }}</td>
               </tr>
            
               <tr>
               @php
                $count_total_V_Pending_CTS_record_mrc = $count_V_Pending_CTS[0][2] + $count_V_Pending_CTS[0][0] + $count_V_Pending_CTS[0][1];
                @endphp
                 <th scope="row" data-label="Acount">V) Pending CTS</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($V_Pending_CTS_record[0]['easterRegionmrc'], 2) }}<strong>&nbsp;({{ $count_V_Pending_CTS[0][2] }})</strong><em>{{ number_format($V_Pending_CTS_record[0]['easterRegionnrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($V_Pending_CTS_record[0]['northregionmrc'], 2) }}<strong>&nbsp;({{ $count_V_Pending_CTS[0][0] }})</strong><em>{{ number_format($V_Pending_CTS_record[0]['northregionrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($V_Pending_CTS_record[0]['westernregionmrc'], 2) }}<strong>&nbsp;({{ $count_V_Pending_CTS[0][1] }})</strong><em>{{ number_format($V_Pending_CTS_record[0]['westernregionnrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($V_Pending_CTS_record[0]['mrctotal'], 2) }}<strong>&nbsp;({{ $count_total_V_Pending_CTS_record_mrc }})<strong></td>
                 <td data-label="Amount">{{ number_format($V_Pending_CTS_record[0]['nrctotal'], 2) }}</td>
               </tr>
               <tr>
                @php 
                $total_mrc_eastern_region = $new_sale_record[0][2] + $new_in_planning_record[0]['easterRegionmrc'] + $In_Survey_record[0]['easterRegionmrc'] + $In_Planning_record[0]['easterRegionmrc'] + $Landlord_Approval_record[0]['easterRegionmrc'] + $Permissions_record[0]['easterRegionmrc'] + $Financial_Approval_record[0]['easterRegionmrc'] + $New_In_Build_record[0]['easterRegionmrc'] + $In_Build_record[0]['easterRegionmrc'] + $TOC_P1_Submitted_L2_record[0]['easterRegionmrc'] + $On_Hold_record[0]['easterRegionmrc'] + $Return_to_Sales_record[0]['easterRegionmrc'] + $V_Pending_CTS_record[0]['easterRegionmrc'];
                $total_nrc_eastern_region = $new_sale_record[0][4] + $new_in_planning_record[0]['easterRegionnrc'] + $In_Survey_record[0]['easterRegionnrc'] + $In_Planning_record[0]['easterRegionnrc'] + $Landlord_Approval_record[0]['easterRegionnrc'] + $Permissions_record[0]['easterRegionnrc'] + $Financial_Approval_record[0]['easterRegionnrc'] + $New_In_Build_record[0]['easterRegionnrc'] + $In_Build_record[0]['easterRegionnrc'] + $TOC_P1_Submitted_L2_record[0]['easterRegionnrc'] + $On_Hold_record[0]['easterRegionnrc'] + $Return_to_Sales_record[0]['easterRegionnrc'] + $V_Pending_CTS_record[0]['easterRegionnrc'];
                $total_mrc_northen_region = $new_sale_record[0][0] + $new_in_planning_record[0]['northregionmrc'] + $In_Survey_record[0]['northregionmrc'] + $In_Planning_record[0]['northregionmrc'] + $Landlord_Approval_record[0]['northregionmrc'] + $Permissions_record[0]['northregionmrc'] + $Financial_Approval_record[0]['northregionmrc'] + $New_In_Build_record[0]['northregionmrc'] + $In_Build_record[0]['northregionmrc'] + $TOC_P1_Submitted_L2_record[0]['northregionmrc'] + $On_Hold_record[0]['northregionmrc'] + $Return_to_Sales_record[0]['northregionmrc'] + $V_Pending_CTS_record[0]['northregionmrc'];
                $total_nrc_northen_region = $new_sale_record[0][5] + $new_in_planning_record[0]['northregionrc'] + $In_Survey_record[0]['northregionrc'] + $In_Planning_record[0]['northregionrc'] + $Landlord_Approval_record[0]['northregionrc'] + $Permissions_record[0]['northregionrc'] + $Financial_Approval_record[0]['northregionrc'] + $New_In_Build_record[0]['northregionrc'] + $In_Build_record[0]['northregionrc'] + $TOC_P1_Submitted_L2_record[0]['northregionrc'] + $On_Hold_record[0]['northregionrc'] + $Return_to_Sales_record[0]['northregionrc'] + $V_Pending_CTS_record[0]['northregionrc'];
                $total_mrc_western_region = $new_sale_record[0][1] + $new_in_planning_record[0]['westernregionmrc'] + $In_Survey_record[0]['westernregionmrc'] + $In_Planning_record[0]['westernregionmrc'] + $Landlord_Approval_record[0]['westernregionmrc'] + $Permissions_record[0]['westernregionmrc'] + $Financial_Approval_record[0]['westernregionmrc'] + $New_In_Build_record[0]['westernregionmrc'] + $In_Build_record[0]['westernregionmrc'] + $TOC_P1_Submitted_L2_record[0]['westernregionmrc'] + $On_Hold_record[0]['westernregionmrc'] + $Return_to_Sales_record[0]['westernregionmrc'] + $V_Pending_CTS_record[0]['westernregionmrc'];
                $total_nrc_western_region = $new_sale_record[0][6] + $new_in_planning_record[0]['westernregionnrc'] + $In_Survey_record[0]['westernregionnrc'] + $In_Planning_record[0]['westernregionnrc'] + $Landlord_Approval_record[0]['westernregionnrc'] + $Permissions_record[0]['westernregionnrc'] + $Financial_Approval_record[0]['westernregionnrc'] + $New_In_Build_record[0]['westernregionnrc'] + $In_Build_record[0]['westernregionnrc'] + $TOC_P1_Submitted_L2_record[0]['westernregionnrc'] + $On_Hold_record[0]['westernregionnrc'] + $Return_to_Sales_record[0]['westernregionnrc'] + $V_Pending_CTS_record[0]['westernregionnrc'];
                $total_mrc = $new_sale_record[0][3] + $new_in_planning_record[0]['mrctotal'] + $In_Survey_record[0]['mrctotal'] + $In_Planning_record[0]['mrctotal'] + $Landlord_Approval_record[0]['mrctotal'] + $Permissions_record[0]['mrctotal'] + $Financial_Approval_record[0]['mrctotal'] + $New_In_Build_record[0]['mrctotal'] + $In_Build_record[0]['mrctotal'] + $TOC_P1_Submitted_L2_record[0]['mrctotal'] +  $On_Hold_record[0]['mrctotal'] + $Return_to_Sales_record[0]['mrctotal'] + $V_Pending_CTS_record[0]['mrctotal'];
                $total_nrc = $new_sale_record[0][7] + $new_in_planning_record[0]['nrctotal'] + $In_Survey_record[0]['nrctotal'] + $In_Planning_record[0]['nrctotal'] + $Landlord_Approval_record[0]['nrctotal'] + $Permissions_record[0]['nrctotal'] + $Financial_Approval_record[0]['nrctotal'] + $New_In_Build_record[0]['nrctotal'] + $In_Build_record[0]['nrctotal'] + $TOC_P1_Submitted_L2_record[0]['nrctotal'] + $On_Hold_record[0]['nrctotal'] + $Return_to_Sales_record[0]['nrctotal'] + $V_Pending_CTS_record[0]['nrctotal'];
                @endphp
                 <td scope="row" data-label="Acount" class="something-rong"><strong>Grand Total</strong></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($total_mrc_eastern_region, 2); ?><em>R <?php echo number_format($total_nrc_eastern_region, 2);?></em></span></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($total_mrc_northen_region, 2); ?> <em>R <?php echo number_format($total_nrc_northen_region, 2); ?> </em></span></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($total_mrc_western_region, 2);?><em>R <?php echo number_format($total_nrc_western_region, 2);?></em></span></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($total_mrc, 2);?></span></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">R <?php echo number_format($total_nrc, 2);?></span></td>
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