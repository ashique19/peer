@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
        
            <div class="col-sm-10 col-xs-12">
            
                <h1 class="section-heading blue-text">PAY WITH DEBIT/CREDIT CARD</h1>
                
                {!! errors($errors) !!}
                
                <div class="col-xs-12 text-center stripe-button-holder">
                    
                    @if($payment)
                    
                    <a href="#" class="btn btn-lg blue-bg white-text btn-rounded">Proceed to Secured Payment</a>
                    
                    <form action="{{action("Stripes@index", $payment->id)}}" method="POST">
                        <input name="_token" type="hidden" value="{{csrf_token()}}" />
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{!! env("STRIPE_PUBLISH_KEY") !!}"
                            data-amount="{{ $payment->payment * 100 }}"
                            data-name="Airposted LLC"
                            data-description="Widget"
                            data-image="/public/img/settings/logo.png"
                            data-locale="auto">
                        </script>
                    </form>
                    
                    @else
                    
                    <p class="alert alert-warning">Payment data was not found. Please contact admin.</p>
                    
                    @endif
                    
                </div>
                
            </div>
        </div>
        
        
    </div>
</section>


@stop