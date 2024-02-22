@extends('support-dashboard.layouts.master')
@section('content')
<div class="figure-das chat-main-container">
  <div class="container-fluid">
    <div class="tick-hed">
      
    </div>
    <div class="row row-sm">
      <div class="col-md-8 chat-main-container-2">
        <div class="chat-body card"> 
             <!--Call Help chat helper-->
            {{ Helper::help_chat_user_list() }}
      </div>
    </div>
  </div>
</div>
@endsection

