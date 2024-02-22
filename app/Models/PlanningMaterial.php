<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningMaterial extends Model
{
    use HasFactory;
    
    protected $table = 'planning_materials';

    protected $fillable = ['stock_code','description','unit_measurement','list_price','stock_code_description','catergory'];
}
