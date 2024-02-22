@extends('admin.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @include('admin.planning-master-files.planning-header')
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!---project-Content--->
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
                <h2>Planning Status</h2>
                <table>
                <tr>    
                    <th>Planning Status</th>
                    <th>No of links</th>
                 </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-planning-status/new-sale') }}">A) New Sales</a></td>
                     <td>{{ $count_a_new_sale }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-planning-status/wp1-stage') }}">B) Wp1 Stage</a></td>
                     <td>{{ $count_wp1_stage }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-planning-status/wp2-compilation') }}">F) WP2 Compilation</a></td>
                     <td>{{ $count_wp2_complition }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-planning-status/permissions') }}">G) Permissions</a></td>
                     <td>{{ $count_d1_permissions }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-planning-status/financial-approval-requested') }}">H) Financial Approval Requested</a></td>
                     <td>{{ $count_e_financial_requested }}</td>
                  </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-planning-status/wp2-planning-complete') }}">I) WP2 Planning Complete</a></td>
                     <td>{{ $count_wp2_planning }}</td>
                  </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-planning-status/on-hold') }}">L) On-Hold</a></td>
                     <td>{{ $count_f_on_hold }}</td>
                  </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-planning-status/planning-complete') }}">M) Planning Complete</a></td>
                     <td>{{ $count_i_planning_complete }}</td>
                  </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-planning-status/cancelled') }}">O) Cancelled</a></td>
                     <td>{{  $count_m_cancelled }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-planning-status/terminated') }}">P) Terminated</a></td>
                     <td>{{ $count_o_terminate }}</td>
                  </tr>
                </table>  
             </div> 
          </div>
          <div class="col-md-3">
               <div class="project-ageing">
                <h2>Project Types</h2>
                <table>
                <tr>    
                    <th>Project Types</th>
                    <th>No of links</th>
                 </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/equipment-and-splicing') }}">Equipment And Splicing</a></td>
                     <td>{{ $count_equipment_and_splicing }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/isp-net1') }}">ISP NET1</a></td>
                     <td>{{ $count_isp_net1 }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/osp-isp-with-no-wayleaves') }}">OSP ISP With No Wayleaves</a></td>
                     <td>{{ $count_osp_isp_with_no_wayleaves }}</td>
                  </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/osp-isp-with-wayleaves-fttb') }}">OSP ISP With Wayleaves FTTB</a></td>
                     <td>{{ $count_osp_isp_with_wayleaves_fttb }}</td>
                  </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/osp-isp-with-wayleaves-ftts') }}">OSP ISP With Wayleaves FTTS</a></td>
                     <td>{{ $count_osp_isp_with_wayleaves_ftts }}</td>
                  </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/osp-isp-with-wayleaves-other') }}">OSP ISP With Wayleaves Other</a></td>
                     <td>{{ $count_osp_isp_with_wayleaves_other }}</td>
                  </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/net4') }}">NET4</a></td>
                     <td>{{ $count_net4 }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/net6') }}">NET6</a></td>
                     <td>{{ $count_net6 }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/managed-ports') }}">Managed Ports</a></td>
                     <td>{{ $count_managed_ports }}</td>
                  </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/upgrade-or-downgrade') }}">Upgrade or Downgrade</a></td>
                     <td>{{ $count_upgrade_or_downgrade }}</td>
                  </tr>
                   <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/net2') }}">NET2</a></td>
                     <td>{{ $count_net2 }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/net3-2') }}">NET3.2</a></td>
                     <td>{{ $count_net3_2 }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/migration-projects') }}">Migration Projects</a></td>
                     <td>{{ $count_migration_projects }}</td>
                  </tr>
                  <tr>    
                     <td><a href="{{ url('admin/planning/home-project-types/ftth-orders') }}">FTTH Orders</a></td>
                     <td>{{ $count_ftth_orders }}</td>
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
                     <td><a href="{{ url('admin/planning/home-project-ageing/120-days') }}">120 Days</a></td>
                     <td>{{ $one_twitty_sub_count; }}</td>
                 </tr>
                 <tr>
                     <td><a href="{{ url('admin/planning/home-project-ageing/60-days') }}">60 Days</a></td>
                     <td>{{ $sixteen_sub_days_count; }}</td>
                 </tr>
                  <tr>
                     <td><a href="{{ url('admin/planning/home-project-ageing/90-days') }}">90 Days</a></td>
                     <td>{{ $nintyeen_sub_days_count; }}</td>
                 </tr>
                 <tr>
                     <td><a href="{{ url('admin/planning/home-project-ageing/current') }}">Current</a></td>
                     <td>{{ $current_date_count; }}</td>
                 </tr>
                 <tr>
                     <td><a href="{{ url('admin/planning/home-project-ageing/more-than-120') }}">More than 120</a></td>
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
  <!-- /.content-wrapper -->
 @endsection