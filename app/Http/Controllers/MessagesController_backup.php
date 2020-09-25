<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendMailable;
use Mail;
use DB;
use Session;
use App\Events\NewMessage;
use Input;
use Redirect;
use Response;
use App\Models\Message;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Gig;
use App\Models\Notification;
use App\Models\User;

class MessagesController extends Controller {

    public function __construct() {
        $this->middleware('is_userlogin',  ['except' => ['']]);
    }
    public function getMessages(Request $request, $id){
        // $messages = Message::where('from', $id)->orWhere('to', $id)->get();
        Message::where('sender_id', $id)->where('receiver_id', auth()->id())->update(['status' => 1]);
        $messages = Message::where(function($q) use($id) {
            $q->where('sender_id', Session::get('user_id'));
            $q->where('receiver_id', $id);
        })->orWhere(function($q) use($id) {
            $q->where('sender_id', $id);
            $q->where('receiver_id', Session::get('user_id'));
        })->orderBY('created_at', 'DESC')->paginate($request->perPage);
        return response()->json($messages);
    }
    public function sendMessage(Request $request, $id){
        $message = Message::create([
            'sender_id' => Session::get('user_id'),
            'receiver_id' => $id,
            'message' => $request->message,
            'status' => 0
        ]);
        broadcast(new NewMessage($message));
        return response()->json($message);
    }
    public function message(Request $request, $slug = null) {
        $pageTitle = 'Users Message';
        $receiver = auth()->user();
        
        return view('messages.message', ['title' => $pageTitle, 'receiver' => $receiver]);  
    }

    public function download(Request $request, $slug, $filename) {
        $fname = substr($filename, 9);
        $file_path = DOCUMENT_UPLOAD_PATH . $filename;
        return Response::download($file_path, $fname, ['Content-Length: ' . filesize($file_path)]);
    }
    public function contacts(){
        $id = Session::get('user_id');

        $contacts = User::whereHas('messagesSent', function($query) use ($id){
            $query->where('receiver_id', '=', $id);
            })
            ->orWhereHas('messagesReceived', function($query) use($id){
                $query->where('sender_id', $id);
            })
            ->withCount(['unreadMessages' => function ($query) use ($id) {
                $query->where('receiver_id', '=', $id);
            
            }])->withCount(['unreadMessages' => function ($query) use ($id) {
                $query->where('receiver_id', '=', $id);
            
            }])
            ->with('lastMessage')->where('id', '!=', $id)
            ->
            get();
            return response()->json($contacts);
    }
    // public function getUnreadCount(){
    //     $unreadCount = Message::where('status', 0)->where('receiver_id', auth()->id())->count();
    //     return $unreadCount;
    // }
    public function getUnreadCount(){
         $id = auth()->id();
        $unread = Message::with('Sender')->where('status', 0)->where('receiver_id', auth()->id())->latestSendersMessages();
       
        // $unread = User::whereHas('MessagesSent', function($query) use ($id){
        //     $query->where('receiver_id', '=', $id)
        //     ->where('status', 0)
        //     ->latest();
        //     })->with(['MessagesSent' => function($q) use ($id) {
        //               $q->where('receiver_id', $id)
        //                 ->where('status', 0)
        //                 ->latest()
        //                 ->first();
        //     }])->where('id', '!=', $id)
        //     ->get();
          
        return $unread;
        
    }
    public function deleteMessages($id){
        $messages = Message::where('sender_id', $id)->where('receiver_id', auth()->id())
        ->orWhere('sender_id', $id)->where('receiver_id', auth()->id())->delete();
        return response('success');
    }

}
