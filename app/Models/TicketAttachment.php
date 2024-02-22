<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    use HasFactory;
    protected $table ='tickets_attachments';
    protected $fillable = ['ticket_id', 'attachment_id','support_id'];

   //fuction for get user name record list
   public function attachment_image(){
    return $this->belongsTo(Attachment::class,'attachment_id'); 
}

}
