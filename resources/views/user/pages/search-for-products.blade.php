@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="col-sm-6 col-sm-offset-3">
            @if($errors->any())
            
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                <p class="black-text">{{$error}}</p>
                @endforeach
            </div>
            @endif
        </div>
        
        <div class="col-xs-12 push-up-50 no-padding">
            
            <div class="col-sm-3 search-area push-up-50">
                {!! Form::open([ 'url'=> action('Amazons@postProductSearch'), 'method'=>'POST' ]) !!}
                <h4 class="search-heading">Product Search</h4>
                <ul>
                    <li class="search-for-buyer"><input type="text" name="keyword" placeholder="Search anything" class="form-control"></li>
                </ul>
                
                <h4 class="search-heading">Product Categories</h4>
                <ul>
                    @if(count($categories) > 0)
                    @foreach($categories as $category)
                    <li><input type="radio" value="{{$category->search_index}}" name="category"> {{$category->name}}</li>
                    @endforeach
                    @endif
                </ul>
                
                <h4 class="search-heading">Price</h4>
                <ul>
                    <li><input type="radio" name="price" value="1"> $0-$100</li>
                    <li><input type="radio" name="price" value="2"> $101-$200</li>
                    <li><input type="radio" name="price" value="3"> $201-$300</li>
                    <li><input type="radio" name="price" value="4"> $301-$400</li>
                    <li><input type="radio" name="price" value="5"> $401-above</li>
                </ul>
                
                <h4 class="search-heading text-center"><button type="submit" class="btn orange-bg white-text">Search</button></h4>
                
                {!! Form::close() !!}
            </div>
            <div class="col-sm-9 search-result-area">
                <h1 class="section-heading black-text">Product Search</h1>
                
                @for($i=0; $i<count($products['products']); $i++)
                
                <div class="col-sm-4 panel-body text-center push-up-20 push-down-20 search-item" >
                    <div class="img-holder" @if($products['products'][$i]['image']) style="background: url('{{$products['products'][$i]['image']}}')" @else style="background: url('/public/img/settings/no-image-available.png')" @endif >
                        <a href="{{$products['products'][$i]['link']}}" target="_blank">
                        </a>
                    </div>
                    
                    <a href="{{$products['products'][$i]['link']}}" target="_blank">
                        <h4 class=" push-down-10" data-toggle="tooltip" data-placement="top" title="{{$products['products'][$i]['name']}}">{{substr($products['products'][$i]['name'], 0, 50)}}</h4>
                    </a>
                    
                    <div class="col-sm-6 message-request pull-right-5">
                        <p>
                            Price 
                            <b>USD ${{round($products['products'][$i]['price']/100 ,2)}}</b>
                        </p>
                    </div>
                    
                    <div class="col-sm-6 message-request pull-left-5">
                        <a href="{{$products['products'][$i]['link']}}" class="pull-left btn btn-block btn-xs black-bg white-text" target="_blank" >View Link <img src="/public/img/settings/offer-icon.png" alt="View Product"></a>
                    </div>
                    
                </div>
                
                @endfor
                <div class="col-sm-12 panel-body text-center push-up-20 push-down-20 search-item" >
                    <a href="{{$products['searchResult']}}" class="btn btn-block btn-primary btn-rounded" target="_blank">See more results at Amazon</a>
                </div>
                    
            </div>
            
        </div>
        
    </div>
</section>


@stop