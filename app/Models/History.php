<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history_managment';

    protected $fillable = ['service_id','user_id','module_name','page_name','status','field','value'];


    public function user_list(){
        return $this->belongsTo(User::class,'user_id','id'); 
    }
}
