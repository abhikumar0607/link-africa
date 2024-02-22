<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SiteMasterFile;
use App\Models\PlanningMasterFile;

class DepartmentComment extends Model
{
    use HasFactory;
    protected $table = 'department_comments';
    protected $fillable = ['circuit_id','service_id','planning_comment','build_comment','permission_comment','service_delivery_comment'];
    
}
