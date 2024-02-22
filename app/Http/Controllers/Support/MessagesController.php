<?php

namespace App\Http\Controllers\Support;

use App\Lib\PusherFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GlobalHelper;
use App\Models\Message;
use App\Models\User;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
 
    /**
     * getLoadLatestMessages
     *
     *
     * @param Request $request
     */
    public function getLoadLatestMessages(Request $request)
    {
        if(!$request->user_id) {
            return;
        }
 
        $messages = Message::where(function($query) use ($request) {
            $query->where('from_user', Auth::user()->id)->where('to_user', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->user_id)->where('to_user', Auth::user()->id);
        })->orderBy('created_at', 'ASC')->limit(10)->get();
 
        $return = [];
 
        foreach ($messages as $message) {
            //Update from user seen status
            Message::where('from_user', Auth::user()->id)->where('from_seen_status', '1')->update(['from_seen_status' => '0']);
            //Update to user seen status
            Message::where('to_user', Auth::user()->id)->where('to_seen_status', '1')->update(['to_seen_status' => '0']);
            
            $return[] = view('support-dashboard.message-line')->with('message', $message)->render();
        }
 
        return response()->json(['state' => 1, 'messages' => $return]);
    }

	/**
     * postSendMessage
     *
     * @param Request $request
     */
    public function postSendMessage(Request $request)
    {
        $message = new Message();
        $message->from_user = Auth::user()->id;
        $message->to_user = $request->to_user;
        $message->content = $request->message;
        $message->save();
 
 
        // prepare some data to send with the response
        $message->dateTimeStr = date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString()));
        $message->dateHumanReadable = $message->created_at->diffForHumans();
        $message->fromUserName = $message->fromUser->name;
        $message->fromUserProfile = $message->fromUser->avatar;
        $message->from_user_id = Auth::user()->id;
        $message->toUserName = $message->toUser->name;
        $message->toUserProfile = $message->toUser->avatar;
        $message->to_user_id = $request->to_user;

        PusherFactory::make()->trigger('my-channel', 'send', ['data' => $message]);
 
        return response()->json(['state' => 1, 'data' => $message]);
    }

	/**
     * getOldMessages
     *
     * we will fetch the old messages using the last sent id from the request
     * by querying the created at date
     *
     * @param Request $request
     */
    public function getOldMessages(Request $request)
    {
        
        if(!$request->old_message_id || !$request->to_user)
            return;
 
        $message = Message::find($request->old_message_id);
 
        $lastMessages = Message::where(function($query) use ($request, $message) {
            $query->where('from_user', Auth::user()->id)
                ->where('to_user', $request->to_user)
                ->where('created_at', '<', $message->created_at);
        })
            ->orWhere(function ($query) use ($request, $message) {
            $query->where('from_user', $request->to_user)
                ->where('to_user', Auth::user()->id)
                ->where('created_at', '<', $message->created_at);
        })
        ->orderBy('created_at', 'ASC')->limit(10)->get();
 
        $return = [];
 
        if($lastMessages->count() > 0) {
 
            foreach ($lastMessages as $message) { 
                //Update from user seen status
                Message::where('from_user', Auth::user()->id)->where('from_seen_status', '1')->update(['from_seen_status' => '0']);
                //Update to user seen status
                Message::where('to_user', Auth::user()->id)->where('to_seen_status', '1')->update(['to_seen_status' => '0']);

                $return[] = view('support-dashboard.message-line')->with('message', $message)->render();
            }
 
            PusherFactory::make()->trigger('my-channel', 'oldMsgs', ['to_user' => $request->to_user, 'data' => $return]);
        }
 
        return response()->json(['state' => 1, 'data' => $return]); 
    } 

    public function chat_page(Request $request){
        // $name = $request->search;
        // $search_users = GlobalHelper::help_chat_user_list($name);
        // Do something with the users, or return the result
        return view('support-dashboard/chat-page');
    }

    //function for search users
    public function search_users(Request $request){
        $name = $request->search;
        //$user = Auth::user(); 
        $users = User::where('name', 'LIKE', '%' . $name . '%')->whereNotIn('user_type', ['customer'])->get();
        //echo "<pre>";print_r($users);exit;
        // Do something with the users, or return the result

        echo "<div id='frame' class='chat_user_list'>
                <div id='sidepanel'>
                    <div id='profile cross-btnnn'>
                        <div class='wrap'>
                            <div class='chat-header'>
                                <img id='profile-img' src='" . asset('public/uploads/users/' . Auth::user()->avatar) . "' class='online' alt='" . Auth::user()->avatar . "' />
                                <p class='author-name'>" . Auth::user()->name . "</p>
                            </div>
                        </div>
                    </div>
                    <div id='contacts'>
                        <ul id='users'>";

        if ($users->count() > 0) {
            $count_user = 1;
            foreach ($users as $user) {
                echo "<li class='contact'>
                        <div class='wrap'>
                            <a href='javascript:void(0);' class='chat-toggle " . ($count_user == 1 ? 'active first_active' : '') . "' data-id='" . $user->id . "' data-user='" . $user->name . "'>";

                if ($user->online_status == 1) {
                    echo "<span class='contact-status online'></span>";
                } else {
                    echo "<span class='contact-status offline'></span>";
                }

                echo "<div class='charuserimg'>
                        <img src='" . asset('public/uploads/users/' . $user->avatar) . "' alt='" . $user->avatar . "' />
                    </div>
                    <div class='meta chat-studen'>
                        <p class='name'>" . $user->name . "</p>
                    </div>
                </a>
            </div>
        </li>";
                $count_user++;
            }
        } else {

            echo "<li class='contact'>
            <div class='wrap'>
            <p>No Result Found</p>
            </div>
            </li>";
        }

        echo "</ul>
            </div>
        </div>
        </div>";
    }
}
