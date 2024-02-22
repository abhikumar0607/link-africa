<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sd_Status extends Model
{
    use HasFactory;

    protected $table = 'sd_status';

    protected $fillable = ['name'];
}
