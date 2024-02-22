<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class SupportTicket extends Model
{
    use HasFactory;

    protected $table = 'support_tickets';

    protected $fillable = ['ticket_id', 'user_id', 'description', 'status', 'subject','ticket_status','requester','requester_email_address','depaertment','location',
    'priority','impact','service','category','assignement_group','assigne','external_vendor','external_reference','resolution_date','resolution_comment'];
        //fuction for get ticket attachments list
        public function ticket_attachment_relation(){
            return $this->HasMany(TicketAttachment::class,'support_id','id')->with('attachment_image'); 
        }

        //fuction for get user name record list
        public function user_name(){
            return $this->belongsTo(User::class,'user_id','id'); 
        }
    
}
