<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/dropdown-management/kam-all-list') }}" class="nav-link">Dropdown Management Dashboard</a>
     </li>
  </ul>
</nav>

<div class="col-md-12">

<div class="top-nav-menu">
  <ul>
  <li class="{{ request()->is('admin/dropdown-management/kam-all-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/kam-all-list')}}">All Kam List</a></li>
  <li class="{{ request()->is('admin/dropdown-management/order-all-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/order-all-list')}}">All Order List</a></li>
  <li class="{{ request()->is('admin/dropdown-management/all-network-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-network-list')}}">All Network Type List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-third-party-provider-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-third-party-provider-list')}}">All Third party Provider List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-lease-term-in-month-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-lease-term-in-month-list')}}">All Lease Term In Month List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-return-to-sale-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-return-to-sale-list')}}">All Return To Sale List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-strand-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-strand-list')}}">All Strands List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-rate-mbit-s-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-rate-mbit-s-list')}}">All Rate Mbit S List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-project-type-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-project-type-list')}}">All Project Type List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-planning-status-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-planning-status-list')}}">All Planning Status List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-osp-status-planning-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-osp-status-planning-list')}}">All OSP Status Planning List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-site-status-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-site-status-list')}}">All Site Status List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-osp-planner-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-osp-planner-list')}}">All OSP Planner List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-isp-planner-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-isp-planner-list')}}">All ISP Planner List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-surveyors-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-surveyors-list')}}">All Surveyors List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-site-survey-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-site-survey-list')}}">All Site Survey List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-landlord-status-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-landlord-status-list')}}">All Landlord Status List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-permission-status-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-permission-status-list')}}">All Permission Status List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-wayleaves-status-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-wayleaves-status-list')}}">All wayleaves Status List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-resources-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-resources-list')}}">All Resources List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-build-status-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-build-status-list')}}">All Build Status List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-build-osp-status-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-build-osp-status-list')}}">All Build OSP Status List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/all-service-delivery-status-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/all-service-delivery-status-list')}}">All Service Delivery Status List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/sd-status-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/sd-status-list')}}">All Sd Status List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/years-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/years-list')}}">All Year List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/week-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/week-list')}}">All Week List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/comment-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/comment-list')}}">All Comment List</a></li>
 <li class="{{ request()->is('admin/dropdown-management/resource-team-list') ? 'active' : '' }}"><a href="{{url('admin/dropdown-management/resource-team-list')}}">All Resources Team List</a></li>
</ul>
</div>
</div>
