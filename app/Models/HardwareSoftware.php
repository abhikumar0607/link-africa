<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareSoftware extends Model
{
    use HasFactory;
    protected $table = 'hardware_software_requirement';
    protected $fillable = ['employee_code','first_name','last_name','department','employe_job_title','region','email_address','type_of_computer_required',
    'telephone_requirement','print_requirement','software_requirement','email_password','rainbow_password','o2cap_password','user_signature','user_signature_date'];
}
