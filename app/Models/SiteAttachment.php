<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteAttachment extends Model
{
    use HasFactory;
    protected $table = 'site_attachment';
    protected $fillable = ['service_id','circuit_id','attachment_name','page_type','form_type','name'];
}
