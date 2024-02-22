<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User; 

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [ 
        'from_user', 'to_user', 'content', 'from_seen_status', 'to_seen_status'
    ];

    public function fromUser()
    {
        return $this->belongsTo('App\Models\User', 'from_user');
    }

    public function toUser()
    {
        return $this->belongsTo('App\Models\User', 'to_user');  
    }
}
