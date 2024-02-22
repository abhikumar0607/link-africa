<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddWayleavesStatus extends Model
{
    use HasFactory;
	Protected $table = 'wayleaves_status';
	Protected $fillable = ['wayleaves_status'];
}
