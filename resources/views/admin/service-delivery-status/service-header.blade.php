<!-- Navbar -->
<nav class="navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('admin/service-delivery/dashboard') }}" class="nav-link">Service Delivey Status Dashboard</a>
     </li>
  </ul>
</nav>
<div class="col-md-9">
<div class="top-nav-menu">
  <ul>
      <li class="{{ request()->is('admin/service-delivery/dashboard') ? 'active' : '' }}"><a href="{{url('admin/service-delivery/dashboard')}}">Home</a></li>
      <li class="{{ request()->is('admin/service-delivery/project-status') ? 'active' : '' }}"><a href="{{url('admin/service-delivery/project-status')}}">Project Status</a></li>
      {{--<li class="{{ request()->is('admin/service-delivery/sd-table-view') ? 'active' : '' }}"><a href="{{url('admin/service-delivery/sd-table-view')}}">SD Table View</a></li>--}}
      <li class=""><a href="{{url('admin/export/service-delivery-export')}}">Export to Excel</a></li>
      <li class="{{url('admin/service-delivery/department-comment')}}"><a href="{{url('admin/service-delivery/department-comment')}}">Department Comments</a></li>
      {{--<li class="{{ request()->is('admin/service-delivery/project-comment') ? 'active' : '' }}"><a href="{{url('admin/service-delivery/project-comment')}}">Project Comments</a></li>--}}
      <li class="{{ request()->is('admin/service-delivery-attachment') ? 'active' : '' }}"><a href="{{url('admin/service-delivery-attachment')}}">Service Delivery Attachment</a></li>
      <li class="{{ request()->is('admin/export/planning-master-file') ? 'active' : '' }}"><a href="{{url('admin/export/planning-master-file')}}">Export Planning Master File</a></li>
   </ul>
</div>
</div>
