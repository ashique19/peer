
<div class="modal fade modal-theme-1" id="message{{$traveller->id}}" tabindex="-1" role="dialog" aria-labelledby="message">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            
            <aside class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </aside>
            
            <article class="modal-body no-padding">
                
                {!! Form::open([ 'url'=> action('UserChats@store', $traveller->user_id), 'class'=> 'send-message', 'enctype'=> "multipart/form-data" ]) !!}
                <section class="row send-message-heading">
                    <h2>Messenger</h2>
                    <h5>To [{{$traveller->user->name}}]</h5>
                </section>
                
                <section class="login-area row send-message-details">
                    
                    <div class="col-xs-12 no-padding">
                        {!! Form::textarea('name', null, ['class'=> 'form-control', 'placeholder'=> 'type message here…', 'required'=> 'required']) !!}
                        
                        <p class="small message"></p>
                        
                    </div>
                    <div class="col-sm-6 no-padding push-up-20">
                        <a class="push-up-20 darkGray-text" href="{{action('UserChats@indexAndOffers')}}" >View my Inbox</a>
                    </div>
                    
                    <div class="col-sm-6 no-padding text-right push-up-20">
                        <button type="submit" class="btn btn-sm white-text blue-bg">Send</button>
                    </div>
                    
                </section>
                
                <section class="row message-success hidden">
                    <figure class="text-right">
                        <img src="/public/img/settings/message-success.png" alt="Hurrahhh!">
                    </figure>
                    <figcaption>Message Sent!</figcaption>
                    <figdetails>Head to your inbox to see all your messages.</figdetails>
                    <p class="text-center"><a href="{{action('UserChats@indexAndOffers')}}">View my inbox</a></p>
                </section>
                
                {!! Form::close() !!}
                
            </article>
            
        </div>
    </div>
</div>
