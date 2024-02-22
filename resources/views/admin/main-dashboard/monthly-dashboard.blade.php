@extends('admin.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.main-dashboard.dashboard-header')
            <div class="col-md-3">
            <form class="year-filter" action="{{url('admin/toc-monthly-dashboard')}}" method="GET" role="search">
             <div class="form-group">
                <select class="form-control" name="year">
                  <option value="" selected="">Please Select Year</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
              </select>
             </div>
             <div class="form-group">
                 <button type="submit" class="btn btn-primary btn-submt">Submit</button>
            </div>
           </form>
           </div>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="project-data">
     <div class="container-fluid">
      <div class="table-html-desgin">
         <table>
             <thead>
               <tr>
                 <th class="dash-class" scope="col">Months</th>
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
                $count_total_jan_record_mrc = $total_jan_count[0][2] + $total_jan_count[0][0] + $total_jan_count[0][1];
                @endphp
                 <th data-label="Account">janruary</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($jan_total_record[0]['jan_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_jan_count[0][0] }}) </strong><em>{{ number_format($jan_total_record[0]['jan_eastern_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($jan_total_record[0]['jan_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_jan_count[0][1] }}) </strong><em>{{ number_format($jan_total_record[0]['jan_northen_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($jan_total_record[0]['jan_western_mrc'], 2) }}<strong>&nbsp;({{ $total_jan_count[0][2] }}) </strong><em>{{ number_format($jan_total_record[0]['jan_western_nrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($jan_total_record[0]['jan_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_jan_record_mrc }}) </strong></td>
                 <td data-label="Amount">{{ number_format($jan_total_record[0]['jan_total_nrc'], 2) }}</td>
               </tr>
               <tr>
             <tr>
                @php
                $count_total_feb_record_mrc = $total_feb_count[0][2] + $total_feb_count[0][0] + $total_feb_count[0][1];
                @endphp
                 <th data-label="Account">february</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($feb_total_record[0]['feb_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_feb_count[0][0] }}) </strong><em>{{ number_format($feb_total_record[0]['feb_eastern_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($feb_total_record[0]['feb_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_feb_count[0][1] }}) </strong><em>{{ number_format($feb_total_record[0]['feb_northen_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($feb_total_record[0]['feb_western_mrc'], 2) }}<strong>&nbsp;({{ $total_feb_count[0][2] }}) </strong><em>{{ number_format($feb_total_record[0]['feb_western_nrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($feb_total_record[0]['feb_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_feb_record_mrc }}) </strong></td>
                 <td data-label="Amount">{{ number_format($feb_total_record[0]['feb_total_nrc'], 2) }}</td>
               </tr>
               <tr>
                @php
                $count_total_march_record_mrc = $total_march_count[0][2] + $total_march_count[0][0] + $total_march_count[0][1];
                @endphp
                 <th data-label="Account">March</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($march_total_record[0]['march_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_march_count[0][0] }}) </strong><em>{{ number_format($march_total_record[0]['march_eastern_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($march_total_record[0]['march_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_march_count[0][1] }}) </strong><em>{{ number_format($march_total_record[0]['march_northen_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($march_total_record[0]['march_western_mrc'], 2) }}<strong>&nbsp;({{ $total_march_count[0][2] }}) </strong><em>{{ number_format($march_total_record[0]['march_western_nrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($march_total_record[0]['march_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_march_record_mrc }}) </strong></td>
                 <td data-label="Amount">{{ number_format($march_total_record[0]['march_total_nrc'], 2) }}</td>
               </tr>
               <tr>
               @php
                $count_total_april_record_mrc = $total_april_count[0][2] + $total_april_count[0][0] + $total_april_count[0][1];
                @endphp
               <th data-label="Account">april</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($april_total_record[0]['april_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_april_count[0][0] }}) </strong><em>{{ number_format($april_total_record[0]['april_eastern_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($april_total_record[0]['april_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_april_count[0][1] }}) </strong><em>{{ number_format($april_total_record[0]['april_northen_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($april_total_record[0]['april_western_mrc'], 2) }}<strong>&nbsp;({{ $total_april_count[0][2] }}) </strong><em>{{ number_format($april_total_record[0]['april_western_nrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($april_total_record[0]['april_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_april_record_mrc }}) </strong></td>
                 <td data-label="Amount">{{ number_format($april_total_record[0]['april_total_nrc'], 2) }}</td>
              </tr>
              <tr>
                @php
                $count_total_may_record_mrc = $total_may_count[0][2] + $total_may_count[0][0] + $total_may_count[0][1];
                @endphp
              <th data-label="Account">may</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($may_total_record[0]['may_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_may_count[0][0] }}) </strong><em>{{ number_format($may_total_record[0]['may_eastern_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($may_total_record[0]['may_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_may_count[0][1] }}) </strong><em>{{ number_format($may_total_record[0]['may_northen_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($may_total_record[0]['may_western_mrc'], 2) }}<strong>&nbsp;({{ $total_may_count[0][2] }}) </strong><em>{{ number_format($may_total_record[0]['may_western_nrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($may_total_record[0]['may_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_may_record_mrc }}) </strong></td>
                 <td data-label="Amount">{{ number_format($may_total_record[0]['may_total_nrc'], 2) }}</td>
            </tr>
            <tr>
               @php
                $count_total_june_record_mrc = $total_june_count[0][2] + $total_june_count[0][0] + $total_june_count[0][1];
                @endphp
            <th data-label="Account">june</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($june_total_record[0]['june_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_june_count[0][0] }}) </strong><em>{{ number_format($june_total_record[0]['june_eastern_nrc'], 2)}}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($june_total_record[0]['june_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_june_count[0][1] }}) </strong><em>{{ number_format($june_total_record[0]['june_northen_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($june_total_record[0]['june_western_mrc'], 2) }}<strong>&nbsp;({{ $total_june_count[0][2] }}) </strong><em>{{ number_format($june_total_record[0]['june_western_nrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($june_total_record[0]['june_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_june_record_mrc }}) </strong></td>
                 <td data-label="Amount">{{ number_format($june_total_record[0]['june_total_nrc'], 2) }}</td>
            <tr>
            <tr>
               @php
                $count_total_july_record_mrc = $total_july_count[0][2] + $total_july_count[0][0] + $total_july_count[0][1];
                @endphp
            <th data-label="Account">july</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($july_total_record[0]['july_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_july_count[0][0] }}) </strong><em>{{ number_format($july_total_record[0]['july_eastern_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($july_total_record[0]['july_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_july_count[0][1] }}) </strong><em>{{ number_format($july_total_record[0]['july_northen_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($july_total_record[0]['july_western_mrc'], 2) }}<strong>&nbsp;({{ $total_july_count[0][2] }}) </strong><em>{{ number_format($july_total_record[0]['july_western_nrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($july_total_record[0]['july_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_july_record_mrc }}) </strong></td>
                 <td data-label="Amount">{{ number_format($july_total_record[0]['july_total_nrc'], 2) }}</td>
           </tr>
           <tr>
               @php
                $count_total_aug_record_mrc = $total_aug_count[0][2] + $total_aug_count[0][0] + $total_aug_count[0][1];
                @endphp
            <th data-label="Account">August</th>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($aug_total_record[0]['aug_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_aug_count[0][0] }}) </strong><em>{{ number_format($aug_total_record[0]['aug_eastern_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($aug_total_record[0]['aug_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_aug_count[0][1] }}) </strong><em>{{ number_format($aug_total_record[0]['aug_northen_nrc'], 2) }}</em></span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ number_format($aug_total_record[0]['aug_western_mrc'], 2) }}<strong>&nbsp;({{ $total_aug_count[0][2] }}) </strong><em>{{ number_format($aug_total_record[0]['aug_western_nrc'], 2) }}</em></span></td>
                 <td data-label="Due Date">{{ number_format($aug_total_record[0]['aug_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_aug_record_mrc }}) </strong></td>
                 <td data-label="Amount">{{ number_format($aug_total_record[0]['aug_total_nrc'], 2) }}</td>
           </tr>
           <tr>
            @php
            $count_total_sep_record_mrc = $total_sep_count[0][2] + $total_sep_count[0][0] + $total_sep_count[0][1];
            @endphp
            <th data-label="Account">September</th>
                <td data-label="Period"><span class="ocer-ert">{{ number_format($sep_total_record[0]['sep_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_sep_count[0][0] }}) </strong><em>{{ number_format($sep_total_record[0]['sep_eastern_nrc'], 2) }}</em></span></td>
                <td data-label="Period"><span class="ocer-ert">{{ number_format($sep_total_record[0]['sep_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_sep_count[0][1] }}) </strong><em>{{ number_format($sep_total_record[0]['sep_northen_nrc'], 2) }}</em></span></td>
                <td data-label="Period"><span class="ocer-ert">{{ number_format($sep_total_record[0]['sep_western_mrc'], 2) }}<strong>&nbsp;({{ $total_sep_count[0][2] }}) </strong><em>{{ number_format($sep_total_record[0]['sep_western_nrc'], 2) }}</em></span></td>
                <td data-label="Due Date">{{ number_format($sep_total_record[0]['sep_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_sep_record_mrc }}) </strong></td>
                <td data-label="Amount">{{ number_format($sep_total_record[0]['sep_total_nrc'], 2) }}</td>
            </tr>
            <tr>
          @php
          $count_total_oct_record_mrc = $total_oct_count[0][2] + $total_oct_count[0][0] + $total_oct_count[0][1];
          @endphp
          <th data-label="Account">October</th>
              <td data-label="Period"><span class="ocer-ert">{{ number_format($oct_total_record[0]['oct_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_oct_count[0][0] }}) </strong><em>{{ number_format($oct_total_record[0]['oct_eastern_nrc'], 2) }}</em></span></td>
              <td data-label="Period"><span class="ocer-ert">{{ number_format($oct_total_record[0]['oct_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_oct_count[0][1] }}) </strong><em>{{ number_format($oct_total_record[0]['oct_northen_nrc'], 2) }}</em></span></td>
              <td data-label="Period"><span class="ocer-ert">{{ number_format($oct_total_record[0]['oct_western_mrc'], 2) }}<strong>&nbsp;({{ $total_oct_count[0][2] }}) </strong><em>{{ number_format($oct_total_record[0]['oct_western_nrc'], 2) }}</em></span></td>
              <td data-label="Due Date">{{ number_format($oct_total_record[0]['oct_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_oct_record_mrc }}) </strong></td>
              <td data-label="Amount">{{ number_format($oct_total_record[0]['oct_total_nrc'], 2) }}</td>
          </tr>
          <tr>
          @php
          $count_total_nov_record_mrc = $total_nov_count[0][2] + $total_nov_count[0][0] + $total_nov_count[0][1];
          @endphp
          <th data-label="Account">November</th>
            <td data-label="Period"><span class="ocer-ert">{{ number_format($nov_total_record[0]['nov_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_nov_count[0][0] }}) </strong><em>{{ number_format($nov_total_record[0]['nov_eastern_nrc'], 2) }}</em></span></td>
            <td data-label="Period"><span class="ocer-ert">{{ number_format($nov_total_record[0]['nov_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_nov_count[0][1] }}) </strong><em>{{ number_format($nov_total_record[0]['nov_northen_nrc'], 2) }}</em></span></td>
            <td data-label="Period"><span class="ocer-ert">{{ number_format($nov_total_record[0]['nov_western_mrc'], 2) }}<strong>&nbsp;({{ $total_nov_count[0][2] }}) </strong><em>{{ number_format($nov_total_record[0]['nov_western_nrc'], 2) }}</em></span></td>
            <td data-label="Due Date">{{ number_format($nov_total_record[0]['nov_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_nov_record_mrc }}) </strong></td>
            <td data-label="Amount">{{ number_format($nov_total_record[0]['nov_total_nrc'], 2) }}</td>
          </tr>
          <tr>
        @php
        $count_total_dec_record_mrc = $total_dec_count[0][2] + $total_dec_count[0][0] + $total_dec_count[0][1];
        @endphp
        <th data-label="Account">December</th>
          <td data-label="Period"><span class="ocer-ert">{{ number_format($dec_total_record[0]['dec_eastern_mrc'], 2) }}<strong>&nbsp;({{ $total_dec_count[0][0] }}) </strong><em>{{ number_format($dec_total_record[0]['dec_eastern_nrc'], 2) }}</em></span></td>
          <td data-label="Period"><span class="ocer-ert">{{ number_format($dec_total_record[0]['dec_northen_mrc'], 2) }}<strong>&nbsp;({{ $total_dec_count[0][1] }}) </strong><em>{{ number_format($dec_total_record[0]['dec_northen_nrc'], 2) }}</em></span></td>
          <td data-label="Period"><span class="ocer-ert">{{ number_format($dec_total_record[0]['dec_western_mrc'], 2) }}<strong>&nbsp;({{ $total_dec_count[0][2] }}) </strong><em>{{ number_format($dec_total_record[0]['dec_western_nrc'], 2) }}</em></span></td>
          <td data-label="Due Date">{{ number_format($dec_total_record[0]['dec_total_mrc'], 2) }}<strong>&nbsp;({{ $count_total_dec_record_mrc }}) </strong></td>
          <td data-label="Amount">{{ number_format($dec_total_record[0]['dec_total_nrc'], 2) }}</td>
        </tr>
           <tr>
           @php
              $total_mrc_eastern_region = $jan_total_record[0]['jan_eastern_mrc'] +  $feb_total_record[0]['feb_eastern_mrc'] + $march_total_record[0]['march_eastern_mrc'] + $april_total_record[0]['april_eastern_mrc'] + $may_total_record[0]['may_eastern_mrc'] + $june_total_record[0]['june_eastern_mrc']  +  $july_total_record[0]['july_eastern_mrc'] + $aug_total_record[0]['aug_eastern_mrc'] + $sep_total_record[0]['sep_eastern_mrc'] + $oct_total_record[0]['oct_eastern_mrc'] + $nov_total_record[0]['nov_eastern_mrc'] + $dec_total_record[0]['dec_eastern_mrc'];
              $total_mrc_northen_region = $jan_total_record[0]['jan_northen_mrc'] + $feb_total_record[0]['feb_northen_mrc'] + $march_total_record[0]['march_northen_mrc'] + $april_total_record[0]['april_northen_mrc'] + $may_total_record[0]['may_northen_mrc'] + $june_total_record[0]['june_northen_mrc']  +  $july_total_record[0]['july_northen_mrc'] + $aug_total_record[0]['aug_northen_mrc'] + $sep_total_record[0]['sep_northen_mrc'] + $oct_total_record[0]['oct_northen_mrc'] + $nov_total_record[0]['nov_northen_mrc'] + $dec_total_record[0]['dec_northen_mrc'];
              $total_mrc_western_region = $jan_total_record[0]['jan_western_mrc'] +  $feb_total_record[0]['feb_western_mrc'] + $march_total_record[0]['march_western_mrc'] + $april_total_record[0]['april_western_mrc'] + $may_total_record[0]['may_western_mrc'] + $june_total_record[0]['june_western_mrc']  +  $july_total_record[0]['july_western_mrc'] + $aug_total_record[0]['aug_western_mrc']  + $sep_total_record[0]['sep_western_mrc']  + $oct_total_record[0]['oct_western_mrc']  + $nov_total_record[0]['nov_western_mrc']  + $dec_total_record[0]['dec_western_mrc'];
              $total_nrc_eastern_region = $jan_total_record[0]['jan_eastern_nrc'] + $feb_total_record[0]['feb_eastern_nrc'] + $march_total_record[0]['march_eastern_nrc'] + $april_total_record[0]['april_eastern_nrc'] + $may_total_record[0]['may_eastern_nrc'] + $june_total_record[0]['june_eastern_nrc']  +  $july_total_record[0]['july_eastern_nrc'] + $aug_total_record[0]['aug_eastern_nrc'] + $sep_total_record[0]['sep_eastern_nrc'] + $oct_total_record[0]['oct_eastern_nrc'] + $nov_total_record[0]['nov_eastern_nrc'] + $dec_total_record[0]['dec_eastern_nrc'];
              $total_nrc_northen_region = $jan_total_record[0]['jan_northen_nrc'] + $feb_total_record[0]['feb_northen_nrc'] + $march_total_record[0]['march_northen_nrc'] + $april_total_record[0]['april_northen_nrc'] + $may_total_record[0]['may_northen_nrc'] + $june_total_record[0]['june_northen_nrc']  +  $july_total_record[0]['july_northen_nrc'] + $aug_total_record[0]['aug_northen_nrc'] + $sep_total_record[0]['sep_northen_nrc'] + $oct_total_record[0]['oct_northen_nrc'] + $nov_total_record[0]['nov_northen_nrc'] + $dec_total_record[0]['dec_northen_nrc'];
              $total_nrc_western_region = $jan_total_record[0]['jan_western_nrc'] + $feb_total_record[0]['feb_western_nrc'] + $march_total_record[0]['march_western_nrc'] + $april_total_record[0]['april_western_nrc'] + $may_total_record[0]['may_western_nrc'] + $june_total_record[0]['june_western_nrc']  +  $july_total_record[0]['july_western_nrc'] + $aug_total_record[0]['aug_western_nrc']  + $sep_total_record[0]['sep_western_nrc']  + $oct_total_record[0]['oct_western_nrc']  + $nov_total_record[0]['nov_western_nrc']  + $dec_total_record[0]['dec_western_nrc'];
              $total_mrc = $jan_total_record[0]['jan_total_mrc'] + $feb_total_record[0]['feb_total_mrc'] + $march_total_record[0]['march_total_mrc'] + $april_total_record[0]['april_total_mrc'] + $may_total_record[0]['may_total_mrc'] + $june_total_record[0]['june_total_mrc'] + $july_total_record[0]['july_total_mrc'] +  $aug_total_record[0]['aug_total_mrc'] +  $sep_total_record[0]['sep_total_mrc']  +  $oct_total_record[0]['oct_total_mrc']  +  $nov_total_record[0]['nov_total_mrc']  +  $dec_total_record[0]['dec_total_mrc'];
              $total_nrc = $jan_total_record[0]['jan_total_nrc'] + $feb_total_record[0]['feb_total_nrc'] + $march_total_record[0]['march_total_nrc'] + $april_total_record[0]['april_total_nrc'] + $may_total_record[0]['may_total_nrc'] + $june_total_record[0]['june_total_nrc'] + $july_total_record[0]['july_total_nrc'] +  $aug_total_record[0]['aug_total_nrc'] +  $sep_total_record[0]['sep_total_nrc']  +  $oct_total_record[0]['oct_total_nrc']  +  $nov_total_record[0]['nov_total_nrc']   +  $dec_total_record[0]['dec_total_nrc']; 
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