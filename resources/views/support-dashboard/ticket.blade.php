@extends('support-dashboard.layouts.master')
@section('content')
<div class="figure-das">
   <div class="container-fluid">
      <div class="tick-hed">
         <div class="tick-id">Ticket ID: #@if($records){{ $records[0]['ticket_id'] }} @endif</div>
         <div class="tkt-sbj"><span>Subject:</span>@if($records){{ $records[0]['subject'] }}@endif</div>
      </div>
      <div class="row row-sm">
         <div class="col-md-8">
            <div class="chat-body card">
               @foreach($records as $record)
               <div class="tickt-chtlst @if(Auth::user()->id == $record['user_id']) {{'ticket-even'}} @else {{ 'ticket-odd' }} @endif">
                  <div class="p-4 card-header">
                     <div class="sorting_1"> <img  src="{{URL::asset('/public/admin/images/user-02.png')}}" alt="#" class="gridpic"> 
                        @if($record['user_name'])
                          {{$record['user_name']['name']}}
                        @endif
                        
                     </div>
                     <div class="cht-dat text-right">{{ \Carbon\Carbon::parse($record['created_at'])->diffForHumans() }}
                     </div>
                  </div>
                  <div class="msg-body">
                     <div class="cht-dts">{{$record['description']}}</div>
                     <div class="filter-container p-0 row">
                        <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                           @if(count($record['ticket_attachment_relation']) >= 1)
                           <div class="cht-dts"> @foreach($record['ticket_attachment_relation'] as $key) <a href="{{url::asset('public/upload/tickets/'.$key['attachment_image']['attachment_name'])}}" data-toggle="lightbox"><img src="{{ asset('public/upload/tickets/'.$key['attachment_image']['attachment_name']) }}"  class="img-fluid" style="height:40px; width:60px;"></a>@endforeach </div>
                           @endif 
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach 
            </div>
            <!--[Chat Footer]-->
            <?php 
               if($records){
                //check if ticket is closed or not
                if($records[0]['status'] == 0){
                  $get_ticket_id = $records[0]['ticket_id'] ?? ''; 
                  $ticket_id = Crypt::encryptString($get_ticket_id);
                ?>
            <div class="chet-Qwe">
               <form action="{{ route('submit.ticket.reply') }}" method="POST"  enctype="multipart/form-data">
                  @csrf
                  <div class="chat-body-footer ert">
                     <div class="msg-box inr">
                        <label>description</label>
                        <textarea id="description" type="text" class="form-control" name="description" placeholder="Write your message..."> </textarea>
                        <input type="hidden" id="ticket" name="ticket" value="<?php echo  $ticket_id; ?>">
                     </div>
                     <div class="file-up inr">
                        <span class="input-group-btn">
                           <!--<button class="trash-file" type="file" data-action="browse"><img  src="{{URL::asset('/public/admin/images/file-up.png')}}" alt="#"></button>-->
                           <input type="file" id="filenames" name="filenames[]" multiple>
                        </span>
                     </div>
                     <div class="delt butt-Qw">
                        <button class="trash-bt" type="button"><img  src="{{URL::asset('/public/admin/images/trash.png')}}" alt="#"></button>
                        <button class="btn sand-enq btn-primary" type="submit">Send</button>
                     </div>
                  </div>
               </form>
            </div>
            <?php } } ?>
            @if (Session::has('success'))
            <p class="success">{{ Session::get('success') }}</p>
            @endif
            @if (Session::has('unsuccess'))
            <p class="unsuccess">{{ Session::get('unsuccess') }}</p>
            @endif 
         </div>
         <!--[/Chat Footer]-->
         <div class="col-md-4">
            <!--@foreach($users as $user)	
               {{$user['name']}}
               @endforeach--> 
            @if (Session::has('close_success'))
            <p class="success">{{ Session::get('close_success') }}</p>
            @endif
            @if (Session::has('close_unsuccess'))
            <p class="unsuccess">{{ Session::get('close_unsuccess') }}</p>
            @endif
            <?php if($records){
               if($records[0]['status'] == 0){ ?>
            <div class="cls-tkt"><a href="{{ url('sumit-close-ticket', $records[0]['ticket_id'] )}}">Close Ticket</a></div>
            <?php } else { ?>
            <div class="cls-tkt"><a href="#">Ticket Closed</a></div>
            <?php } } ?>
            <!----modal---->
            
         </div>
      </div>
   </div>
</div>
@endsection