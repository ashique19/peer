
@extends('admin.layout')

@section('title') Create new Blog @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Blogs</center></h1>


@if($errors->any())
<section class="row panel-body">
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

    <div class="col-xs-12">
        <h2 class="push-down-30">Create New Blog</h2>
    </div>

    <div class="col-xs-12 push-up-30">
    {!! Form::open( ['url'=> action('Blogs@store'), 'enctype'=>'multipart/form-data' ]) !!}

        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#Basic" data-toggle="tab" aria-expanded="true">Basic</a></li>
            <li class=""><a href="#Categories" data-toggle="tab" aria-expanded="false">Categories</a></li>
            <li class=""><a href="#Tags" data-toggle="tab" aria-expanded="false">Tags</a></li>
            <li class=""><a href="#Related" data-toggle="tab" aria-expanded="false">Related Blogs</a></li>
        </ul>
        
        <div class="panel-body tab-content">
            
            <div class="tab-pane active" id="Basic">
                <div class="form-group">
                    {!! Form::label('name', 'Name: ') !!}
                    {!! Form::text('name', old('name') , ['class'=>'form-control new-blog-name']) !!}
                </div>
                    
                <div class="form-group">
                    {!! Form::label('banner_photos', 'Banner image: ') !!}
                    {!! Form::file('banner_photos', ['class'=>'form-control file']) !!}
                </div>
                    
                <div class="form-group">
                    {!! Form::label('details', 'Details: ') !!}
                    {!! Form::textarea('details', old('details') , ['class'=>'form-control summernote']) !!}
                </div>
                    
                <div class="form-group">
                    {!! Form::label('status', 'Status: ') !!}
                    {!! Form::select('status', [0=> 'Draft', 1=>'Waiting for Approval', 2=>'Published', 3=>'Trash'], old('status') , ['class'=>'form-control']) !!}
                </div>
                    
                <div class="form-group">
                    {!! Form::label('is_popular', 'Is popular: ') !!}
                    {!! Form::select('is_popular', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_popular') , ['class'=>'form-control']) !!}
                </div>
            </div>
            
            <div class="tab-pane" id="Categories">
                {!! Form::label('categories[]', 'Select Categories: ') !!}
                {!! Form::select('categories[]', \App\Blogcategory::lists('name', 'id'), old('categories') , ['class'=>'form-control select2', 'multiple'=>'multiple']) !!}
            </div> 
            
            <div class="tab-pane" id="Tags">
                {!! Form::label('tags[]', 'Select Tags: ') !!}
                {!! Form::select('tags[]', \App\Blogtag::lists('name', 'id'), old('tags') , ['class'=>'form-control select2', 'multiple'=>'multiple']) !!}
            </div>                        
            
            <div class="tab-pane" id="Related">
                
                <div class="form-group">
                    {!! Form::label('relateds[]', 'Select Related Blogs: ') !!}
                    {!! Form::select('relateds[]', [], old('relateds') , ['class'=>'form-control blog-search', 'multiple'=>'multiple', 'placeholder'=> 'Search and Select blogs']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('relateds[]', 'Suggested Blogs: ') !!}
                    <div class="related-blog-suggestion">
                        
                    </div>
                </div>
                
            </div>  
            
        </div>
        
            
                
        <div class="form-group">
            {!! Form::submit('Save Blog', ['class'=>'form-control btn btn-info']) !!}
        </div>

    {!! Form::close() !!}
    </div>


</section>

@stop
        