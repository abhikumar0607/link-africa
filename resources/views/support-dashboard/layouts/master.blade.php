@include('support-dashboard.layouts.head')
<?php 
 $ticket_generate = random_int(10000, 99999); 
 $ticket_id = Crypt::encryptString($ticket_generate);
 ?>
<body class="hold-transition sidebar-mini layout-fixed">
<header class="sprot-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3"><a href="{{ url('/support/dashboard') }}"><img  src="{{URL::asset('/public/admin/images/sport-logo.svg')}}" alt="#"></a></div>
      <div class="col-md-9">
        <div class="notf-menu text-right navbar">
          <ul>
            <li><a href="{{ url('/support/asset-transform-listing') }}" class="">Assest Transform</a></li>
            <li><a href="{{ url('/support/hardware-software-listing') }}" class="">Hardware & Software Requirements</a></li>
            <li> <button type="button"  class="btn btn-default tkt-btn" data-toggle="modal" data-target="#modal-default">Create New Tickets</button></li>
            <li><a href="{{ url('/support/dashboard') }}">Tickets <span>({{ Helper::tickets_count() }})</span></a></li>
            <li><a href="{{ url('/support/chat') }}">Chat <span class="ticket-count">({{ Helper::unseen_message_count() }})</span></a></li>
            <li><a href="{{ url('/admin/sale/dashboard') }}">Main Dashboard</a></li>
            <li><a  href="{{ route('logout') }}" class="nav-link"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <p>Logout</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form></li>
              
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>
<!--[/Header]-->
      <!-- /.content-header -->
      @yield('content')
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
       <!-- /.modal -->

       <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header custom-modal-header">
              <h4 class="modal-title">Create New Ticket</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body custom-modal-body">
              <!--[Chat Footer]-->
      <form action="{{ route('submit.new.ticket') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
		 <div class="chat-body-footer ert">   
     <div class="Subject-innner">
        <label>Subject</label>
            <input id="subject" type="text" class="form-control" name="subject" required>      
      </div>
      <div class="msg-box">
          <label>description</label>
          <textarea id="description" type="text" class="form-control" name="description" placeholder="Write your message..." required> </textarea>               
          <input type="hidden" id="ticket" name="ticket" value="{{ $ticket_id }}">      
     </div>
    <div class="left-aligne">
    <label>Status</label>
      <select class="form-control" name="ticket_status" required>
        <option value="" selceted></option>
        <option value="Open">Open</option>
        <option value="In Progress">In Progress</option>
        <option value="On-Hold">On-Hold</option>
        <option value="Closed">Closed</option>
     </select>
     </div>
     <div class="right-aligne">
       <label>Requestor</label>
       @php
       $user_name = auth()->user()->name;
       @endphp
       <input id="requester" name="requester" type="text" class="form-control" value="{{ $user_name }}" required>
     </div>
     <div class="left-aligne">
       <label>Requestor Email Address</label>
       @php
       $user_email = auth()->user()->email;
       @endphp
       <input id="requester" name="requester_email_address" type="email" class="form-control" value="{{ $user_email }}" required>
     </div>
     <div class="right-aligne">
      <label>Department</label>
       @php
       $department = auth()->user()->department;
       @endphp
      <select class="form-control" name="depaertment">
        <option value="" selceted></option>
        <option value="{{ $department }}" <?php if($department== "Building") echo "selected"; ?>>Building</option>
        <option value="{{ $department }}" <?php if($department== "Executive") echo "selected"; ?>>Executive</option>
        <option value="{{ $department }}" <?php if($department== "Finance") echo "selected"; ?>>Finance</option>
        <option value="{{ $department }}" <?php if($department== "Human") echo "selected"; ?>>Human</option>
        <option value="{{ $department }}" <?php if($department== "Resources") echo "selected"; ?>>Resources</option>
        <option value="{{ $department }}" <?php if($department== "IT") echo "selected"; ?>>IT</option>
        <option value="{{ $department }}" <?php if($department== "OPS") echo "selected"; ?>>OPS</option>
        <option value="{{ $department }}" <?php if($department== "Permissions") echo "selected"; ?>>Permissions</option>
        <option value="{{ $department }}" <?php if($department== "Planning") echo "selected"; ?>>Planning</option>
        <option value="{{ $department }}" <?php if($department== "PMO") echo "selected"; ?>>PMO</option>
        <option value="{{ $department }}" <?php if($department== "Prop") echo "selected"; ?>>Prop</option>
        <option value="{{ $department }}" <?php if($department== "Regional") echo "selected"; ?>>Regional</option>
        <option value="{{ $department }}" <?php if($department== "Management") echo "selected"; ?>>Management</option>
        <option value="{{ $department }}" <?php if($department== "Sales") echo "selected"; ?>>Sales</option>
        <option value="{{ $department }}" <?php if($department== "SHEQ") echo "selected"; ?>>SHEQ</option>
        <option value="{{ $department }}" <?php if($department== "External") echo "selected"; ?>>External</option>
     </select>
     </div>
    <div class="left-aligne">
     <label>Location</label>
      <select class="form-control" name="location" required>
        <option value="" selceted></option>
        <option value="GAU">GAU</option>
        <option value="KZN">KZN</option>
        <option value="WC">WC</option>
     </select>
     </div>
     <div class="right-aligne">
     <label>Priority</label>
      <select class="form-control" name="priority">
        <option value="P3">P3</option>
        <option value="P1">P1</option>
        <option value="P2">P2</option>
        
     </select>
     </div>
     <div class="left-aligne">
       <label>Impact</label>
       <select class="form-control" name="impact" required>
        <option value="" selceted></option>
        <option value="Enterprize">Enterprize</option>
        <option value="Multiple">Multiple</option>
        <option value="Users">Users</option>
        <option value="Single Users">Single Users</option>
     </select>
     </div>
     <div class="right-aligne">
       <label>Service</label>
       <select class="form-control" name="service">
        <option value="" selceted></option>
        <option value="Incident">Incident</option>
        <option value="Request">Request</option>
        <option value="Fulfilment">Fulfilment</option>
       </select>
     </div>
     <div class="left-aligne">
       <label>Category</label>
       <select class="form-control" name="category" required>
        <option value="" selceted></option>
        <option value="Network">Network</option>
        <option value="Emails">Emails</option>
        <option value="Printer">Printer</option>
        <option value="VPN">VPN</option>
        <option value="Sharepoint">Sharepoint</option>
        <option value="Teams">Teams</option>
        <option value="Teemyco">Teemyco</option>
        <option value="Internet">Internet</option>
        <option value="Application">Application</option>
        <option value="Other">Other</option>
       </select>
     </div>
     <div class="right-aligne">
       <label>Assignement group</label>
       <select class="form-control" name="assignement_group" required>
        <option value="IT Support">IT Support</option>
       </select>
     </div>
     <div class="left-aligne">
       <label>Assignee</label>
       <select class="form-control" name="assigne" required>
        <option value="" selceted></option>
        <option value="Tshegofatso Motsumi">Tshegofatso Motsumi</option>
        <option value="Nkosi Mathebula">Nkosi Mathebula</option>
        <option value="Roith Gareeb">Roith Gareeb</option>
       </select>
     </div>
     <div class="right-aligne">
       <label>External Vendor</label>
       <input id="requester" type="text" name="external_vendor" class="form-control" value="">
     </div>
     <div class="left-aligne">
       <label>External Reference</label>
       <input id="requester" type="text" name="external_reference" class="form-control" value="">
     </div>
     <div class="right-aligne">
       <label>Resolution Date</label>
       <div class="input-group date" id="custom_date_picker" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="resolution_date" id="resolution_date" data-target="#custom_date_picker">
                                    <div class="input-group-append" data-target="#custom_date_picker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
      </div>
     <div class="Subject-innner">
       <label>Resolution Comments</label>
       <input id="requester" type="text" name="resolution_comment" class="form-control" value="">
     </div>
      <div class="file-up ">
         <span class="input-group-btn">
          <input type="file" id="filenames" name="filenames[]" multiple>
        </span>  
      </div>
              
              <div class="delt-op">
                    <!--button class="trash-bt" type="button"><img  src="{{URL::asset('/public/admin/images/trash.png')}}" alt="#"></button-->  
                      <button class="btn sand-enq btn-primary" type="submit">Send</button>
              </div>
                  </form>
                  @if (Session::has('success'))
                      <p class="success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('unsuccess'))
                      <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
                    @endif
      </div>
          
		    <!--[/Chat Footer]-->
        </div>
      </div>
    </div>

  </div>
