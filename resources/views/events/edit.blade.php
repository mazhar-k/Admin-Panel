@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back mr-4" id="create-event">
   <div class="d-flex flex-column justify-content-around text-white">
    <h1>Edit Event</h1>
    {!! Form::open(['action' => ['EventsController@update',$event->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data','id'=>'event-edit-form']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name of the event :')}}
            {{Form::text('name', $event->name, ['class' => 'form-control', 'placeholder' => 'Event Name'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('date','Event Date :')}}
            {{Form::date('date',\Carbon\Carbon::parse($event->event_date),['class'=>'mx-2'])}}
        </div>

        <div class="form-group">
            {{Form::label('target', 'Target :')}}
            {{Form::number('target', $event->target, ['class' => 'd-inline mx-2', 'placeholder' => 'Registration Target'])}}
        </div>

        <div class="form-group">
            {{Form::label('head', 'Head of the event :')}}
            {{Form::text('head', $event->head, ['class' => 'form-control', 'placeholder' => 'Event Head'])}}
        </div>
        <div class="form-group">
            {{Form::label('venue', 'Venue :')}}
            {{Form::text('venue', $event->venue, ['class' => 'form-control', 'placeholder' => 'Event Venue'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('media', 'Media:',['class'=>'d-block'])}}
            {{Form::file('event_image')}}
        </div>
    {!! Form::close() !!}

    <div class="d-flex justify-content-between align-items-center">
        {{Form::button('Submit', ['type'=>'submit','class'=>'btn component-button','id'=>'event-edit-submit-button'])}}
        {!!Form::open(['action' => ['EventsController@destroy', $event->id], 'method' => 'DELETE','class'=>'d-inline'])!!}
        {{Form::button('Delete', ['type'=>'submit','class'=>'btn delete'])}}
        {!! Form::close() !!}
    </div>
    {{--
    {!!Form::open(['action' => ['EventsController@destroy', $event->id], 'method' => 'DELETE'])!!}
    {{Form::button('Delete', ['type'=>'submit','class'=>'btn delete'])}}
    {!! Form::close() !!} --}}
</div>
</div>
</div>
@endsection