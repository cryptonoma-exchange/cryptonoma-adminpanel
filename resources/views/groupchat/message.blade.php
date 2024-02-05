@extends('layouts.header')
@section('title', 'Group Chats')
@section('content')
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Group Chats</h1>
    </header>
    <p class="text-danger pull-right" style="margin-bottom: -31px;padding-top: 10px;padding-right: 30px;color:#ffbf00 !important">Note* Double Click to Delete Messages</p>

    @if ($message = Session::get('status'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('failed'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="alert alert-danger" style="display:none;" id="errormsg" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Failed! </strong>Must fill all the fields!
    </div>
    <div class="alert alert-danger"  style="display:none;" id="msg" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Failed! </strong>Try again!
    </div>
  </div>
  <div id="fail_msg">
  </div>
<div class="messages">
    <div class="messages__body">
      <div class="messages__header">
        <div class="tab-container">
          <ul class="nav nav-tabs" role="tablist">
            @forelse($lang as $langs)
            <li class="nav-item" id="{{$langs->keyword}}">
              <a onclick="funcVal('{{$langs->keyword}}')" id="tab{{$langs->keyword}}" class="nav-link" role="tab">{{$langs->keyword}}</a>
            </li>
            @empty
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">EN</a></li>
            @endforelse
          </ul>
        </div>
      </div>
      <div class="messages__content" id="adminchat_div">
        @forelse ($group_chats as $row)
        @if($row->uid!="Admin")
        <div class="messages__item">
          <div class="messages__details">               
            <img  src="{{ url('images/client-2.png') }}">
            <h6>{{ $row->username }} &nbsp;<a onclick='funcDel("{{$row->id}}")' title="Delete this message!" style="color: red"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </h6> 
            <p>{{ $row->message }}</p>                
            <small><i class="zmdi zmdi-time"></i>{{ $row->created_at }}</small>
          </div>
        </div>
        @else
        <div class="messages__item messages__item--right">
          <div class="messages__details">
            <img src="{{ url('images/adminchat.jpg') }}">
            <h6><a onclick="funcDel('{{$row->id}}')" title="Delete this message!" style="color: red"><i class="fa fa-trash" aria-hidden="true"></i></a>
             &nbsp;{{ $row->username }}</h6><p>{{ $row->message }}</p>
             <small><i class="zmdi zmdi-time"></i> {{ $row->created_at }}</small>
           </div>
         </div>
         @endif
         @empty
         No record Found
         @endforelse  
       </div>
       <input type="hidden" id="lang" value="EN">
       <div class="messages__reply">
        <div class="row">
          <div class="col-lg-11 col-md-10 col-xs-12">
            <textarea class="messages__reply__text message1" name="message" id="btn-input" placeholder="Type a message..." required></textarea>
          </div>
          <div class="col-lg-1 col-md-2 col-xs-12">
            <div class="adminchat-boxt">
              <input type="button" onclick="funcClick()" class="btn btn-warning btn-sm" id="btn-chat" value="Send"> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection
<script src="{{ url('adminpanel/js/jquery.min.js') }}"></script>
<script type="text/javascript">

var ws = new WebSocket("ws://demozab.com:9090/");  
//var ws = new WebSocket("ws://localhost:9091");  
  ws.onopen = function(event) {
    var lang = $('#lang').val();
    var messageJSON = {
      'type': 'grpchat',
      'lang': lang
    };
    ws.send(JSON.stringify(messageJSON));
  }
  ws.onmessage = function(event) {
    var data = JSON.parse(event.data);
    var msgcontent='';
    if(data.msg){
      $.each(data.msg, function(index, value){
        var lang = $('#lang').val();

        if(lang == value.lang){
          if(value.uid != 'Admin'){
            msgcontent +='<div class="messages__item"><div class="messages__details"><img  src="{{ url("images/client-2.png") }}"><h6>'+value.username+'&nbsp;&nbsp;<a style="color:red;" onclick="funcDel('+value.id+')" title="Double Click to Delete this message!"><i class="fa fa-trash" aria-hidden="true"></i></a></h6>&nbsp;<p>'+value.message+'</p><small><i class="zmdi zmdi-time"></i>'+ value.created_at+'</small></div></div>';
          }else{
            msgcontent +='<div class="messages__item messages__item--right"><div class="messages__details"><img src="{{ url("images/adminchat.jpg") }}"><h6><a style="color:red;" onclick="funcDel('+value.id+')" title="Double Click to Delete this message!"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;</a>'+value.username+'</h6><p>'+value.message+'</p><small><i class="zmdi zmdi-time"></i>'+ value.created_at+'</small></div></div>';
          }
        }
      });
    }else{
      msgcontent +='<li id="norecord" class="clearfix"><div class="chat-body clearfix"><div class="header"><strong class="chat-user"> No record Found</strong></div></div></li>';  
    }
    $('#adminchat_div').html(msgcontent);
  }

  function funcClick() {
    $('#btn-chat').hide();
    var message = $('#btn-input').val();
    var lang = $('#lang').val();
//alert(message);
if(message == "")
{
  $('#errormsg').show();
  $('#btn-chat').show();
  return false;
}
$.ajax({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  type: "POST",
  url: '{{ url("admin/sendGrpMsg") }}', 
  data: 'message='+message+'::'+lang
}).done(function( request ) {
  $('#btn-chat').show();
  $('#errormsg').hide();
  if(request.status=='success')
  {
    $('#norecord').hide();
    $('#btn-input').val('');
    
$("#adminchat_div").animate({scrollTop: $('#adminchat_div').prop("scrollHeight")}, 1000); // Scroll the chat output div
}else{
  $('#btn-input').val('');
  $('#errormsg').show();
  $('#errormsg').html(request.msg);
}
});
}

function funcDel(val) {
 $.ajax({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  type: "POST",
  url: '{{ url("admin/delgrpchat") }}', 
  data: 'id='+val
}).done(function( request ) {
  if(request.status=='success')
  {
    location.reload();
$("#adminchat_div").animate({scrollTop: $('#adminchat_div').prop("scrollHeight")}, 1000); // Scroll the chat output div
}
});
}

function funcVal(val) {
  $('#lang').val(val);
  $(".nav-link").removeClass("active");
  $("#tab"+val).addClass('active');
$("#adminchat_div").animate({scrollTop: $('#adminchat_div').prop("scrollHeight")}, 1000); // Scroll the chat output div
}
$(document).ready(function() {
  var lang = $('#lang').val();
  $("#tab"+lang).addClass('active');
$("#adminchat_div").animate({scrollTop: $('#adminchat_div').prop("scrollHeight")}, 1000); // Scroll the chat output div
});
</script>