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
            <form class="year-filter" action="{{url('admin/monthly-duration-dashboard')}}" method="GET" role="search">
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
                 <th scope="col" class="tree-tre"><span>Months</span></th>
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
                 <th data-label="Account">Jan</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $jan_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_jan_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">Feb</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $feb_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_feb_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">Mar</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $mar_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_mar_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">April</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $april_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_april_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">May</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $may_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_may_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">June</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $june_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_june_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">July</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $july_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_july_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">August</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $aug_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_aug_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">September</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $sep_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_sep_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">October</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $oct_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_oct_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">November</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $nov_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_nov_service_id }}</span></td>
               </tr>
               <tr>
                 <th data-label="Account">December</th>
                 <td data-label="Period"><span class="ocer-ert">{{ $dec_avg_of_project_duration }}</span></td>
                 <td data-label="Period"><span class="ocer-ert">{{ $count_dec_service_id }}</span></td>
               </tr>
               <tr>
               @php
                $total_service_id = $count_jan_service_id + $count_feb_service_id + $count_mar_service_id + $count_mar_service_id + $count_april_service_id + $count_june_service_id + $count_july_service_id  + $count_aug_service_id + $count_sep_service_id + $count_oct_service_id + $count_nov_service_id + $count_dec_service_id;
                $total_average_of_project = round(($july_avg_of_project_duration + $june_avg_of_project_duration + $may_avg_of_project_duration + $april_avg_of_project_duration + $mar_avg_of_project_duration + $feb_avg_of_project_duration + $jan_avg_of_project_duration + $aug_avg_of_project_duration
                + $sep_avg_of_project_duration + $oct_avg_of_project_duration + $nov_avg_of_project_duration + $dec_avg_of_project_duration)/12); 
                @endphp
                 <td scope="row" data-label="Acount" class="something-rong"><strong>Grand Total</strong></td>
                 <td data-label="Due Date" class="something-rong"><span class="ocer-ert">Total Avearge: {{ $total_average_of_project }}</span></td>
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