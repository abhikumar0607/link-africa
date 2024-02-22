@extends('admin.layouts.master')
@section('content')
  <div class="col-sm-12"> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.permission-master-files.permission-header')
            </div>
      </div>
    </section>
    <section class="project-data">
     <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="project-ageing">
                <h2>Project Status</h2>
              
                <table>
                   <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/new-sale') }}">A) New Sales</a></td>
                     <td>{{ $count_new_sale; }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/new-in-planning') }}">B) New In-Planning</a></td>
                     <td>{{ $count_new_inplanning }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/in-Planning') }}">D) In-Planning</a></td>
                     <td>{{ $count_in_planning }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/permissions') }}">F) Permissions</a></td>
                     <td>{{ $count_d_permissions }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/financial-approval') }}">H) Financial Approval</a></td>
                     <td>{{ $count_e_financial_approval }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/new-in-build') }}">I) New In-Build</a></td>
                     <td>{{ $count_f_new_build }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/toc-submitted') }}">K) TOC P1 Submitted-L2</a></td>
                     <td>{{ $count_i_toc_submitted }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/toc-received') }}">L) TOC P2 Received-L2</a></td>
                     <td>{{ $count_j_toc_recieved }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/cancelled') }}">Q) Cancelled</a></td>
                     <td>{{ $count_l_cancelled }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/on-hold') }}">R) On-Hold</a></td>
                     <td>{{ $count_m_on_hold }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/complete') }}">T) Complete</a></td>
                     <td>{{ $count_n_complete }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/sale/home-project-status/terminated') }}">U) Terminated</a></td>
                     <td>{{ $count_v_terminated }}</td>
                  </tr>
                </table> 
              </div>
            </div>
            <div class="col-md-3">
             <div class="project-ageing">
                <h2>Permission Status</h2>
                 <table>
                   <tr>    
                     <td><a href="{{ url('admin/permission/home-permission-status/new-sale') }}">A) New Sales</a></td>
                     <td>{{ $count_a_new_sale }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/permission/home-permission-status/terminated-2') }}">B) Received from Planning</a></td>
                     <td>{{ $count_e_approvedo }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/permission/home-permission-status/work-in-progress') }}">C) Work In Progress</a></td>
                     <td>{{ $count_work_inprogress }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/permission/home-permission-status/on-hold') }}">D) On-Hold</a></td>
                     <td>{{ $count_d_on_hold }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/permission/home-permission-status/approved') }}">E) Approved</a></td>
                     <td>{{ $count_e_approved }}</td>
                  </tr>
               
                  <tr>    
                     <td><a href="{{ url('admin/permission/home-permission-status/new-in-build') }}">F) Not Required</a></td>
                     <td>{{ $count_p_f_new_build }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/permission/home-permission-status/cancelled') }}">H) Cancelled</a></td>
                     <td>{{ $count_g_cancelled }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/permission/home-permission-status/terminated') }}">I) Terminated</a></td>
                     <td>{{ $count_i_terminate }}</td>
                  </tr>
                 
                </table>  
             </div> 
          </div>
           <div class="col-md-3">
             <div class="project-ageing">
                <h2>Wayleaves Status</h2>
                 <table>
                   <tr>    
                     <td><a href="{{ url('admin/permission/home-wayleaves-status/complete') }}">Complete</a></td>
                     <td>{{ $count_complete }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/permission/home-wayleaves-status/in-progress') }}">In Progress</a></td>
                     <td>{{ $count_in_progress_way }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/permission/home-wayleaves-status/not-started') }}">Not Started</a></td>
                     <td>{{ $count_not_started }}</td>
                  </tr>
                </table>  
             </div> 
          </div>
             <div class="col-md-2">
               <div class="project-ageing">
                <h2>Project Ageing</h2>
                  <table>
                     <tr>    
                     <th>Project Ageing</th>
                     <th>No of links</th>
                  </tr>
                  <tr>
                        <td><a href="{{ url('admin/permission/home-project-ageing/120-days') }}">120 Days</a></td>
                        <td>{{ $one_twitty_sub_count; }}</td>
                  </tr>
                  <tr>
                        <td><a href="{{ url('admin/permission/home-project-ageing/60-days') }}">60 Days</a></td>
                        <td>{{ $sixteen_sub_days_count; }}</td>
                  </tr>
                     <tr>
                        <td><a href="{{ url('admin/permission/home-project-ageing/90-days') }}">90 Days</a></td>
                        <td>{{ $nintyeen_sub_days_count; }}</td>
                  </tr>
                  <tr>
                        <td><a href="{{ url('admin/permission/home-project-ageing/current') }}">Current</a></td>
                        <td>{{ $current_date_count; }}</td>
                  </tr>
                  <tr>
                        <td><a href="{{ url('admin/permission/home-project-ageing/more-than-120') }}">More than 120</a></td>
                        <td>{{ $more_then_one_twitty_sub_days_count; }}</td>
                  </tr>
                </table> 
             </div> 
          </div>
          <div class="col-md-1"></div>
        </div>
    </section>
  </div>
</div>
@endsection