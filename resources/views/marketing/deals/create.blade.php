@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back mr-4">

    
   <div class="d-flex flex-column justify-content-around text-white px-4 px-md-5">
        <h2 class='text-center mt-4'>Deal Details</h2>
        {!! Form::open(['action' => ['DealsController@store',$sponsor->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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

        <div class="row form-group pt-3">
        <div class="col-3 col-md-2 col-xl-1">
        {{Form::label('status', 'Status :')}}
        </div>
        <div class="col-5 col-md-4 mr-lg-2">
        {{Form::select('status', ['Ongoing' => 'Ongoing', 'Confirmed' => 'Confirmed'], null, ['class'=>'d-inline mx-2 form-control','placeholder' => 'Status...','id'=>'checkConfirmed'])}}
        </div>        
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