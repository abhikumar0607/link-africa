<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddServiceDeliveryStatus extends Model
{
    use HasFactory;
	Protected $table = 'service_delivery_status';
	Protected $fillable = ['service_delivery_status'];
}
