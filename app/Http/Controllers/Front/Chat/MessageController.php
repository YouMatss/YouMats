<?php

namespace App\Http\Controllers\Front\Chat;

use App\Events\PrivateMessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct() {
        parent::__construct();

        $this->middleware('auth:web')->only('userConversations');
        $this->middleware('auth:vendor')->only('vendorConversations');
    }

    public function userConversations($vendor_id) {
        $data['auth_user'] = User::findorfail(auth('web')->id());
        $data['vendors'] = $data['auth_user']->vendors_conversations();
        $data['vendor'] = Vendor::findorfail($vendor_id);

        if($data['auth_user']->type != 'individual') {
            abort(401);
        }

        return view('front.chat.userConversations')->with($data);
    }

    public function vendorConversations($user_id) {
        $data['auth_vendor'] = Vendor::findorfail(auth('vendor')->id());
        $data['users'] = $data['auth_vendor']->users_conversations();
        $data['user'] = User::findorfail($user_id);

        if($data['user']->type != 'individual') {
            abort(401);
        }

        return view('front.chat.vendorConversations')->with($data);
    }

    public function sendMessage(Request $request) {
        $request->validate([
            'message' => 'required',
            'receiver_id' => 'required',
            'sender_type' => 'required|In:user,vendor',
            'receiver_type' => 'required|In:user,vendor'
        ]);

        $sender_id = Auth::id();
        $receiver_id = $request->receiver_id;
        $sender_type = $request->sender_type;
        $receiver_type = $request->receiver_type;

        $message = new Message();
        $message->message = $request->message;

        if($message->save()) {
            try {
                $message->users()->attach($sender_id, [
                    'receiver_id' => $receiver_id,
                    'sender_type' => $sender_type,
                    'receiver_type' => $receiver_type
                ]);
                $sender = User::where('id', $sender_id)->first();

                $data = [];
                $data['sender_id'] = $sender_id;
                $data['sender_name'] = $sender->name;
                $data['receiver_id'] = $receiver_id;
                $data['content'] = $message->message;
                $data['created_at'] = $message->created_at;
                $data['message_id'] = $message->id;

                event(new PrivateMessageEvent($data));

                return response()->json([
                    'data' => $data,
                    'success' => true,
                    'message' => 'Message sent successfully'
                ]);
            } catch (\Exception $e) {
                $message->delete();
            }
        }
    }

}
