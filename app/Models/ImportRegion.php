<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportRegion extends Model
{
    use HasFactory;
    protected $table = 'manage_sa_regions';

    protected $fillable = ['province','region','province_code','munic_name','namecode','map_title','district','district_n'];
}
