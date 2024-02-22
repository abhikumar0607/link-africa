<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
    @if (Auth::user()->user_type == "Customer")
        <li class="nav-item {{ request()->is('admin/customer/detail') ? 'menu-open active' : ''}}">
            <a href="{{ url('admin/customer/detail') }}" class="nav-link">
            <i class="nav-icon  fas fa-copy"></i>
            <p>Customer View</p></a>
        </li>
        @endif
    @if (Auth::user()->user_type !== "Customer")    
    <li class="nav-item {{ request()->is('admin/status-dashboard')  ? 'menu-open active' : '' }}">
            <a href="{{url('admin/status-dashboard')}}" class="nav-link">
                <i class="nav-icon fas fas fa-edit"></i>
                <p>
                Dashboard
                </p>
            </a>
        </li>
        {{--<li class="nav-item {{ request()->is('admin/sale/dashboard') || request()->is('admin/description/add-new') || request()->is('admin/sale/all-list') || request()->is('admin/sale/add-new-record') || request()->is('admin/service-type/add-new') || request()->is('admin/customer/add-new') || request()->is('admin/sale/import-records') || request()->is('admin/site/add-new')}}">
            <a href="{{url('admin/sale/dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
               Sales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/sale/add-new-sale')}}" class="nav-link">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <p>New Sales Lead</p>
                </a>
              </li>
              @if (Auth::user()->user_type == "Super_Admin")
               <li class="nav-item">
                  <a href="{{ url('admin/service-type/add-new') }}" class="nav-link">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <p>New Service Type</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/customer/add-new')}}" class="nav-link">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <p>New Customer</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/all/customer')}}" class="nav-link">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <p>All Customer</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('admin/description/add-new')}}" class="nav-link">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <p>New Description</p>
                  </a>
                </li>
              @endif 
              <li class="nav-item">
                <a href="{{url('admin/sale/add-new-record') }}" class="nav-link">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <p>Load LA Purchase Order</p>
                </a>
              </li>
            </ul>
          </li>--}}
          
          <li class="nav-item {{ request()->is('admin/sale/dashboard')  ? 'menu-open active' : '' }}">
            <a href="{{url('admin/sale/dashboard')}}" class="nav-link">
                <i class="nav-icon fas fas fa-edit"></i>
                <p>
                Sales
                </p>
            </a>
        </li>
        <li class="nav-item {{ request()->is('admin/planning/dashboard') || request()->is('admin/planning/all-list') || request()->is('admin/planning/import-records') ? 'menu-open active' : '' }}">
            <a href="{{url('admin/planning/dashboard')}}" class="nav-link">
                <i class="nav-icon fas fas fa-edit"></i>
                <p>
                Planning
                </p>
            </a>
        </li>
        <li class="nav-item {{ request()->is('admin/permission/dashboard') || request()->is('admin/permission/all-list') || request()->is('admin/permission/import-records') ? 'menu-open active' : '' }}">
            <a href="{{url('admin/permission/dashboard')}}" class="nav-link">
                <i class="nav-icon  fas fa-copy"></i>
                <p>
                Permissions
                </p>
            </a>
        </li>
        <li class="nav-item {{ request()->is('admin/financial-all-list') ? 'menu-open active' : '' }}">
            <a href="{{url('admin/financial-all-list')}}" class="nav-link">
                <i class="nav-icon fas fas fa-edit"></i>
                <p>
                Project Approval
                </p>
            </a>
        </li>
       

         <li class="nav-item {{ request()->is('admin/build/build-dashboard') || request()->is('admin/build/all-list') || request()->is('admin/build/import-records') ? 'menu-open active' : '' }}">
            <a href="{{url('admin/build/dashboard')}}" class="nav-link">
                <i class="nav-icon fas fas fa-edit"></i>
                <p>
                Builds
                </p>
            </a>
        </li>
        <li class="nav-item {{ request()->is('admin/layer/all-list') ? 'menu-open active' : '' }}">
            <a href="{{url('admin/layer/all-list')}}" class="nav-link">
                <i class="nav-icon fas fas fa-edit"></i>
                <p>
                Layer 2
                </p>
            </a>
        </li>
          <li class="nav-item {{ request()->is('admin/service-delivery/dashboard') || request()->is('admin/build/all-list') || request()->is('admin/build/import-records') ? 'menu-open active' : '' }}">
            <a href="{{url('admin/service-delivery/dashboard')}}" class="nav-link">
                <img src="{{ url('public/admin/images/secure-delivery-icon 1.svg') }}">
                <p>
                Service Delivery
                </p>
            </a>
        </li>
        <li class="nav-item">
              <a href="{{ url('admin/all-customer-record') }}" class="nav-link">
              <i class="nav-icon  fas fa-copy"></i>
              <p>Client View</p></a>
        </li>
        <li class="nav-item">
              <a href="{{ url('/support/dashboard') }}" class="nav-link">
              <i class="nav-icon  fas fa-copy"></i>
              <p>Create Ticket</p></a>
        </li>
        @if (Auth::user()->user_type == "Super_Admin")
            <li class="nav-item">
                <a href="{{ url('/admin/user-management/all-users') }}" class="nav-link">
                <i class="nav-icon  fas fa-users"></i>
                <p>User Management</p></a>
            </li>
            <li class="nav-item {{ request()->is('admin/history-management/dashboard') ? 'menu-open active' : '' }}">
              <a href="{{url('admin/history-management/dashboard')}}" class="nav-link">
                  <i class="nav-icon fas fas fa-edit"></i>
                  <p>
                  History Management
                  </p>
              </a>
          </li>
          
              <li class="nav-item">
                <a href="{{url('admin/dropdown-management/kam-all-list')}}" class="nav-link">
                <i class="nav-icon  fas fa-users"></i>
                  <p>Dropdown Management</p>
                </a>
              </li>        
         @endif 
        <li class="nav-item {{ request()->is('admin/export/dashboard') || request()->is('admin/export/project-ageing') || request()->is('admin/export-la-sale-report') || request()->is('admin/export/open-book-report') || request()->is('admin/export/vs-report') ? 'menu-open active' : '' }}">
            <a href="{{ url('admin/export/dashboard') }}" class="nav-link">
            <i class="nav-icon  fas fa-copy"></i>
            <p>Reports</p></a>
        </li>
        <li class="nav-item {{ request()->is('/support/chat') || request()->is('/support/chat')  ? 'menu-open active' : '' }}">
            <a href="{{ url('/support/chat') }}" class="nav-link">
            <i class="nav-icon  fas fa-users"></i>
            <p>Chat</p></a>
        </li>
        @endif
        <li class="nav-item">
            <a  href="{{ route('logout') }}" class="nav-link"  onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-user"></i>
                <p>
                Logout
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
        </li>
       
    </ul>
</nav>
<!-- /.sidebar-menu -->