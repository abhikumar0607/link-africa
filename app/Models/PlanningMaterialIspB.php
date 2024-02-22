<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningMaterialIspB extends Model
{
    use HasFactory;
    
    protected $table = 'planning_materials_service_isp_bs';

    protected $fillable = ['service_id','circuit_id','stock_code','quantity','isp_b_build_type'];

    //fuction for get planing material record
    public function planning_material_record(){
        return $this->belongsTo(PlanningMaterial::class,'stock_code','stock_code'); 
    }
}
