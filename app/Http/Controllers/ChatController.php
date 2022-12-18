<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\RoomChat;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index() {
        // Get all user
        $user = User::all();

        if($user) {
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => []
            ]);
        }
    }

    public function roomChatList(Request $request) {
        // Check room chat list
        $roomChat = RoomChat::where('from_user_id', $request->user()->id)
                            ->Orwhere('to_user_id', $request->user()->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $roomChat,
            // 'unread' => 
        ]);
    }

    public function roomChatDetail(Request $request, $room) {
        // Check room chat
        $roomChat = RoomChat::where('room', $room)->first();

        // Get message
        $message = Message::where('room_chat_id', $roomChat->id)->get();

        if($roomChat->from_user_id != $request->user()->id) {
            // Update status message
            foreach($message as $data) {
                $data->update([
                    'status' => true,
                ]);
            }
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $message,
        ]);
    }

    public function messageNewRoom(Request $request) {
        try {
            // Check room chat
            $roomChat = RoomChat::where('from_user_id', $request->user()->id)
                                ->where('to_user_id', $request->id)
                                ->first();

            // Get receiver data
            $receiver = User::where('id', $request->id)->get();

            if(!empty($request->message)) {
                if(empty($roomChat)) {
                    // Validation
                    $validation = $request->validate([
                        'message' => 'required',
                    ]);

                    // Create new room chat
                    $roomChat = RoomChat::create([
                        'room' => mt_rand(0000, 9999),
                        'from_user_id' => $request->user()->id,
                        'to_user_id' => $request->id,
                        'last_message' => $validation['message'],
                    ]);
                    $roomChat->save();
                }
    
                // Create new message
                $message = Message::create([
                    'room_chat_id' => $roomChat->id,
                    'from_user_id' => $request->user()->id,
                    'to_user_id' => $request->id,
                    'message' => $validation['message'],
                    'status' => false,
                ]);
                $message->save();

                return response()->json([
                    'code' => 200,
                    'message' => 'Success',
                    'data' => $message,
                    'receiver' => $receiver,
                ]);
            } else {

                return response()->json([
                    'code' => 400,
                    'message' => 'Failed',
                    'data' => [],
                ]);   
            }
        } catch(Exception $error) {

            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => [],
            ]);   
        }
    }

    public function messageWithRoom(Request $request, $room) {
        try {
            // Check room chat
            $roomChat = RoomChat::where('room', $room)->first();

            // Get receiver data
            $receiver = User::where('id', $request->id)->get();

            if(!empty($request->message)) {
                // Validation
                $validation = $request->validate([
                    'message' => 'required',
                ]);
    
                // Create new message
                $message = Message::create([
                    'room_chat_id' => $roomChat->id,
                    'from_user_id' => $request->user()->id,
                    'to_user_id' => $request->id,
                    'message' => $validation['message'],
                    'status' => false,
                ]);
                $message->save();

                // Update last message
                $roomChat->update([
                    'last_message' => $validation['message'],
                ]);

                return response()->json([
                    'code' => 200,
                    'message' => 'Success',
                    'data' => $message,
                    'receiver' => $receiver
                ]);
            } else {

                return response()->json([
                    'code' => 400,
                    'message' => 'Failed',
                    'data' => []
                ]);   
            }
        } catch(Exception $error) {

            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => []
            ]);  
        }
    }
}
