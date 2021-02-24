@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back mr-4" id="create-event">
   <div class="d-flex flex-column justify-content-around text-white">
   <h1>Create Event</h1>
   {!! Form::open(['action' => 'EventsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name of the event :')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Event Name'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('date','Event Date :')}}
            {{Form::date('date', \Carbon\Carbon::now(),['class'=>'mx-2'])}}
        </div>

        <div class="form-group">
            {{Form::label('target', 'Target :')}}
            {{Form::number('target', '', ['class' => 'd-inline mx-2', 'placeholder' => 'Registration Target'])}}
        </div>

        <div class="form-group">
            {{Form::label('head', 'Head of the event :')}}
            {{Form::text('head', '', ['class' => 'form-control', 'placeholder' => 'Event Head'])}}
        </div>
        <div class="form-group">
            {{Form::label('venue', 'Venue :')}}
            {{Form::text('venue', '', ['class' => 'form-control', 'placeholder' => 'Event Venue'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('media', 'Media:',['class'=>'d-block'])}}
            {{Form::file('event_image')}}
        </div>

        <div class="d-flex justify-content-center align-items-center">
        {{Form::button('Submit', ['type'=>'submit','class'=>'btn component-button'])}}
        </div>
    {!! Form::close() !!}
</div>
</div>
</div>
@endsection