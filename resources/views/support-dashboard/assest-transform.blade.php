@extends('support-dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
    <div class="form-section">
    <form action="{{ route('submit.assest.form') }}" Method="post">
                @csrf
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

                <div class="row-trans-asset">
                    <div class="asset-left">
                        <h2> TRANSFER ASSET</h2>
                    </div>
                    <div class="main-trans-asset">
                    
                        <div class="right-side">
                            <div class="inner-box radio-button">
                              <input type="radio" id="html" name="transfer_assest" value="LA to EMP">
                                <label for="html">LA to EMP</label><br>
                                <input type="radio" id="css" name="transfer_assest" value="EMP to LA">
                                <label for="css">EMP to LA </label><br>
                            </div>
                        </div>
                        <div class="right-side">
                            <label>EMP CODE</label>
                            <input type="text" name="emp_code" value="">
                        </div>
                    
                        <div class="right-side">
                          <label>DATE OF TRANSFER:</label>
                                <div class="input-group date" id="custom_date_picker" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="date_of_transfer" id="date_of_transfer" data-target="#custom_date_picker" data-date-end-date="0d">
                                    <div class="input-group-append" data-target="#custom_date_picker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    
                </div>
                <!---EMPLOYEE DETAILS --->
                <div class="row-section">
                    <h2>EMPLOYEE DETAILS</h2>
                    <div class="date-transfer-detail">                        
                        <div class="right-side">
                            <label>NAME</label>
                            <input type="text" name="name" value="">
                        </div>                       
                        <div class="right-side">
                            <label>TELEPHONE</label>
                            <input type="text" id="telephone" name="telephone" value="">
                        </div>                        
                        <div class="right-side">   
                            <label>EMAIL</label>
                            <input type="email" name="email" value="">
                        </div>
                    </div>
                </div>

                <!---EMPLOYEE DETAILS --->
                <!--- DETAILS ASSEST--->
                    <div class="detail-assest">
                        <h2>DETAILS ASSEST</h2>
                        <div class="assest-detail"> 
                        <div class="right-side">
                                <label>DEVICE DESCRIPTION</label>    
                                <select class="form-control" name="device_description" id="device_description"> 
                                    <option value="Laptop">Laptop</option>       
                                    <option value="Laptop bag">Laptop bag</option>       
                                    <option value="Headsets">Headsets</option>       
                                    <option value="Mouse">Mouse</option>       
                                    <option value="Cable/ Cable Converter">Cable/ Cable Converter</option>       
                                    <option value="Charger">Charger</option>       
                                    <option value="Desktop Computer">Desktop Computer</option>       
                                    <option value="Keyboard">Keyboard</option>       
                                    <option value="Monitor">Monitor</option>       
                                    <option value="TV">TV</option>       
                                    <option value="Other">Other</option>       
                                </select>                        
                            </div>                           
                            <div class="right-side">
                                <label>DEVICE MAKE - MODEL</label>
                                <input type="text" name="device_make_model" value="">
                            </div>
                            
                            <div class="right-side">                                
                                <label>Device Serial Number</label>
                                <input type="text" name="device_serial_number" value="">
                            </div>
                            <div class="right-side">
                                <label>POWER CORD/CHARGER</label>    
                                <select class="form-control" name="power_charger" id="power_charger"> 
                                    <option value="Yes">Yes</option>       
                                    <option value="No">No</option>       
                                </select>                        
                            </div>
                            <div class="right-side">
                                <label>Keys</label>
                                <select class="form-control" name="keys" id="keys"> 
                                    <option value="Yes">Yes</option>       
                                    <option value="No">No</option>       
                                </select> 
                            </div>
                            <div class="right-side">
                                <label>Access Card</label>                                                  
                                <select class="form-control" name="access_card" id="access_card"> 
                                    <option value="Yes">Yes</option>       
                                    <option value="No">No</option>       
                                </select> 
                            </div>
                            <div class="right-side">
                                <label>Gate Remotes</label>
                                <select class="form-control" name="gate_remotes" id="gate_remotes"> 
                                    <option value="Yes">Yes</option>       
                                    <option value="No">No</option>       
                                </select> 
                            </div>                       
                            <div class="right-side">                                
                                <label>Measuring Wheel</label>
                                <select class="form-control" name="measuring_wheel" id="measuring_wheel"> 
                                    <option value="Yes">Yes</option>       
                                    <option value="No">No</option>       
                                </select>
                            </div>
                            <div class="right-side">
                                <label>COMMENTS </label>
                                <textarea value="" name="comments"></textarea>
                            </div>
                            <div class="right-side">
                                <label>Staff Signature</label>
                                <textarea value="" name="staff_signature"></textarea>
                            </div>
                            <div class="right-side">   
                                <label>Link Africa Representative</label>                                 
                                <input type="text" name="link_africa_representive" value="">
                            </div>
                            <div class="right-side">
                                <label>Date</label>
                                <div class="input-group date" id="custom_date_picker1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="date" id="date_of_transfer" data-target="#custom_date_picker1" data-date-end-date="0d">
                                    <div class="input-group-append" data-target="#custom_date_picker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="right-side">   
                                <label>Region</label>                                 
                                <input type="text" name="region" value="">
                            </div>
                            <div class="right-side">
                                <h2>ASSET POSESSION</h2>
                                <div class="inner-box radio-button">
                                    <input type="radio" id="html" name="assest_posession" value="In staff posession">
                                    <label for="html">In staff posession</label><br>
                                    <input type="radio" id="css" name="assest_posession" value="Not in staff posession">
                                    <label for="css">Not in staff posession</label><br>
                                    <input type="radio" id="css" name="assest_posession" value="Scraped">
                                    <label for="css">Scraped</label><br>
                               </div>    
                           </div>
                    </div>
                <!--- DETAILS ASSEST--->
                <input type="submit" value="Submit" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
