@extends('layouts.app')
@section('content')
<div class="container">
        
    <div class="move-back">

<!--Events Page-->
<div class="d-flex flex-column justify-content-around align-items-center" id="Event-details">
  <a href="/events/create" class="component-button add-event"><i class="fas fa-plus mr-2"></i> Add New Event</a>
</div>


<div class="row justify-content-around align-items-center">
  @if(count($events)>0)
    <div class="col-10 bg-component" id="Event-heading">
      <div class="row justify-content-around  column-heading pr-3 pr-md-0">
       <h4 class="col-3 col-md-2 component-heading">Name</h4>
       <h4 class="col-3 col-md-2 col-lg-2 component-heading date-heading">Date</h4>
       <h4 class="col-4 col-md-2 col-lg-1 component-heading pl-md-5 pl-lg-0 content-spacing text-center">Registrations</h4>
       <h4 class="col-md-1 component-heading d-none d-md-block">Target</h4>
       <h4 class="col-2 col-md-1 component-heading head-heading pr-3">Head</h4>
       <h4 class="col-md-2 component-heading d-none d-lg-block venue-heading">Venue</h4>
       <h4 class="col-md-2 component-heading d-none d-md-block">Updated At</h4>
      </div>
      
     
      @foreach($events as $event)
      <div class="row justify-content-around component-text mb-4 pr-4 pr-md-0" id="Event-content">
        
      <a href="/events/{{$event->id}}/edit" class="col-md-2 col-3">{{$event->name}}</a>
        
      <span class="col-3 col-md-2 col-lg-2 date-content">{{$event->event_date->format('d/m/Y')}}</span>
      <span class="col-4 col-md-2 col-lg-1 content-spacing text-center">{{$event->registrations}}</span>
      <span class="col-md-1 d-none d-md-block text-center">{{$event->target}}</span>
      <span class="col-md-1 col-2 head-content">{{$event->head}}</span>
      <span class="col-md-2 d-none d-lg-block venue-content">{{$event->venue}}</span>
      <span class="col-md-2 d-none d-md-block">{{$event->updated_at->format('d/m/Y')}}</span>
      </div>
      @endforeach

      @else
      <h2 class="text-center text-white mt-4">No Events Found</h2>
    </div>
    @endif
</div>

    </div>
    </div>
@endsection