@extends('support-dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
    <div class="form-section">
            <form action="{{ route('update.assest.form') }}" Method="post">
                @csrf
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
                <div class="row-asset-trans">
                  
                </div>

                <div class="row-trans-asset">
                    <div class="asset-left">
                        <h2> TRANSFER ASSET</h2>
                    </div>
                    <div class="main-trans-asset">
                    
                        <div class="right-side">
                            <div class="inner-box radio-button">
                              <input type="radio" id="html" class="form-control" name="transfer_assest" value="LA to EMP" <?php echo ($assest->transfer_assest) == 'LA to EMP' ? 'checked'  :'' ; ?>>
                                <label for="html">LA to EMP</label><br>
                                <input type="radio" id="css" class="form-control" name="transfer_assest" value="EMP to LA" <?php echo ($assest->transfer_assest) == 'EMP to LA' ? 'checked'  :'' ; ?>>
                                <label for="css">EMP to LA</label><br>
                            </div>
                        </div>
                        <div class="right-side">
                            <label>EMP CODE</label>
                            <input type="text" class="form-control" name="emp_code" value="{{ $assest->emp_code }}">
                        </div>
                    
                        <div class="right-side">
                          <label>DATE OF TRANSFER:</label>
                                <div class="input-group date" id="custom_date_picker" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" value="{{ $assest->date_of_transfer }}" name="date_of_transfer" id="date_of_transfer" data-target="#custom_date_picker" data-date-end-date="0d">
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
                            <input type="text" name="name" class="form-control" value="{{ $assest->name }}">
                            <input type="hidden" name="id" value="{{ $assest->id }}">
                        </div>                       
                        <div class="right-side">
                            <label>TELEPHONE</label>
                            <input type="text" id="telephone" class="form-control" name="telephone" value="{{ $assest->telephone }}">
                        </div>                        
                        <div class="right-side">   
                            <label>EMAIL</label>
                            <input type="email" name="email" class="form-control" value="{{ $assest->email }}">
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
                                   <option value=""></option>
                                    <option value="Laptop" <?php if($assest->device_description == 'Laptop'){ echo 'selected="selected"'; } ?>>Laptop</option>       
                                    <option value="Laptop bag" <?php if($assest->device_description == 'Laptop bag'){ echo 'selected="selected"'; } ?>>Laptop bag</option>       
                                    <option value="Headsets" <?php if($assest->device_description == 'Laptop'){ echo 'selected="selected"'; } ?>>Headsets</option>       
                                    <option value="Mouse" <?php if($assest->device_description == 'Headsets'){ echo 'selected="selected"'; } ?>>Mouse</option>       
                                    <option value="Cable/ Cable Converter" <?php if($assest->device_description == 'Cable/ Cable Converter'){ echo 'selected="selected"'; } ?>>Cable/ Cable Converter</option>       
                                    <option value="Charger" <?php if($assest->device_description== 'Laptop'){ echo 'selected="selected"'; } ?>>Charger</option>       
                                    <option value="Desktop Computer" <?php if($assest->device_description == 'Desktop Computer'){ echo 'selected="selected"'; } ?>>Desktop Computer</option>       
                                    <option value="Keyboard" <?php if($assest->device_description == 'Keyboard'){ echo 'selected="selected"'; } ?>>Keyboard</option>       
                                    <option value="Monitor" <?php if($assest->device_description == 'Monitor'){ echo 'selected="selected"'; } ?>>Monitor</option>       
                                    <option value="TV" <?php if($assest->device_description == 'TV'){ echo 'selected="selected"'; } ?>>TV</option>       
                                    <option value="Other" <?php if($assest->device_description == 'Other'){ echo 'selected="selected"'; } ?>>Other</option>       
                                </select>                        
                            </div>                           
                            <div class="right-side">
                                <label>DEVICE MAKE - MODEL</label>
                                <input type="text" name="device_make_model" class="form-control" value="{{ $assest->device_make_model }}">
                            </div>
                            
                            <div class="right-side">                                
                                <label>Device Serial Number</label>
                                <input type="text" name="device_serial_number" class="form-control" value="{{ $assest->device_serial_number }}">
                            </div>
                            <div class="right-side">
                                <label>POWER CORD/CHARGER</label>    
                                <select class="form-control" name="power_charger" id="power_charger"> 
                                   <option value=""></option>
                                    <option value="Yes" <?php if($assest->power_charger== 'Yes'){ echo 'selected="selected"'; } ?>>Yes</option>       
                                    <option value="No" <?php if($assest->power_charger== 'No'){ echo 'selected="selected"'; } ?>>No</option>       
                                </select>                        
                            </div>
                            <div class="right-side">
                                <label>Keys</label>
                                <select class="form-control" name="keys" id="keys"> 
                                    <option value="Yes" <?php if($assest->keys == 'Yes'){ echo 'selected="selected"'; } ?>>Yes</option>       
                                    <option value="No"  <?php if($assest->keys == 'No'){ echo 'selected="selected"'; } ?>>No</option>       
                                </select> 
                            </div>
                            <div class="right-side">
                                <label>Access Card</label>                                                  
                                <select class="form-control" name="access_card" id="access_card"> 
                                    <option value=""></option>
                                    <option value="Yes" <?php if($assest->access_card == 'Yes'){ echo 'selected="selected"'; } ?>>Yes</option>       
                                    <option value="No" <?php if($assest->access_card == 'No'){ echo 'selected="selected"'; } ?>>No</option>       
                                </select> 
                            </div>
                            <div class="right-side">
                                <label>Gate Remotes</label>
                                <select class="form-control" name="gate_remotes" id="gate_remotes"> 
                                    <option value=""></option>
                                    <option value="Yes" <?php if($assest->gate_remotes == 'Yes'){ echo 'selected="selected"'; } ?>>Yes</option>       
                                    <option value="No" <?php if($assest->gate_remotes == 'No'){ echo 'selected="selected"'; } ?>>No</option>       
                                </select> 
                            </div>                       
                            <div class="right-side">                                
                                <label>Measuring Wheel</label>
                                <select class="form-control" name="measuring_wheel" id="measuring_wheel"> 
                                    <option value=""></option>
                                    <option value="Yes" <?php if($assest->measuring_wheel == 'Yes'){ echo 'selected="selected"'; } ?>>Yes</option>       
                                    <option value="No" <?php if($assest->measuring_wheel == 'No'){ echo 'selected="selected"'; } ?>>No</option>       
                                </select>
                            </div>
                            <div class="right-side">
                                <label>COMMENTS </label>
                                <textarea value="" class="form-control" name="comments">{{ $assest->comments }}</textarea>
                            </div>
                            <div class="right-side">
                                <label>Staff Signature</label>
                                <textarea value="" class="form-control" name="staff_signature">{{ $assest->staff_signature }}</textarea>
                            </div>
                            <div class="right-side">   
                                <label>Link Africa Representative</label>                                 
                                <input type="text" name="link_africa_representive" value="{{ $assest->link_africa_representive }}">
                            </div>
                            <div class="right-side">
                                <label>Date</label>
                                <div class="input-group date" id="custom_date_picker1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" value="{{ $assest->date }}" name="date" id="date_of_transfer" data-target="#custom_date_picker1" data-date-end-date="0d">
                                    <div class="input-group-append" data-target="#custom_date_picker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="right-side">   
                                <label>Region</label>                                 
                                <input type="text" class="form-control" name="region" value="{{ $assest->region }}">
                            </div>
                            <div class="right-side">
                                <h2>ASSET POSESSION</h2>
                                <div class="inner-box radio-button">
                                    <input type="radio" class="form-control" id="html" name="assest_posession" value="In staff posession" <?php echo ($assest->assest_posession) == 'In staff posession' ? 'checked'  :'' ; ?>>
                                    <label for="html">In staff posession</label><br>
                                    <input type="radio" class="form-control" id="css" name="assest_posession" value="Not in staff posession" <?php echo ($assest->assest_posession) == 'Not in staff posession' ? 'checked'  :'' ; ?>>
                                    <label for="css">Not in staff posession</label><br>
                                    <input type="radio" class="form-control" id="css" name="assest_posession" value="Scraped" <?php echo ($assest->assest_posession) == 'Scraped' ? 'checked'  :'' ; ?>>
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