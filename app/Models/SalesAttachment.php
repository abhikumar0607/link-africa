<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesAttachment extends Model
{
    use HasFactory;
    protected $table = 'sales_attachment';
    protected $fillable = ['service_id','circuit_id','attachment_name',];
}
