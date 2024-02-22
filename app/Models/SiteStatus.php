<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteStatus extends Model
{
    use HasFactory;
	Protected $table = 'site_status';
	Protected $fillable = ['site_status'];
}
