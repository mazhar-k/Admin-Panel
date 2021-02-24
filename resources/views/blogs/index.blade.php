@extends('layouts.app')
@section('content')

<div class="move-back">
    <div class="d-flex flex-column flex-lg-row justify-content-start align-items-center align-items-lg-start">
    <div class="col-12 col-md-10 col-lg-3 d-flex flex-row flex-lg-column  justify-content-around align-items-center" id="filter-menu">
    
    {!! Form::open(['action' => 'BlogsController@searchBar','method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
    <div class="row justify-content-around form-inline my-2 my-lg-0 mr-lg-0">
    {{Form::text('search', '', ['type'=>'search','class' => 'col-8 form-control mr-sm-2 d-inline', 'placeholder' => 'Search'])}}
    {{Form::button('<i class="fas fa-search"></i>', ['type'=>'submit','class'=>'col-2 btn btn-outline-primary my-2 my-sm-0'])}}
    </div>
    {!! Form::close() !!}

     <a href="/blogs/create" class="component-button">
      <i class="fas fa-plus mr-2 d-inline"></i>Create
     </a>

     @if(count($categories)>1)
     <div class="wrapper d-none d-lg-flex flex-column justify-content-around bg-component px-3">
      <span class="component-heading text-center">Categories</span>
      <div class="category-menu d-none d-lg-flex flex-column justify-content-around scrollbar">
      @foreach ($categories as $category)
     <a href="/blogs/{{$category->id}}/searchByCategory" class="component-button text-center">{{$category->category}}</a>
      @endforeach
      </div>
     </div>
     @endif

     @if(count($tags)>1)
     <div class="wrapper d-none d-lg-flex flex-column justify-content-around align-items-start bg-component px-3">
     {!! Form::open(['action' => 'BlogsController@searchByTag','method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
     <div class="d-flex justify-content-between align-items-center">
     {{Form::label('tags', 'Tags',['class'=>'component-heading mr-5'])}}
     {{Form::button('Filter', ['type'=>'submit','class'=>'btn btn-outline-primary'])}}
     </div> 
     <div class="wrapper d-none d-lg-flex flex-column justify-content-around align-items-between tag-menu scrollbar">
        @foreach($tags as $tag)
            <div class="form-group row justify-content-between pr-4">
            {{Form::label('tag', $tag->tag_name,['class'=>'component-text','for'=>'exampleCheck1'])}}
            {{Form::checkbox('selected_tags_filter[]',$tag->id)}}
            </div>
        @endforeach
     </div>

       {!! Form::close() !!}
     </div>
    @endif
    </div>

<div class="col-9 d-flex justify-content-center align-items-center" id="blog-tab-div">
 <!--Blog Tabs-->

<div class="row flex-column flex-lg-row justify-content-start align-items-center" id="blog-tabs">
    @if(count($blogs)>0)
    @if(count($blogs)==1)
    @foreach($blogs as $blog)
    <div class="col-10 col-md-8 col-lg-10 mb-4 mr-2">
        <div class="card component-text bg-component">
        <img src="/storage/cover_images/{{$blog->cover_image}}" class="card-img-top" alt="...">
        <div class="card-body">
        <p class="component-text">{{$blog->Category->category}}</p>
        <a href="/blogs/{{$blog->id}}"><h5 class="blog-title">{{$blog->title}}</h5></a>
        <p class="card-text d-none d-md-block">{{$blog->description}}</p>
        <div class="d-none d-md-block">
        @foreach($blog->tags as $tag)
        <span class="mx-1">#{{$tag->tag_name}}</span>
        @endforeach
        </div>
        <div class="d-flex justify-content-between mt-2">
        <div id="blog-author">
            <i class="fas fa-user-circle "></i> {{$blog->user->name}}
        </div>
        <span>{{$blog->created_at->toFormattedDateString()}}</span>
        </div>
        <div class="d-flex justify-content-between blog-icons mt-2">
        <div class="mr-2">
            <i class="fas fa-eye"></i>{{$blog->views}}
            <i class="fas fa-heart"></i>{{$blog->likes}}
            <div class="d-inline d-lg-none">
            <i class="fas fa-comment-dots"></i>76
            </div>
            <div class="dropdown d-none d-lg-inline">
            <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-comment-dots"></i>76
            </a>
        
            <div class="dropdown-menu bg-component" aria-labelledby="navbarDropdown">
            
            <a class="dropdown-item" href="#">
                <div class="d-flex justify-content-between">
                    <div class="col-3 d-flex flex-column align-items-center">
                          <i class="fas fa-user-circle"></i>Username
                      </div>
                      <div class="col-7 d-flex flex-column justify-content-around">
                          <span>Comment</span>
                          <span class="reply-link">Reply</span>
                      </div>
                      <div class="col-2 d-none d-lg-block">
                          22m
                      </div>
                  </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <div class="d-flex justify-content-around">
                    <div class="col-3 d-flex flex-column align-items-center">
                          <i class="fas fa-user-circle"></i>Username
                      </div>
                      <div class="col-7 d-flex flex-column justify-content-around">
                          <span>Comment</span>
                          <span class="reply-link">Reply</span>
                      </div>
                      <div class="col-2">
                          22m
                      </div>
                  </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <div class="d-flex justify-content-around">
                    <div class="col-3 d-flex flex-column align-items-center">
                          <i class="fas fa-user-circle"></i>Username
                      </div>
                      <div class="col-7 d-flex flex-column justify-content-around">
                          <span>Comment</span>
                          <span class="reply-link">Reply</span>
                      </div>
                      <div class="col-2">
                          22m
                      </div>
                  </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <div class="d-flex d-flex justify-content-around">
                    <div class="col-3 d-flex flex-column align-items-center">
                          <i class="fas fa-user-circle"></i>Username
                      </div>
                      <div class="col-7 d-flex flex-column justify-content-around">
                          <span>Comment</span>
                          <span class="reply-link">Reply</span>
                      </div>
                      <div class="col-2">
                          22m
                      </div>
                  </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <div class="d-flex justify-content-around">
                    <div class="col-3 d-flex flex-column align-items-center">
                          <i class="fas fa-user-circle"></i>Username
                      </div>
                      <div class="col-7 d-flex flex-column justify-content-around">
                          <span>Comment</span>
                          <span class="reply-link">Reply</span>
                      </div>
                      <div class="col-2">
                          22m
                      </div>
                  </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <div class="d-flex justify-content-around">
                    <div class="col-3 d-flex flex-column align-items-center">
                          <i class="fas fa-user-circle"></i>Username
                      </div>
                      <div class="col-7 d-flex flex-column justify-content-around">
                          <span>Comment</span>
                          <span class="reply-link">Reply</span>
                      </div>
                      <div class="col-2">
                          22m
                      </div>
                  </div>
            </a>
            </div>
            </div>
        
        
        </div>
        <div class="mr-2">
        <a href="/blogs/{{$blog->id}}/edit"><i class="fas fa-edit"></i></a>
            <i class="fas fa-trash"></i>
        </div>
        </div>
        </div>
        </div>
        </div>
        @endforeach
    @endif

    @if(count($blogs)>1)
    @foreach ($blogs as $blog)
<div class="col-10 col-md-8 col-lg-5 mb-4 ml-lg-4">
<div class="card component-text bg-component">
<img src="/storage/cover_images/{{$blog->cover_image}}" class="card-img-top" alt="...">
<div class="card-body">
<p class="component-text">{{$blog->Category->category}}</p>
<a href="/blogs/{{$blog->id}}"><h5 class="blog-title">{{$blog->title}}</h5></a>
<p class="card-text d-none d-md-block">{{$blog->description}}</p>
<div class="d-none d-md-block">
@foreach($blog->tags as $tag)
<span class="mx-1">#{{$tag->tag_name}}</span>
@endforeach
</div>
<div class="d-flex justify-content-between mt-2">
<div id="blog-author">
    <i class="fas fa-user-circle "></i> {{$blog->user->name}}
</div>
{{--$newtime = strtotime($blog->created_at),
  $blog->time = date('M d, Y',$newtime)
--}}
<span>{{$blog->created_at->toFormattedDateString()}}</span>
</div>
<div class="d-flex justify-content-between blog-icons mt-2">
<div class="mr-2">
    <i class="fas fa-eye"></i>{{$blog->views}}
    <i class="fas fa-heart"></i>{{$blog->likes}}
    <div class="d-inline d-lg-none">
    <i class="fas fa-comment-dots"></i>76
    </div>
    <div class="dropdown d-none d-lg-inline">
    <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-comment-dots"></i>76
    </a>

    <div class="dropdown-menu bg-component" aria-labelledby="navbarDropdown">
    
    <a class="dropdown-item" href="#">
        <div class="d-flex justify-content-around">
            <div class="col-3 d-flex flex-column align-items-center">
                  <i class="fas fa-user-circle"></i>Username
              </div>
              <div class="col-7 d-flex flex-column justify-content-around">
                  <span>Comment</span>
                  <span class="reply-link">Reply</span>
              </div>
              <div class="col-2 d-none d-lg-block">
                  22m
              </div>
          </div>
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">
        <div class="d-flex justify-content-around">
            <div class="col-3 d-flex flex-column align-items-center">
                  <i class="fas fa-user-circle"></i>Username
              </div>
              <div class="col-7 d-flex flex-column justify-content-around">
                  <span>Comment</span>
                  <span class="reply-link">Reply</span>
              </div>
              <div class="col-2">
                  22m
              </div>
          </div>
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">
        <div class="d-flex justify-content-around">
            <div class="col-3 d-flex flex-column align-items-center">
                  <i class="fas fa-user-circle"></i>Username
              </div>
              <div class="col-7 d-flex flex-column justify-content-around">
                  <span>Comment</span>
                  <span class="reply-link">Reply</span>
              </div>
              <div class="col-2">
                  22m
              </div>
          </div>
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">
        <div class="d-flex d-flex justify-content-around">
            <div class="col-3 d-flex flex-column align-items-center">
                  <i class="fas fa-user-circle"></i>Username
              </div>
              <div class="col-7 d-flex flex-column justify-content-around">
                  <span>Comment</span>
                  <span class="reply-link">Reply</span>
              </div>
              <div class="col-2">
                  22m
              </div>
          </div>
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">
        <div class="d-flex justify-content-around">
            <div class="col-3 d-flex flex-column align-items-center">
                  <i class="fas fa-user-circle"></i>Username
              </div>
              <div class="col-7 d-flex flex-column justify-content-around">
                  <span>Comment</span>
                  <span class="reply-link">Reply</span>
              </div>
              <div class="col-2">
                  22m
              </div>
          </div>
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">
        <div class="d-flex justify-content-around">
            <div class="col-3 d-flex flex-column align-items-center">
                  <i class="fas fa-user-circle"></i>Username
              </div>
              <div class="col-7 d-flex flex-column justify-content-around">
                  <span>Comment</span>
                  <span class="reply-link">Reply</span>
              </div>
              <div class="col-2">
                  22m
              </div>
          </div>
    </a>
    </div>
    </div>


</div>
<div class="mr-2">
<a href="/blogs/{{$blog->id}}/edit"><i class="fas fa-edit"></i></a>
    <i class="fas fa-trash"></i>
</div>
</div>
</div>
</div>
</div>
@endforeach
@endif

{{--<div class="d-flex justify-content-center align-items-center col-9">{{$blogs->links()}}</div>--}}
@else
<h4 class="text-white">No Posts Found</h4>
@endif

</div>

</div>
</div>
</div>

@endsection