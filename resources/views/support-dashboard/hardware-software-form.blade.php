@extends('support-dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
    <div class="form-section">
            <form method="post" action="{{ route('submit.software.form') }}">
                @csrf
                <div class="header-section">
                    <h3>Link Africa</h3>
                    <p>New user hardware and software requirements</p>
                </div>
                <div class="header-section-form">
                <div class="form-row">
                        <label>Employee Code</label>
                        <input type="text" name="employee_code" value="">
                    </div>
                    <div class="form-row">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="">
                    </div>
                    <div class="form-row">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="">
                    </div>
                    <div class="form-row">
                        <label>Department</label>
                        <input type="text" name="department" value="">
                    </div>
                    <div class="form-row">
                        <label>Employee Job Title</label>
                        <input type="text" name="employe_job_title" value="">
                    </div>

                </div>
                <div class="section_main_radio">
                    <div class="radio_section">
                        <h2>Type of Computer Required</h2>
                        <div class="radio_button">
                            <div class="radio-inner">
                                <input type="radio" id="" name="type_of_computer_required" value="Laptop">
                                <label for="">Laptop</label>
                                
                            </div>
                            <div class="radio-inner">                            
                                <input type="radio" id="" name="type_of_computer_required" value="Desktop">
                                <label for="">Desktop</label>
                            </div>
                            <div class="radio-inner"> 
                                <input type="radio" id="" name="type_of_computer_required" value="Re-assign">                           
                                <label for="">Re-assign</label>
                                
                            </div>
                        </div>
                    </div>

                    <div class="radio_section">
                        <h2>Region</h2>
                        <div class="radio_button">
                            <div class="radio-inner">
                                <input type="radio" id="" name="region" value="Durban">
                                <label for="">Durban</label>
                                
                            </div>
                            <div class="radio-inner">                            
                                <input type="radio" id="" name="region" value="Gauteng">
                                <label for="">Gauteng</label>
                            </div>
                            <div class="radio-inner">                            
                                <input type="radio" id="" name="region" value="Cape Town">
                                <label for="">Cape Town</label>
                            </div>
                        </div>
                    </div>

                    <div class="radio_section">
                        <h2>Printers Requirements</h2>
                        <div class="printers_button">
                            <div class="nters_button">
                                <div class="radio_box_inner">                            
                                    <input type="radio" id="" name="print_requirement" value="Yes">
                                    <label for="">Yes</label>
                                </div>
                                <div class="radio_box_inner">                            
                                    <input type="radio" id="" name="print_requirement" value="No">
                                    <label for="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="software_required">
                    <h2>Software Required</h2>
                    <div class="software_required_inner">
                        <div class="tware_requ">                           
                              <ul>                            
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Microsoft Office"><label>Microsoft Office</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="GIS"><label>GIS</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Antivirus"><label>Antivirus</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Adobe Acrobat"><label>Adobe Acrobat</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Winzip/Winrar"><label>Winzip/Winrar</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Google Map Pro"><label>Google Map Pro</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="VPN (for Laptop)"><label>VPN (for Laptop)</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Team viewer"><label>Team viewer</label></li>                            
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Anydesk"><label>Anydesk</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Rainbow"><label>Rainbow</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="PDF Redirect"><label>PDF Redirect</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Autocad"><label>Autocad</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="MS Visio"><label>MS Visio</label></li>

                                </ul>
                        </div>
                        
                        
                    <div class="offical_sec">
                        <div class="officla_inner">
                            <div class="offical_left_box">
                                <span><label>Telephone/Phoneline Requirements</label><input type="text" value="" name="telephone_requirement"></span>
                                <span class=""><label>Email Address</label><input type="email" name="email_address" value=""></span>
                            </div>
                            <div class="offical_left_box">
                                <span><label>Email Password</label><input type="text" name="email_password" value=""></span>
                                <span><label>Rainbow Password</label><input type="text" name="rainbow_password" value=""></span>
                            </div>
                        </div>

                     <div class="officla_inner officla_inner_last ">
                        <div class="offical_left_box ">
                                <span><label>O2CAP Password</label><input type="text" value="" name="o2cap_password"></span>
                                <span class="sig_nature"><label>User Signature</label><input type="text " name="user_signature" value=""></span>
                            </div>
                            <div class="offical_left_box">
                               <span class=""><label>User Signature Date</label><input type="date" name="user_signature_date" value=""></span>
                            </div>
                        </div>

                    </div>
                
                    <input type="submit" value="Submit" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
