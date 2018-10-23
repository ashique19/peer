<div class="col-md-3">
    
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>Categories</h3>
            <div class="links">
                @if( count($categories) > 0 )
                @foreach( $categories as $category )
                <a href="{{route('blogCategory', $category->link)}}">{{$category->name}} <span class="label label-default">{{$category->blogs()->count()}}</span></a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>Tags</h3>
            <ul class="list-tags push-up-10">
                @if( count($tags) > 0 )
                @foreach($tags as $tag)
                <li><a href="{{route('blogTag', $tag->link)}}"><span class="fa fa-tag"></span> {{$tag->name}}</a></li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
    
</div>