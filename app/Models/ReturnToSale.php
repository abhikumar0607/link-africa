<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnToSale extends Model
{
    use HasFactory;
	protected $table ='return_to_sales';
	protected $fillable = ['return_to_sale'];
}
