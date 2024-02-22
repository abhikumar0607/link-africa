<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assest extends Model
{
    use HasFactory;

    protected $table = 'assest';
    protected $fillable = ['emp_code','transfer_assest','date_of_transfer','name','telephone','email','device_description','device_make_model','device_serial_number',
    'power_charger','keys','access_card','gate_remotes','measuring_wheel','measuring_wheel','comments','staff_signature','link_africa_representive','date',
    'region','assest_posession'];
}
