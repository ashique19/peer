
@extends('admin.layout')

@section('title') Edit Blogs @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Blog</center></h1>


@if($errors->any())
<section class="col-sm-6 col-sm-offset-3">
    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
</section>  
@endif


<section class="col-sm-10 col-sm-offset-1 push-up-30">

{!! Form::open( ['method'=>'patch', 'url'=> action('Blogs@update', $blog->id), 'enctype'=>'multipart/form-data' ]) !!}
    
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="#Basic" data-toggle="tab" aria-expanded="true">Basic</a></li>
        <li class=""><a href="#Banner" data-toggle="tab" aria-expanded="false">Banner</a></li>
        <li class=""><a href="#Details" data-toggle="tab" aria-expanded="false">Details</a></li>
        <li class=""><a href="#Categories" data-toggle="tab" aria-expanded="false">Categories</a></li>
        <li class=""><a href="#Tags" data-toggle="tab" aria-expanded="false">Tags</a></li>
        <li class=""><a href="#Related" data-toggle="tab" aria-expanded="false">Related Blogs</a></li>
    </ul>
    
    <div class="panel-body tab-content">
            
        <div class="tab-pane active" id="Basic">
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $blog->name , ['class'=>'form-control new-blog-name']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('status', 'Status: ') !!}
                {!! Form::select('status', [0=>'Draft', 1=>'Waiting for Approval', 2=>'Published', 3=>'Trash'], $blog->status , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('is_popular', 'Is popular: ') !!}
                {!! Form::select('is_popular', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], $blog->is_popular , ['class'=>'form-control']) !!}
            </div>
        </div>
        
        <div class="tab-pane" id="Banner">
            {!! md($blog->banner_photo) !!}
            <div class="form-group">
                <label for="banner_photos">Banner image: <span class="badge badge-primary"><input type="checkbox" value="1" name="banner_photo_delete" /> remove</span></label>
                {!! Form::file('banner_photos' , ['class'=>'form-control file']) !!}
            </div>
        </div> 
        
        <div class="tab-pane" id="Details">
            <div class="form-group">
                {!! Form::label('details', 'Details: ') !!}
                {!! Form::textarea('details', $blog->details , ['class'=>'form-control summernote']) !!}
            </div>
        </div> 
        
        <div class="tab-pane" id="Categories">
            <div class="form-group">
                {!! Form::label('categories[]', 'Modify Categories: ') !!}
                {!! Form::select('categories[]', \App\Blogcategory::lists('name', 'id'), $blog->categories()->lists('blogcategories.id')->toArray() , ['class'=>'form-control select2', 'multiple'=>'multiple']) !!}
            </div>
        </div> 
        
        <div class="tab-pane" id="Tags">
            <div class="form-group">
                {!! Form::label('tags[]', 'Modify Categories: ') !!}
                {!! Form::select('tags[]', \App\Blogtag::lists('name', 'id'), $blog->tags()->lists('blogtags.id')->toArray() , ['class'=>'form-control select2', 'multiple'=>'multiple']) !!}
            </div>
        </div>                        
        
        <div class="tab-pane" id="Related">
            
            <h2>Modify Related Blogs</h2>
            
            <div class="form-group col-xs-12">
                <h4>Current related blogs</h4>
                @if($relatedBlogs)
                @foreach($relatedBlogs as $relatedBlog)
                <div class="col-sm-6 col-md-4 col-xs-12">{{$relatedBlog->name}} 
                    <a href="{{ action('Blogs@removeRelatedBlog', [$blog->id, $relatedBlog->id] ) }}" related_id="{{$relatedBlog->id}}" related_name="{{$relatedBlog->name}}" class="remove-related-blog badge badge-danger pull-right push-down-10">Delete</a> 
                </div>
                @endforeach
                @endif
            </div>
            
            <div class="form-group col-xs-12">
                {!! Form::label('relateds', 'Search and Add blogs: ') !!}
                {!! Form::select('relateds[]', [], null , ['class'=>'form-control blog-search', 'multiple'=>'multiple', 'placeholder'=> 'Search and Select blogs']) !!}
            </div>
            
            <div class="form-group col-xs-12">
                {!! Form::label('relateds[]', 'Suggested Blogs: ') !!}
                <div class="related-blog-suggestion">
                    @if($relatedBlogSuggestions)
                    @foreach($relatedBlogSuggestions as $suggestion)
                    <p class="col-sm-4 col-md-3 col-xs-6"><input type="checkbox" name="relateds[]" value="{{$suggestion->id}}" /> {{$suggestion->text}}</p>
                    @endforeach
                    @endif
                </div>
            </div>
            
        </div>  
        
    </div>

    
            
    <div class="form-group">
        {!! Form::submit('Update Blog', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        