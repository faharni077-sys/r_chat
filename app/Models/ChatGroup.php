<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    public function messages()

    
{
    return $this->hasMany(GroupMessage::class,'group_id');
}

public function members()
{
    return $this->hasMany(GroupMember::class, 'group_id');
}

  protected $fillable = [
    'group_name',
    'admin_id',
];
}
