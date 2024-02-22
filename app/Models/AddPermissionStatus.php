<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddPermissionStatus extends Model
{
    use HasFactory;
	Protected $table = 'permission_status';
	Protected $fillable = ['permission_status'];
}
