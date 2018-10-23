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
                {!! Form::open([ 'url'=> route('post-withdraw-money'), 'id' => 'withdraw-form' ]) !!}
                    
                    @if($errors->any())
                        @foreach( $errors->all() as $error )
                        <div class="alert alert-danger black-text">{{$error}}</div>
                        @endforeach
                    @endif
                    <div class="row board">
                        <div class="col-xs-12">
                            <h1 class="title">Withdraw Money</h1>
                            <p class="small text-right">Current Balance: BDT {{ $pending_price }}</p>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-12 col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon white-text" id="basic-addon3">Select Amount</span>
                                    <input type="text" name="amount" value="{{ $pending_price }}" class="form-control" aria-describedby="basic-addon3">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <div class="input-group col-xs-12">
                                    <span class="input-group-addon white-text" id="basic-addon3">Select Method</span>
                                    <select class="form-control" name="type" required >
                                        <option>- select -</option>
                                        <option value="bank">Bank Transfer</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 padding-0">
                                    <div id="payout-form">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 push-up-20">
                            <p id="msg" class="red-text text-right"></p>
                            <button type="submit" class="pull-right btn btn-common btn-round" >Withdraw Money</button>
                        </div>
                        
                        <div class="col-xs-12 push-up-50">
                            <h2>Old Orders:</h2>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th class="blue-bg white-text">Amount</th>
                                        <th class="blue-bg white-text">Type</th>
                                        <th class="blue-bg white-text">Bank name</th>
                                        <th class="blue-bg white-text">Branch name</th>
                                        <th class="blue-bg white-text">Swift code</th>
                                        <th class="blue-bg white-text">Account name</th>
                                        <th class="blue-bg white-text">Account number</th>
                                        <th class="blue-bg white-text">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(\App\Models\Payout::where('user_id', auth()->user()->id)->count() > 0)
                                        @foreach(\App\Models\Payout::where('user_id', auth()->user()->id)->latest()->take(20)->get() as $payout)
                                            <tr>
                        						<td>{{$payout->amount }}</td>
                        						<td>{{$payout->type }}</td>
                        						<td>{{$payout->bank_name }}</td>
                        						<td>{{$payout->branch_name }}</td>
                        						<td>{{$payout->swift_code }}</td>
                        						<td>{{$payout->account_name }}</td>
                        						<td>{{$payout->account_number }}</td>
                        						<td>{{$payout->payout_status }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
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
                    <div class="form-group push-up-10">
                        <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="bank_branch" placeholder="Bank Branch" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="swift_code" placeholder="Swift Code" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="account_name" placeholder="Account Name" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="account_number" placeholder="Account Number" required />
                    </div>
                    `);
                }
            })
            
            $('#withdraw-form').submit(function(e){

                var amount = $('[name="amount"]').val() * 1,
                    form = $(this),
                    msg = $('#msg');
                    
                if( amount < 1 ){
                    
                    e.preventDefault();

                    msg.text('*** Please select amount above 0');
                    
                } else{
                    
                    msg.empty();
                    
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
