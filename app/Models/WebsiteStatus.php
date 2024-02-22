<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteStatus extends Model
{
    use HasFactory;

    protected $table = 'website_status';

    protected $fillable = ['site_status', 'user_id'];
}
