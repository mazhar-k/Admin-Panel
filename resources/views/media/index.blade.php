@extends('layouts.app')
@section('content')
<div class="container">
        
    <div class="move-back">


<!-- Media Page-->
<div class="row justify-content-center justify-content-lg-start align-items-center new-image-button" id="media">
 <a href="/media/create" class="component-button"><i class="fas fa-plus fa-md mr-1"></i> Add New Image</a>
</div>


<!--Carousel Images Part-->
<div class="row justify-content-around align-items-center">
  <div class="col-9 col-md-8 col-lg-10 bg-component d-flex flex-column justify-content-around align-items-center" id="carousel-images">
  @if(count($media_images)>0)

  <div class="tab-title my-2">Carousel Images</div>

<div class="row flex-column flex-lg-row justify-content-around align-items-center px-2" id="img-card">
  @foreach($media_images as $media)
  <div class="col-10 col-md-8 col-lg-4 mb-4">
  <div class="card text-white" id="media-card">
      <img src="/storage/carousal_images/{{$media->media_image}}" class="card-img-top" alt="...">
      <div class="card-body">
      <div class="mb-4">{!!$media->caption!!}</div>
      <div class="bottom-text">
      <a href="/media/{{$media->id}}/edit" class="btn btn-outline-warning float-left"><i class="fas fa-edit"> Edit</i></a>
      {!!Form::open(['action' => ['MediaController@destroy', $media->id], 'method' => 'DELETE','class'=>'d-inline'])!!}
      {{Form::button('<i class="fas fa-trash-alt"></i> Delete', ['type'=>'submit','class'=>'btn btn-outline-danger float-right'])}}
      {!! Form::close() !!}
      </div>
      </div>
  </div>
</div>
@endforeach

</div>
@else
<h5 class="text-white m-3">No Carousal Images Found</h5>
@endif
</div>
</div>
@endsection