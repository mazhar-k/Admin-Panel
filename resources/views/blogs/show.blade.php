@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back mr-4">
   <div class="d-flex flex-column justify-content-around text-white px-md-5">
   <h1>{{$blog->title}}</h1>
   <h3 >{{$blog->description}}</h3>
   <h5 class="row flex-column flex-md-row justify-content-around justify-content-md-between font-weight-normal mx-1" id="blog-author">
   <div class="mb-2 mb-md-0"><span class="mr-3">Written By</span><i class="fas fa-user-circle "></i> {{$blog->user->name}}</div>
   <div class="mb-1 mb-md-0">{{$blog->created_at->toFormattedDateString()}}</div>
   </h5>
   <img src="/storage/cover_images/{{$blog->cover_image}}" class="card-img-top" alt="...">
   <h5 class="my-3">{!!$blog->body!!}</h5>
   <div>
       @foreach ($blog->tags as $tag)
           <span class="mx-1">#{{$tag->tag_name}}</span>
       @endforeach
    </div>
    <div class="d-flex justify-content-between blog-icons mt-2 component-heading">
        <div class="mr-2">
            <i class="fas fa-eye"></i> {{$blog->views}}
            <i class="fas fa-heart"></i> {{$blog->likes}}
            <i class="fas fa-comment-dots"></i> 76
        </div>
        <div class="mr-2">
            <a href="/blogs/{{$blog->id}}/edit" class="btn btn-outline-warning mx-2"><i class="fas fa-edit"> Edit</i></a>
            {!!Form::open(['action' => ['BlogsController@destroy', $blog->id], 'method' => 'DELETE','class'=>'d-inline'])!!}
            {{ Form::button('<i class="fa fa-trash-alt"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-outline-danger'])}}
            {!!Form::close()!!}
        </div>
   </div>
</div>
</div>
</div>
@endsection