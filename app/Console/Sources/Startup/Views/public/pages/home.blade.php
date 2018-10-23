@extends('public.layouts.layout')
@section('title')@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif- Biggest online flower and gift shop at Bangladesh. @stop
@section('main')

<section class="orange-gradient-bg min-height-600"></section>

@stop
        