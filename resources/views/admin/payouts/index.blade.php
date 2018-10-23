
@extends('admin.layout')

@section('title') Payout Requests @stop

@section('main')

<h1><center>Payout Requests</center></h1>


@if($errors->any())
<section class="col-sm-10 col-sm-offset-1 panel-body">
    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
</section>  
@endif

<section class="col-sm-10 col-sm-offset-1">
    
    <table class="table table-responsive">
        <thead>
            <tr>
                <th class="blue-bg white-text">User</th>
                <th class="blue-bg white-text">Amount</th>
                <th class="blue-bg white-text">Type</th>
                <th class="blue-bg white-text">Bank name</th>
                <th class="blue-bg white-text">Branch name</th>
                <th class="blue-bg white-text">Swift code</th>
                <th class="blue-bg white-text">Aaccount name</th>
                <th class="blue-bg white-text">Account number</th>
            </tr>
        </thead>
        <tbody>
            @if($payouts)
                @foreach($payouts as $payout)
                    <tr>
						<td>{{$payout->user ? $payout->user->name : '' }}</td>
						<td>{{$payout->amount }}</td>
						<td>{{$payout->type }}</td>
						<td>{{$payout->bank_name }}</td>
						<td>{{$payout->branch_name }}</td>
						<td>{{$payout->swift_code }}</td>
						<td>{{$payout->account_name }}</td>
						<td>{{$payout->account_number }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $payouts->render() !!}
</section>


@stop
        