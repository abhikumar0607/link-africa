<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamName extends Model
{
    use HasFactory;
    protected $table = 'kam_names';
    protected $fillable = ['kam_name'];
}
