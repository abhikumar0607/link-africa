<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapop extends Model
{
    use HasFactory;
    protected $table = 'la_pops';
     protected $fillable = ['pop_id','area','isp_plan_date','area_name','sumission_permission','pop_type','date_approved_from_permission','pop_name','boq_release_date','pop_address','comments','lat','pop_status','long','land_lord_name','planning_progress_status','land_lord_contact','isp_capacity_planner','survey_date'];
}
