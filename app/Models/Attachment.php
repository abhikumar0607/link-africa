<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $table ='attachments';
    protected $fillable = ['user_id', 'attachment_name', 'attachment_type', 'ticket_id', 'type'];
        //fuction for get user related ticket record list
      

}
