<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningStatus extends Model
{
    use HasFactory;
	Protected $table = 'planning_status';
	Protected $fillable = ['planning_status'];
}
