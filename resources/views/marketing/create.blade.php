@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back mr-4">
   <div class="d-flex flex-column justify-content-around text-white">
   <h2 class='text-center'>Sponsor Details</h2>
   {!! Form::open(['action' => 'SponsorsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name :')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Sponsor Name'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('address','Address :')}}
            {{Form::textArea('address', '', ['class' => 'form-control', 'placeholder' => 'Sponsor Address'])}}
        </div>

        <div class="form-group">
            <div class="d-block d-md-inline pt-2">
            {{Form::label('contact', 'Contact :')}}
            {{Form::number('contact', '', ['class' => 'ml-5 ml-md-2 mr-4', 'placeholder' => 'Sponsor Contact no.'])}}
            </div>
            <div class="d-md-inline pt-3">
            {{Form::label('email', 'Email Address :')}}
            {{Form::text('email', '', ['class' => 'd-inline mx-2', 'placeholder' => 'Sponsor Email address'])}}
            </div>
        </div>

        <h2 class='text-center mt-4'>Deal Details</h2>

        <div class="form-group">
            {{Form::label('type', 'Type :')}}
            {{Form::text('type', '', ['class' => 'form-control', 'placeholder' => 'Sponsor Type'])}}
        </div>

        <div class="form-group">
            {{Form::label('amount', 'Amount :')}}
            {{Form::number('amount', '', ['class' => 'form-control', 'placeholder' => 'Cash amount/No. of Vouchers or Goodies/Days for stall'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('lead', 'Lead :')}}
            {{Form::text('lead', '', ['class' => 'form-control', 'placeholder' => 'Deal Lead'])}}
        </div>

        <div class="form-group pt-3">
        {{Form::label('status', 'Status :')}}
        {{Form::select('status', ['Ongoing' => 'Ongoing', 'Confirmed' => 'Confirmed'], null, ['class'=>'d-inline mx-2','placeholder' => 'Status...','id'=>'checkConfirmed'])}}        
        </div>
        
        <div class="form-group" id="ifConfirmed">
            {{Form::label('mou', 'Upload MOU :',['class'=>'d-block'])}}
            {{Form::file('mou')}}
        </div>

        <div class="d-flex justify-content-center align-items-center">
        {{Form::button('Submit', ['type'=>'submit','class'=>'btn component-button'])}}
        </div>
    {!! Form::close() !!}
</div>
</div>
</div>
@endsection