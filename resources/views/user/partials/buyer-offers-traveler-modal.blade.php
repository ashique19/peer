
<div class="modal fade modal-theme-1" id="traveller{{$traveller->id}}" tabindex="-1" role="dialog" aria-labelledby="offer">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            
            <aside class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </aside>
            
            <article class="modal-body no-padding">
                
                {!! Form::open(['url'=> action('Offers@postOfferFromBuyer'), 'method'=> 'POST', 'class'=> 'offer-from-traveller-page']) !!}
                {!! Form::hidden('traveller', $traveller->user->id) !!}
                
                <section class="row text-center">
                    <h2>Send Request</h2>
                    <h5>Choose the items you'd like to send this request for</h5>
                </section>
                
                <section class="row">
                    
                    <div class="col-xs-12 no-padding">

                        <table class="table table-responsive table-theme-1">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Carrying fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( auth()->user()->buyPosts()->count() > 0 )
                                @foreach( auth()->user()->buyPosts as $buy )
                                
                                <tr>
                                    <td @if( traveler_fee( $buy, $traveller->user ) == 0 ) data-toggle="popover" data-placement="right" data-trigger="hover" title="Possible reasons:" data-html="true" data-content="@if(!$traveller->user->country)<p>Traveler did not complete his/her profile.</p> @endif <p>Check if your country, product's dimension and weight is defined.</p>"  @endif  >
                                        <input 
                                            type="checkbox"  
                                            @if( traveler_fee( $buy, $traveller->user ) == 0 ) disabled  @endif 
                                            class="favorite_product" 
                                            p_name="{{$buy->name}}" 
                                            p_image="{{$buy->image_url}}" 
                                            p_price="{{$buy->price}}" 
                                            p_buypost_id="{{$buy->id}}" 
                                            c_price ="{{ traveler_fee( $buy, $traveller->user ) }}"
                                            @if(strlen(trim( $buy->amazon_url )) > 0) p_link="{{$buy->amazon_url}}" @else p_link="{{$buy->other_url}}" @endif />
                                    </td>
                                    <td>
                                        <a @if(strlen(trim( $buy->amazon_url )) > 0) href="{{$buy->amazon_url}}" @else href="{{$buy->other_url}}" @endif>{{$buy->name}}</a>
                                    </td>
                                    <td>${{$buy->price}}</td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon white-bg white-border no-padding" id="buy-{{$buy->id}}">${{ traveler_fee( $buy, $traveller->user ) }}</span>
                                            <input name="c_price" min="{{ traveler_fee( $buy, $traveller->user ) }}" type="text" class="hidden" placeholder="Carrying fee" aria-describedby="buy-{{$buy->id}}" value="{{ traveler_fee( $buy, $traveller->user ) }}" />
                                        </div>
                                    </td>
                                </tr>
                                
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        
                        @if( auth()->user()->buyPosts()->count() > 0 )
                        
                        <i class="col-xs-12 small text-center push-up-30">
                            Note: After you send request to your traveler, please wait for him/her to accept your request. 
                            Once he/she accepts your request, please make payment. Message him/her to start a conversation now.
                            <br />
                            Tax/Duty/Sales tax is not included in the carrying fee. If your traveler shows the customs 
                            tax/duty receipt when delivering, please reimburse him. Unsure about the tax rates? 
                            Shoot us an email.
                        </i>
                        
                        <div class="col-xs-12 text-center">
                            <p class="small message"></p>
                            <button type="submit" class="btn btn-sm white-text blue-bg">Send</button>
                        </div>
                        
                        @else
                        
                        <div class="col-xs-12 text-center">
                            <h4 class="message push-down-20"><i>No Posts yet</i></h4>
                            <a href="{{route('userDashboard')}}" class="btn white-text blue-bg">Create Post</a>
                        </div>
                        
                        @endif
                        
                    </div>

                </section>
                
                {!! Form::close() !!}
                
            </article>
            
        </div>
    </div>
</div>
