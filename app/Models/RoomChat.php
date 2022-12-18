<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomChat extends Model
{
    use HasFactory;

    protected $table = 'room_chats';

    protected $fillable = [
        'room', 'from_user_id', 'to_user_id', 'last_message'
    ];

    public function message() {
        return $this->hasMany(Message::class);
    }
}
