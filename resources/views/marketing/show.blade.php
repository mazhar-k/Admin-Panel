@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back">
    <div class="row justify-content-around">
    <div class="col-10 col-md-9 col-lg-7 pl-xl-4">
    <div class="d-flex justify-content-center justify-content-md-start" id="new-deal-button">
    <a href='/deals/{{$sponsor->id}}/create' class="component-button component-text">Create New Deal</a>
    </div>
    </div>
    </div>

   <div class="row justify-content-around align-items-center">
   <div class="col-10 col-md-8 col-lg-6 d-flex flex-column justify-content-around text-white p-4 bg-component sponsor-details">
   <h2 class='text-center'>Sponsor Details</h2>
   <div class="d-flex flex-column justify-content-around">
   <h5 class="pt-2 pt-sm-1">Name : {{$sponsor->name}}</h5>
   <h5 class="pt-2 pt-sm-1">Address : {{$sponsor->address}}</h5>
   <h5 class="pt-2 pt-sm-1">Contact : {{$sponsor->contact}}</h5>
   <h5 class="py-2 py-sm-1">Email : {{$sponsor->email}}</h5>
   <div class="d-flex justify-content-between justify-content-sm-end page-buttons">
   <a href="/marketing/{{$sponsor->id}}/edit" class="btn btn-outline-warning mx-2"><i class="fas fa-edit"> Edit</i></a>
    {!!Form::open(['action' => ['SponsorsController@destroy', $sponsor->id], 'method' => 'DELETE','class'=>'d-inline'])!!}
    {{ Form::button('<i class="fa fa-trash-alt"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-outline-danger mr-2'])}}
    {!!Form::close()!!}
   </div>
   </div>
   </div>
   </div>

   <div class="row justify-content-around align-items-center">
   <div class="col-10 col-md-8 col-lg-6 d-flex flex-column justify-content-around text-white bg-component pt-4 px-4 deal-details">
   <h2 class='text-center mb-2'>Deal Details</h2>
   <?php $count=1 ?>
    @foreach ($sponsor->deals as $deal)
   <div class="d-flex flex-column flex-lg-row justify-content-between py-3">
   <div class="d-flex flex-column justify-content-around">
   <h5>{{$count}}. Type : {{$deal->type}}</h5>
   <h5 class="pl-4">Amount : {{$deal->amount}}</h5>
   <h5 class="pl-4">Lead : {{$deal->lead}}</h5>
   <h5 class="pl-4">Status : {{$deal->status}}</h5>
   @if($deal->mou!=='')
   <a href='/download_mou/{{$deal->id}}' class="pl-4 py-2"><div class='btn btn-outline-primary d-none d-lg-inline'><i class="fas fa-file-download pr-2"></i> MOU</div></a>
   @endif
   </div>
   <div class="row justify-content-between align-items-center">
    <a href='/download_mou/{{$deal->id}}' class="pl-4 py-2"><div class='btn btn-outline-primary d-inline d-lg-none'><i class="fas fa-file-download pr-2"></i> MOU</div></a>
   <div class="d-flex justify-content-end justify-content-lg-center align-items-center page-buttons">
   <a href="/deals/{{$deal->id}}/edit" class="btn btn-outline-warning mx-2"><i class="fas fa-edit"> Edit</i></a>
    {!!Form::open(['action' => ['DealsController@destroy', $deal->id, $sponsor->id], 'method' => 'DELETE','class'=>'d-inline'])!!}
    {{ Form::button('<i class="fa fa-trash-alt"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-outline-danger mr-2'])}}
    {!!Form::close()!!}
   </div>
   </div>
   </div>
   <?php $count++ ?>
@endforeach
</div>
</div>


</div>
</div>
@endsection