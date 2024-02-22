<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThirdPartyProvider extends Model
{
    use HasFactory;
    Protected $table = 'thrd_party_provider';
    Protected $fillable = ['thrd_party_provider'];
}
