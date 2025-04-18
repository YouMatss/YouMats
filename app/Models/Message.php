<?php

namespace App\Models;

use App\Helpers\Traits\UnicodeJsonColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, UnicodeJsonColumn;

    protected $guarded = ['id'];

    public function user_messages() {
        return $this->hasMany(UserMessage::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_messages', 'message_id', 'sender_id')
            ->withTimestamps();
    }
}
