@extends('support-dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
    <div class="form-section">
            <form method="post" action="{{ route('update.software.form') }}">
                @csrf
                @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                <div class="header-section">
                    <h3>Link Africa</h3>
                    <p>New user hardware and software requirements</p>
                </div>
                <div class="header-section-form">
                <div class="form-row">
                        <label>Employee Code</label>
                        <input type="text" name="employee_code" value="{{ $software_detail->employee_code }}">
                        <input type="hidden" name="id" value="{{ $software_detail->id }}">
                    </div>
                    <div class="form-row">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{ $software_detail->first_name }}">
                    </div>
                    <div class="form-row">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ $software_detail->last_name }}">
                    </div>
                    <div class="form-row">
                        <label>Department</label>
                        <input type="text" name="department" value="{{ $software_detail->department }}">
                    </div>
                    <div class="form-row">
                        <label>Employee Job Title</label>
                        <input type="text" name="employe_job_title" value="{{ $software_detail->employe_job_title }}">
                    </div>

                </div>
                <div class="section_main_radio">
                    <div class="radio_section">
                        <h2>Type of Computer Required</h2>
                        <div class="radio_button">
                            <div class="radio-inner">
                                <input type="radio" id="" name="type_of_computer_required" value="Laptop" <?php echo ($software_detail->type_of_computer_required) == 'Laptop' ? 'checked'  :'' ; ?>>
                                <label for="">Laptop</label>
                                
                            </div>
                            <div class="radio-inner">                            
                                <input type="radio" id="" name="type_of_computer_required" value="Desktop" <?php echo ($software_detail->type_of_computer_required) == 'Desktop' ? 'checked'  :'' ; ?>>
                                <label for="">Desktop</label>
                            </div>
                            <div class="radio-inner"> 
                                <input type="radio" id="" name="type_of_computer_required" value="Re-assign" <?php echo ($software_detail->type_of_computer_required) == 'Re-assign' ? 'checked'  :'' ; ?>>                           
                                <label for="">Re-assign</label>
                                
                            </div>
                        </div>
                    </div>

                    <div class="radio_section">
                        <h2>Region</h2>
                        <div class="radio_button">
                            <div class="radio-inner">
                                <input type="radio" id="" name="region" value="Durban" <?php echo ($software_detail->region) == 'Durban' ? 'checked'  :'' ; ?>>
                                <label for="">Durban</label>
                                
                            </div>
                            <div class="radio-inner">                            
                                <input type="radio" id="" name="region" value="Gauteng" <?php echo ($software_detail->region) == 'Gauteng' ? 'checked'  :'' ; ?>>
                                <label for="">Gauteng</label>
                            </div>
                            <div class="radio-inner">                            
                                <input type="radio" id="" name="region" value="Cape Town" <?php echo ($software_detail->region) == 'Cape Town' ? 'checked'  :'' ; ?>>
                                <label for="">Cape Town</label>
                            </div>
                        </div>
                    </div>

                    <div class="radio_section">
                        <h2>Printers Requirements</h2>
                        <div class="printers_button">
                            <div class="nters_button">
                                <div class="radio_box_inner">                            
                                    <input type="radio" id="" name="print_requirement" value="Yes" <?php echo ($software_detail->print_requirement) == 'Yes' ? 'checked'  :'' ; ?>>
                                    <label for="">Yes</label>
                                </div>
                                <div class="radio_box_inner">                            
                                    <input type="radio" id="" name="print_requirement" value="No" <?php echo ($software_detail->print_requirement) == 'No' ? 'checked'  :'' ; ?>>
                                    <label for="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="software_required">
                    <h2>Software Required</h2>
                    <div class="software_required_inner">
                        <?php $software_requirement = explode(', ',$software_detail->software_requirement);  ?>
                        <div class="tware_requ">                           
                              <ul>                            
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Microsoft Office" <?php if (in_array('Microsoft Office', $software_requirement)) { echo 'checked'; } ?>><label>Microsoft Office</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="GIS" <?php if (in_array('GIS', $software_requirement)) { echo 'checked'; } ?>><label>GIS</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Antivirus" <?php if (in_array('Antivirus', $software_requirement)) { echo 'checked'; } ?>><label>Antivirus</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Adobe Acrobat" <?php if (in_array('Adobe Acrobat', $software_requirement)) { echo 'checked'; } ?>><label>Adobe Acrobat</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Winzip/Winrar" <?php if (in_array('Winzip/Winrar', $software_requirement)) { echo 'checked'; } ?>><label>Winzip/Winrar</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Google Map Pro" <?php if (in_array('Google Map Pro', $software_requirement)) { echo 'checked'; } ?>><label>Google Map Pro</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="VPN (for Laptop)" <?php if (in_array('VPN (for Laptop)', $software_requirement)) { echo 'checked'; } ?>><label>VPN (for Laptop)</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Team viewer" <?php if (in_array('Team viewer', $software_requirement)) { echo 'checked'; } ?>><label>Team viewer</label></li>                            
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Anydesk" <?php if (in_array('Anydesk', $software_requirement)) { echo 'checked'; } ?>><label>Anydesk</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Rainbow" <?php if (in_array('Rainbow', $software_requirement)) { echo 'checked'; } ?>><label>Rainbow</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="PDF Redirect" <?php if (in_array('PDF Redirect', $software_requirement)) { echo 'checked'; } ?>><label>PDF Redirect</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="Autocad" <?php if (in_array('Autocad', $software_requirement)) { echo 'checked'; } ?>><label>Autocad</label></li>
                                    <li><input type="checkbox" id="" name="software_requirement[]" value="MS Visio" <?php if (in_array('MS Visio', $software_requirement)) { echo 'checked'; } ?>><label>MS Visio</label></li>

                                </ul>
                        </div>
                        
                        
                    <div class="offical_sec">
                        <div class="officla_inner">
                            <div class="offical_left_box">
                                <span><label>Telephone/Phoneline Requirements</label><input type="text" value="{{ $software_detail->telephone_requirement }}" name="telephone_requirement"></span>
                                <span class=""><label>Email Address</label><input type="email" name="email_address" value="{{ $software_detail->email_address }}"></span>
                            </div>
                            <div class="offical_left_box">
                                <span><label>Email Password</label><input type="text" name="email_password" value="{{ $software_detail->email_address }}"></span>
                                <span><label>Rainbow Password</label><input type="text" name="rainbow_password" value="{{ $software_detail->rainbow_password }}"></span>
                            </div>
                        </div>

                     <div class="officla_inner officla_inner_last ">
                        <div class="offical_left_box ">
                                <span><label>O2CAP Password</label><input type="text" value="{{ $software_detail->o2cap_password }}" name="o2cap_password"></span>
                                <span class="sig_nature"><label>User Signature</label><input type="text " name="user_signature" value="{{ $software_detail->user_signature }}"></span>
                            </div>
                            <div class="offical_left_box">
                               <span class=""><label>User Signature Date</label><input type="date" name="user_signature_date" value="{{ $software_detail->user_signature_date }}"></span>
                            </div>
                        </div>

                    </div>
                
                    <input type="submit" value="Submit" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
