<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    protected $fillable = [
        'group_id',
        'sender_id',
        'message',
        'image',
    ];


    public function sender()
{
    return $this->belongsTo(User::class,'sender_id');
}
}
