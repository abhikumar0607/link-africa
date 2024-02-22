<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddLandlordStatus extends Model
{
    use HasFactory;
	Protected $table = 'landlord_status';
	Protected $fillable = ['landlord_status'];
}
