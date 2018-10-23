@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Payout @stop
@section('main')

    <div class="wrapper payment-confirmation">
        @include('user.pages.product.sidebar')

        <div id="content">
            @include('user.pages.product.header')
            <div class="container-fluid travel setting-payment setting-payout">
                <div class="col-md-12">
                <!--<form name="withdrawMoney" action="{{route('post-withdraw-money')}}" method="post">-->
                {!! Form::open([ 'url'=> route('post-withdraw-money') ]) !!}
                    
                    @if($errors->any())
                        @foreach( $errors->all() as $error )
                        <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <div class="row board">
                        <div class="col-md-6">
                            <div class="row top">
                                <div class="content">
                                    <div class="col-md-6">
                                        <span>Purchased Amount</span>
                                    </div>
                                    <div class="col-md-6 payout-input">
                                        <span>BDT</span> <input name="amount" class="form-control" type="text" value="{{$pending_price}}" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="row top">
                                <div class="content">
                                    <div class="col-md-6">
                                        <span>Withdraw Method</span>
                                    </div>
                                    <div class="col-md-6 payout-input">
                                        <select class="form-control" name="type" required >
                                            <option>select</option>
                                            <option value="bank">Bank</option>
                                        </select>
                                        <div id="payout-form">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="row board second">-->
                    <!--    <div class="col-md-6">-->
                    <!--        <div class="row">-->
                    <!--            <div class="content">-->
                    <!--                <div class="col-md-4">-->
                    <!--                    <span>Enter Booth Code</span>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-8 payout-input">-->
                    <!--                    <input class="form-control" type="text" name="payout-input" placeholder="DD5674">-->
                    <!--                    <div>-->
                    <!--                        <img src="{{asset('public/img/peerposted/images/demo.jpg')}}" class="img-responsive" style="width: 15%; float: left; margin-right: 15px; border-radius: 10px; ">-->
                    <!--                        <h4 style="display: inline-block; width: 60%; ">Dresden Airport, Germany DRS.</h4>-->

                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--    </div>-->
                    <!--    <div class="col-md-6">-->
                    <!--        <div class="row">-->
                    <!--            <div class="content">-->
                    <!--                <div class="col-md-1">-->
                    <!--                    <span>Or</span>-->
                    <!--                </div>-->
                    <!--                <div class="col-md-6 payout-input">-->
                    <!--                    <a href="#" class="btn btn-common btn-round">Scan QR Code</a>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--    </div>-->
                    <!--</div>-->

                    <div class="row layer-1">
                        <!--<a href="#" class="pull-left">Cancel</a>-->
                        {{--<a href="#" class="pull-right btn btn-common btn-round"  data-toggle="modal" data-target="#withdrawModal">Withdraw</a>--}}
                        {{--<a href="#" class="pull-right btn btn-common btn-round" >Withdraw</a>--}}
                        <button type="submit" name="submit" class="pull-right btn btn-common btn-round">Withdraw Money</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payout Confirmation</h5>
                </div>
                <div class="modal-body">
                    <div class="row layer-4">
                        <div class="col-md-12">
                            <table class="table table-responsive table-borderless" >
                                <tr>
                                    <td>Payout Amount</td>
                                    <td>$100</td>
                                    <td rowspan="3" colspan="3" class="payout-image"><img src="images/demo.jpg" class="img-responsive"></td>
                                </tr>
                                <tr>
                                    <td>Withdraw Method</td>
                                    <td>PP-Booth</td>
                                </tr>
                                <tr>
                                    <td>Booth Id</td>
                                    <td>DD5674 (Dresden Airport, Germany - DRS )</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-common btn-round btn-same" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-common btn-round btn-same">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script >
        $(document).ready(function(){
            $('select[name=type').change(function(){
                $('#payout-form').empty();
                if( $(this).val() == 'bank' ){
                    $('#payout-form').html(`
                    <div class="form-group">
                        <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" required />
                        <input type="text" class="form-control" name="bank_branch" placeholder="Bank Branch" required />
                        <input type="text" class="form-control" name="swift_code" placeholder="Swift Code" required />
                        <input type="text" class="form-control" name="account_name" placeholder="Account Name" required />
                        <input type="text" class="form-control" name="account_number" placeholder="Account Number" required />
                    </div>
                    `);
                }
            })
        })
    </script>
    <script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/travel.css') }}">
@endsection
