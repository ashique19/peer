@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - My Orders @stop
@section('main')

    <div class="wrapper payment-confirmation">
        @include('user.pages.product.sidebar')

        <div id="content">
            @include('user.pages.product.header')
            <div class="container-fluid travel setting-payment setting-payout">
                <div class="col-md-12">
                    
                    @if($errors->any())
                        @foreach( $errors->all() as $error )
                        <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <div class="row board">
                        <div class="col-xs-12">
                            <h1 class="title">My Orders</h1>
                        </div>
                        
                        <div class="col-xs-12">
                            <h3 class="alert alert-primary">Buyer Board</h3>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Title</th>
                                        <th>Url</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( count($buys) > 0 )
                                    @foreach( $buys as $buy )
                                    <tr>
                                        <td>{{ $buy->id }}</td>
                                        <td>{{ $buy->title }}</td>
                                        <td><a href="{{ $buy->url }}" target="_blank" >{{ $buy->url }}</a></td>
                                        <td><img src="{{ $buy->image }}" alt="" class="img img-thumbnail"></td>
                                        <td>{{ $buy->price }}</td>
                                        <td>{{ $buy->status }}</td>
                                        <td>{{ $buy->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if( count($buys) > 0 )
                            {!! $buys->render() !!}
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script >
        $(document).ready(function(){
            
            
            
        })
    </script>
    <script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/travel.css') }}">
@endsection
