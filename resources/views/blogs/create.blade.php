@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back mr-4">
   <div class="d-flex flex-column justify-content-around text-white">
   <h1>Create Post</h1>
   {!! Form::open(['action' => 'BlogsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
       
        <div class="form-group">
            <div class="d-block d-md-inline pt-2">
            {{Form::label('Category', 'Category :',['class'=>'pr-2'])}}
            {{Form::select('Category',$select, ['class'=>'text-secondary','placeholder' => 'Select a category...','name'=>'category'])}}
            </div>
            <div class="d-block d-md-inline pt-2 pt-md-0">
            {{Form::text('category', '', ['class' => 'ml-md-3 mr-3', 'placeholder' => 'Add New Category...'])}}
            {{Form::button('<i class="fa fa-plus"></i>', ['type'=>'submit','name'=>'action','value'=>'add-new-category','class' => 'btn btn-outline-primary'])}}
            </div>
        </div>
        
        <div class="form-group">
            {{Form::label('decription', 'Description')}}
            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {!!Form::textarea('body', '', ['id'=>'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text'])!!}
        </div>
        
        <div class="form-group">
            {{Form::label('media', 'Media:',['class'=>'d-block'])}}
            {{Form::file('cover_image')}}
        </div>

        <div class="form-group pt-2">
            <div class="d-block">
            {{Form::label('tags', 'Tags:')}}
            {{Form::text('tags', '', ['class' => 'mx-3', 'placeholder' => 'Add New Tag...'])}}
            {{Form::button('<i class="fa fa-plus"></i>', ['type'=>'submit','name'=>'action','value'=>'add-new-tag','class' => 'btn btn-outline-primary'])}}
            </div>
            <div class="px-3">
            @foreach($tags as $tag)
            <div class="row d-block d-lg-inline">
            {{Form::checkbox('selected_tags[]',$tag->id)}}
            {{Form::label('tag', $tag->tag_name,['class'=>'mt-3 pl-1 pr-5'])}}
            </div>
            @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
        {{Form::button('Submit', ['type'=>'submit','name'=>'action','value'=>'save_model','class'=>'btn component-button'])}}
        </div>
    {!! Form::close() !!}
</div>
</div>
</div>
@endsection