@if(count($messageList) > 0)
<div class="btn-group pull-right list-inline push-up-20 push-right-20">
  <li>
    <a class="btn blue-bg white-text" role="button" data-toggle="modal" data-target="#reply_modal" ><i class="fa fa-mail-reply white-text"></i> Reply</a>

    <div class="modal fade green-modal" id="reply_modal" tabindex="-1" role="dialog" aria-labelledby="reply_modal">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="row">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <h4>Reply:</h4>
          {!! Form::open(['url'=> action('Messages@replyMessageItem', $messageList->first()->id)]) !!}
          
          {!! Form::hidden('message_id', $messageList->first()->id) !!}
          <textarea name="details" cols="30" rows="10" class="form-control"></textarea>
          
          <button class="btn blue-bg">Submit</button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>

  </li>
  
  <li>
  {!! Form::open(['url'=> action('Messages@destroy', $messageList->first()->id), 'method'=> 'DELETE' ]) !!}
  {!! Form::hidden('id', $messageList->first()->id) !!}
  <button class="btn green-bg white-text"><i class="fa fa-trash white-text"></i> Delete</button>
  {!! Form::close() !!}
  </li>
</div>
@foreach($messageList as $message)
<div class="message row nicescroll push-up-20">
    <h4>From: {{$message->from->name}}</h4>
    <h4>To: {{$message->to->name}}</h4>
    <h4>Subject: {{$message->name}}</h4>
    <h4>Date: {{$message->created_at}}</h4>
    <h4 class="push-up-30">Details: </h4>
    <div class="row">
      {!! $message->details !!}
    </div>
</div>

@if($messageList->first()->id == $message->id)

@else
<p class="push-up-20"></p>
@endif

@endforeach

@endif