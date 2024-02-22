<?php

namespace App\Helpers;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

use App\Models\User;
use App\Models\Message;
use App\Models\WebsiteStatus;
use App\Models\History;
use Illuminate\Support\Facades\Request;

class GlobalHelper
{
    public static function tickets_count()
    {
        $records = SupportTicket::where('status',0)->groupBy('ticket_id')->get()->count();
        return $records;
    }


    //helper for help chat
    public static function help_chat_user_list(){
        $user = Auth::user(); 
        $login_user_id = Auth::user()->id;

        //Check if current login user is super admin or not
        if(Auth::user()->user_type == 'Super_Admin') {
            $users = User::WhereNotIn('id',[$login_user_id])->where('user_type','admin')->get();
        } else {
            $users = User::WhereNotIn('id',[$login_user_id])->where('user_type','super_admin')->get();
        } 
        ?>

        <!--user chat list start-->
        <input type="text" id="search-input" placeholder="Search by name">
        <div class="show-user"></div> 
        <div class="hide-users">
        <div id="frame" class="chat_user_list">

            <div id="sidepanel">
                <div id="profile cross-btnnn">
                    <div class="wrap">
                        <div class="chat-header">
                        <img id="profile-img" src="<?php echo asset('public/uploads/users/'.Auth::user()->avatar ); ?>" class="online" alt="<?php echo Auth::user()->avatar; ?>" />
                        <p class="author-name"><?php echo Auth::user()->name; ?></p>
                    </div>
                        </div>
                </div>
                <div id="contacts">
                    <?php if($users->count() > 0){ ?>
                    <ul id="users">
                        <?php 
                        $count_user = 1;
                        foreach($users as $user) { ?>
                        <li class="contact">
                            <div class="wrap">
                                <a href="javascript:void(0);" class="chat-toggle <?php if($count_user == 1){ echo 'active first_active'; } ?>" data-id="<?php echo $user->id; ?>" data-user="<?php echo $user->name; ?>">
                                <?php if($user->online_status == 1) { ?>
                                    <span class="contact-status online"></span>
                                <?php } else { ?>
                                    <span class="contact-status offline"></span>
                                <?php } ?>
                                    <div class="charuserimg">
                                        <img src="<?php echo asset('public/uploads/users/'.$user->avatar ); ?>" alt="<?php echo $user->avatar; ?>" /></div>
                                    <div class="meta chat-studen">
                                        <p class="name"><?php echo $user->name; ?></p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <?php $count_user++; } ?>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        </div>

        <!--user chat list end-->

        <div class="user-chat-box-div">
            <div id="chat-overlay" class="row"></div>
            <div id="status"></div>
            <div id="chat_box" class="chat_box pull-right" style="display: none">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                            <div class="panel panel-default main-chat-box">
                                <div class="panel-heading">
                                    <h3 class="panel-title chat-with"><span class="glyphicon glyphicon-comment"></span> Chat with <i class="chat-user"></i></h3>
                                    <span class="glyphicon glyphicon-remove pull-right close-chat"><i class="fa fa-times" aria-hidden="true"></i></span>
                                </div>
                                <div class="panel-body chat-area sub-chat-area">

                                </div>
                            <div class="panel-footer send-message-footer">
                                    <div class="input-group form-controls">
                                        <form method="POST" id="send_new_message">
                                            <textarea id="chat_box_textarea" class="form-control input-sm chat_input chat-text" placeholder="Type a message..."></textarea>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary btn-sm btn-chat" type="button" data-to-user="" disabled>
                                                    <i class="glyphicon glyphicon-send"></i>
                                                    Send</button>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <input type="hidden" id="to_user_id" value="" /> 
            </div>
            <input type="hidden" id="current_user" value="<?php echo Auth::user()->id; ?>" />
            <input type="hidden" id="pusher_app_key" value="fd2d9d84a885929af982" />
            <input type="hidden" id="pusher_cluster" value="ap2" />
        </div>
        <!--chat box end-->
        <?php
    }

    public static function unseen_message_count(){
        $user = Auth::user(); 
        $login_user_id = Auth::user()->id;

        //Check if current login user is super admin or not
        if(Auth::user()->user_type == 'Super_Admin') {
            $unseen_messages = Message::where('from_user', $login_user_id)->where('from_seen_status', '1')->count();
        } else {
            $unseen_messages = Message::where('to_user', $login_user_id)->where('to_seen_status', '1')->count();
        }
        return $unseen_messages;
    }

    public static function manage_edit_pages_access(){
        //Login user details
        $login_user = Auth::user(); 
        $login_user_type = $login_user->user_type;
        $login_user_edit_access = $login_user->edit_form_access;
        $login_user_status = $login_user->user_status;

        //Sring to array
        $is_login_access_list = explode(',', $login_user_edit_access);

        //Set edit form access here
        $isEditFormAccess = ['status' => false, 'user_type' => $login_user_type, 'edit_access_type' => ['none']]; 
        if($login_user_type == "Super_Admin" && $login_user_status == "Active"){
            $isEditFormAccess = ['status' => true, 'user_type' => $login_user_type, 'edit_access_type' => $is_login_access_list];
        } elseif($login_user_type == "Admin" && $login_user_status == "Active" ){
            $isEditFormAccess = ['status' => true, 'user_type' => $login_user_type, 'edit_access_type' => $is_login_access_list];
        } 
        return $isEditFormAccess;
    }

    public static function is_department_access(){
        $login_user = Auth::user();
        $login_department = $login_user->department;
        return $login_department;
    }
    
    public static function check_website_status(){
        //Website Status
        $website_status = WebsiteStatus::where('id', 1)->first();
        return $website_status;
    }

    public static function submit_history_helper($request,$module_type,$page_name,$fieldsStr,$valuesStr){
        //Login user details
        $login_user = Auth::user(); 

        //Insert History
        $insert =  History::create([ 
                                    'service_id' => $request['circuit_id'],
                                    'user_id' => $login_user->id,
                                    'module_name' => $module_type,
                                    'field' => $fieldsStr  ?? '',
                                    'value' => $valuesStr ?? '',
                                    'page_name' => $page_name,
                                ]);
    }
}