</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<style>.file-up {
    width: 37%;
}
.delt {
    width: 40%;
}</style>
 <!-- DataTables  & Plugins -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   <!-- jQuery UI 1.11.4 -->
   <script src="{{ asset('public/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
   <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
   <script>
      $.widget.bridge('uibutton', $.ui.button)
   </script>
   <!-- Bootstrap 4 -->
   <script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <!-- ChartJS -->
   <script src="{{ asset('public/admin/plugins/chart.js/Chart.min.js') }}"></script>
   <!-- Sparkline -->
   <script src="{{ asset('public/admin/plugins/sparklines/sparkline.js') }}"></script>
   <!-- JQVMap -->
   <script src="{{ asset('public/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
   <!-- jQuery Knob Chart -->
   <script src="{{ asset('public/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
   <!-- daterangepicker -->
   <script src="{{ asset('public/admin/plugins/moment/moment.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
   <!-- Tempusdominus Bootstrap 4 -->
   <script src="{{ asset('public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
   <!-- Summernote -->
   <script src="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
   <!-- overlayScrollbars -->
   <script src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('public/admin/dist/js/adminlte.js') }}"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
   <!-- bootstrap color picker -->
   <script src="{{ asset('public/admin/plugins//bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script src="{{ asset('public/admin/dist/js/pages/dashboard.js') }}"></script>
 <script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/jszip/jszip.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
   <script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('public/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script>
      $(function () {
         //Colorpicker
         $('.my-colorpicker1').colorpicker()
         //Date picker
        $('#custom_date_picker').datetimepicker({
            format: 'L'
        });
        $('#custom_date_picker1').datetimepicker({
            format: 'L'
        });
      });
      </script>
      <script>
          $('#example').DataTable({
              });
        </script>
<script>
  jQuery(function () {
    jQuery(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      jQuery(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    jQuery('.filter-container').filterizr({gutterPixels: 3});
    jQuery('.btn[data-filter]').on('click', function() {
      jQuery('.btn[data-filter]').removeClass('active');
      jQuery(this).addClass('active');
    });
  })
</script>
<!-- script for full tr clikable -->
<script>
 jQuery('*[data-href]').on("click",function(){
  window.location = $(this).data('href');
  return false;
});
jQuery("td > a").on("click",function(e){
  e.stopPropagation();
});
</script>
<script>
   jQuery("textarea").on("keydown", function(e) {
  if(e.altKey && e.keyCode === 13) {
      e.preventDefault();
      e.stopPropagation();
      jQuery(this).val($(this).val() + "\n");
  } else if(e.keyCode === 13) {
      e.preventDefault();
      e.stopPropagation();
      jQuery(this).parents('form').submit();      
  }
});
</script>
<script src="{{ asset('public/admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
 <!--Call chat files only for help chat start -->
 <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
        <script type="text/javascript" src="{{ asset('public/admin/js/chat.js') }}"></script>
    <!--call chat files only for help chat end -->
</body>
</html>