<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceTeam extends Model
{
    use HasFactory;
    protected $table = 'resource_team';

    protected $fillable = ['name'];
}
