<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
     
    protected $table = 'sites';

    protected $fillable = ['site_name','contact_name','physical_address','gps_co_ordinates','gps_co_ordinates2','work_number','mobile_number','email_address','landlord_name','managing_agent','landlord_contact_number','site_type','module_type','unique_no'];
}
