<div class="payment-botton-holder">
<button type="button" class="btn btn-xs white-bg green-border green-text" role="button" >
  Pay Now
</button>
    <span class="buttons">
        <a href="{{action("Payments@payNowPaypal", $payment->id)}}" class="btn btn-xs white-bg green-border green-text paypal">Pay via Paypal</a> 
        
        <form action="{{action("Stripes@index", $payment->id)}}" method="POST" class="stripe" >
            <input name="_token" type="hidden" value="{{csrf_token()}}" />
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{!! env("STRIPE_PUBLISH_KEY") !!}"
                data-amount="{{ $payment->payment * 100 }}"
                data-name="Airposted LLC"
                data-description="Widget"
                data-image="/public/img/settings/favicon.png"
                data-locale="auto">
            </script>
            <span class="loading btn white-bg blue-border blue-text blue-text">
                <i class="fa fa-cog fa-spin"></i>
                Loading card pay
            </span>
        </form>
    </span>
</div>
