<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddComment extends Model
{
    use HasFactory;
    protected $table = 'add_comments';

    protected $fillable = ['name'];
}
