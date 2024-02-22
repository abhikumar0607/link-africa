<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildStatus extends Model
{
    use HasFactory;
    Protected $table = 'build_status';
    Protected $fillable = ['build_status'];
}
