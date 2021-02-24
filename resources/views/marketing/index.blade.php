@extends('layouts.app')
@section('content')
<div class="container">
        
    <div class="move-back">


<!--Marketing Main Page-->
<div class="d-flex flex-column justify-content-around align-items-center" id="marketing">
<a href="/marketing/create" class="component-button add-new"><i class="fas fa-plus mr-2"></i> Add New</a>
</div>
@if(count($sponsors)>0)
<div class="row justify-content-around align-items-center">
  <div class="col-10 bg-component">
    <div class="row column-heading pr-md-3 pr-lg-0">
     <h4 class="col-4 col-md-3 component-heading">Comapany Name</h4>
     <h4 class="col-md-3 component-heading text-center content-spacing d-none d-md-block">Sponsor Type</h4>
     <h4 class="col-4 col-md-2 component-heading text-center">Status</h4>
     <h4 class="col-md-2 component-heading text-center d-none d-md-block">Lead</h4>
     <h4 class="col-4 col-md-2 component-heading">Updated At</h4>
    </div>
    
    @foreach ($sponsors as $sponsor)
    <div class="row justify-content-around component-text mb-4 pr-md-3 pr-lg-0">
    <a href="/marketing/{{$sponsor->id}}" class="col-md-3 col-4">{{$sponsor->name}}</a>
    <span class="col-md-3 text-center content-spacing d-none d-md-block">{{$sponsor->deal->type}}</span>
    <span class="col-md-2 col-4 text-center">{{$sponsor->deal->status}}</span>
    <span class="col-md-2 text-center d-none d-md-block">{{$sponsor->deal->lead}}</span>
    <span class="col-md-2 col-4">{{$sponsor->deal->updated_at->format('d/m/Y')}}</span>
    </div>
    @endforeach

    @else
    <h2 class="text-center text-white mt-4">No Sponsors Found</h2>
    </div>
    </div>
    @endif
    </div>
</div>
@endsection