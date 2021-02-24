@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back mr-4">
   <div class="d-flex flex-column justify-content-around text-white px-md-5">
   <h1>Edit Image</h1>
   {!! Form::open(['action' => ['MediaController@update',$media->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('caption', 'Caption :')}}
            {!!Form::textarea('caption', $media->caption, ['id'=>'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text'])!!}
        </div>
        
        <div class="form-group">
            {{Form::label('media', 'Upload Image:',['class'=>'d-block'])}}
            {{Form::file('media_image')}}
        </div> 

        <div class="d-flex justify-content-center align-items-center">
        {{Form::button('Submit', ['type'=>'submit','name'=>'action','value'=>'save_model','class'=>'btn component-button'])}}
        </div>
    {!! Form::close() !!}
</div>
</div>
</div>
@endsection