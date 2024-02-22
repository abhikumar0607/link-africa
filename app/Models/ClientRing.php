<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRing extends Model
{
    use HasFactory;
    protected $table = 'client_ring';
    protected $fillable = ['client_ring'];
}
