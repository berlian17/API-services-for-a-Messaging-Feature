<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'room_chat_id', 'from_user_id', 'to_user_id', 'message', 'status'
    ];

    public function roomChat() {
        return $this->belongsTo(RoomChat::class);
    }
}
