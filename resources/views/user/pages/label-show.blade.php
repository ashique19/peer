@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav-label')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        {!! errors($errors) !!}
        
        <div class="col-xs-12 no-padding">
            
            <div class="col-xs-12">
                <section class="row push-up-20 pull-left-20 scrollable">
                    <h1 class="section-heading black-text">Labels</h1>
                    <a href="{{action('Shippings@getLabel')}}" class="btn btn-lg blue-bg white-text pull-right btn-rounded">Buy Label</a>
                    <table class="table table-responsive table-theme-1 table-condensed">
                        <thead>
                            <tr>
                                <th>Receiver</th>
                                <th>Destination</th>
                                <th>Carrier</th>
                                <th>Total</th>
                                <th>Shipment Id</th>
                                <th>Parcel Tracking No.</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if(count($labels) > 0)
                            @foreach($labels as $label)
                            <tr>
                                <td>{{$label->receiver_name}} @if(strlen($label->receiver_company) > 0)({{$label->receiver_company}}) @endif</td>
                                <td>{{$label->receiver_addressLines}}, {{$label->receiver_cityTown}}, {{$label->receiver_stateProvince}} {{$label->receiver_postalCode}}, {{$label->receiver_countryCode}}</td>
                                <td>{{$label->rates_carrier}}</td>
                                <td>{{$label->payment->payment}}</td>
                                <td>{{$label->shipmentId}}</td>
                                <td>{{$label->parcelTrackingNumber}}</td>
                                <td>
                                    @if( strlen($label->shipmentId) > 0 )
                                    <a href="{{ $label->documents_contents }}" target="_blank"  class="btn blue-bg white-text btn-sm btn-rounded">View / Print</a>
                                    @else
                                        <a href="{{ action('Labels@editByUser', $label->id) }}" target="_blank"  class="btn green-bg white-text btn-xs btn-block">Preview & Pay now</a>
                                        <a href="{{ action('Labels@deleteByUser', $label->payment_id) }}" target="_blank"  class="btn btn-danger white-text btn-xs btn-block"><i class="fa fa-trash-o white-text"></i> Delete</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                    {!! $labels->render() !!}
                </section>
            </div>
            
        </div>
        
        
        
    </div>
</section>


@stop