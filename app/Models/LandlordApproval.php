<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandlordApproval extends Model
{
    use HasFactory;

    protected $table = 'landlord_approval_records';

    protected $fillable = [ 
        'circuit_id','service_id','landlord_approval_status', 'landlord_date_received_from', 'date_submit_for_landlord',
         'date_landlord_approval','landlord_date_on_hold','landlord_date_received_from_site_a','date_submit_for_landlord_site_a','date_landlord_approval_site_a',
        'landlord_date_on_hold_site_a'];
}
