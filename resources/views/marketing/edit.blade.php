@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back mr-4">
   <div class="d-flex flex-column justify-content-around text-white px-md-5">
   <h2 class='text-center'>Sponsor Details</h2>
   {!! Form::open(['action' => ['SponsorsController@update',$sponsor->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name :')}}
            {{Form::text('name', $sponsor->name, ['class' => 'form-control', 'placeholder' => 'Sponsor Name'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('address','Address :')}}
            {{Form::textArea('address', $sponsor->address, ['class' => 'form-control', 'placeholder' => 'Sponsor Address'])}}
        </div>

        <div class="form-group">
            <div class="d-block d-md-inline pt-2">
            {{Form::label('contact', 'Contact :')}}
            {{Form::number('contact', $sponsor->contact, ['class' => 'ml-5 ml-md-2 mr-4', 'placeholder' => 'Sponsor Contact no.'])}}
            </div>
            <div class="d-md-inline pt-3">
            {{Form::label('email', 'Email Address :')}}
            {{Form::text('email', $sponsor->email, ['class' => 'd-inline mx-2', 'placeholder' => 'Sponsor Email address'])}}
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center">
        {{Form::submit('Submit', ['class'=>'btn component-button'])}}
        </div>
    {!! Form::close() !!}
</div>
</div>
</div>
@endsection