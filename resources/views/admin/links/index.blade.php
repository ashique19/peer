@extends('admin.layout')

@section('main')
    <br><br><br>
<h3>Add all fields for incomplete products link</h3>


@if($errors)

    {{$errors->first()}}

@endif


<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>URL</th>
            <th>Added by</th>
            <th>created at</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @if($productLink)
            @foreach($productLink as $link)
                <tr>
                    <td>{{$link['id']}}</td>
                    <td>{{$link['url']}}</td>
                    <td>{{$link['owner_name']}}</td>
                    <td>{{$link['created_at']}}</td>
                    <td>
                        <a href="{{action('LinksController@edit', $link['id'])}}" class="btn btn-default btn-sm btn-rounded" title="Edit link"><span class="fa fa-pencil"></span></a>
                    </td>
                    {{--<td>--}}
                        {{--{!! Form::open(['method'=>'delete', 'url'=> "admin/links/".$link['id'] ]) !!}--}}
                        {{--{!! Form::hidden('id', $link['id'] ) !!}--}}
                        {{--<button href="{{action('LinksController@edit',[$link['id']])}}" class="btn btn-danger btn-sm btn-rounded" title="Delete link">--}}
                            {{--<span class="fa fa-times"></span>--}}
                        {{--</button>--}}
                        {{--{!! Form::close() !!}--}}
                    {{--</td>--}}
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

@stop
