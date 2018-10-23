@if(session('user_type') == 'buyer')

@include('user.partials.buyer-nav')

<div class="col-sm-10 col-sm-offset-1 col-xs-12">

@include('public.partials.notice')

</div>

@elseif(session('user_type') == 'traveller')

@include('user.partials.traveler-nav')

@elseif(session('user_type') == 'order')

@include('user.partials.nav-order')

@else



@endif

@if($errors->has('user_type'))
<section class="row">
    <div class="alert alert-success">
        <p class="black-text text-center">{{$errors->first()}}</p>
    </div>
</section>
@endif