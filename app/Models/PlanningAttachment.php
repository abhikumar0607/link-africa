<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningAttachment extends Model
{
    use HasFactory;
    protected $table = 'planning_attachment';
    protected $fillable = ['service_id','circuit_id','planning_attachment',];
}
