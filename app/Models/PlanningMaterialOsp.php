<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningMaterialOsp extends Model
{
    use HasFactory;
    
    protected $table = 'planning_materials_service_osp';

    protected $fillable = ['service_id','circuit_id','stock_code','quantity','osp_build_type'];

    //fuction for get planing material record
    public function planning_material_record(){
        return $this->belongsTo(PlanningMaterial::class,'stock_code','stock_code'); 
    }
}
