
@extends('admin.layout')

@section('title') Backup @stop

@section('main')

<h1><center>System Backup</center></h1>

<section class="col-md-10 col-md-offset-1 push-down-20">
    <h2>Make Backups</h2>
    {!! errors($errors) !!}
    <ul class="list-group">
        <li class="list-group-item"><a href="{{action('Backup@database')}}" class="btn btn-primary">Database and Images</a></li>
    </ul>
</section>

@stop
        