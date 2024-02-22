<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseTermInMonth extends Model
{
    use HasFactory;
	Protected $table = 'lease_term_in_months';
	Protected $fillable = ['lease_term_in_month'];
}
