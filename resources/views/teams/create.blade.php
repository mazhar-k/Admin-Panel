@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back mr-4" id="add-member">
   <div class="d-flex flex-column justify-content-around text-white px-3 px-md-4 px-lg-5">
   <h1>Add Member</h1>
   {!! Form::open(['action' => 'TeamsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name :')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Member Name'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('department','Department :')}}
            {{Form::text('department', '', ['class' => 'form-control', 'placeholder' => 'Department'])}}
        </div>

        <div class="form-group">
            {{Form::label('post','Post :')}}
            {{Form::text('post', '', ['class' => 'form-control', 'placeholder' => 'Post'])}}
        </div>

        <h5 class="text-white py-2">Social Media Handles</h5>
        <div class="form-group row">
            <div class="col-md-2">
            {{Form::label('instagram', 'Instagram :')}}
            </div>
            <div class="col-md-4">
            {{Form::text('instagram', '', ['class' => 'form-control', 'placeholder' => 'Instagram handle'])}}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-2">
            {{Form::label('linkedin', 'LinkedIn :')}}
            </div>
            <div class="col-md-4">
            {{Form::text('linkedin', '', ['class' => 'form-control', 'placeholder' => 'LinkedIn handle'])}}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-2">
            {{Form::label('facebook', 'Facebook :')}}
            </div>
            <div class="col-md-4">
            {{Form::text('facebook', '', ['class' => 'form-control', 'placeholder' => 'Facebook handle'])}}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-2">
            {{Form::label('github', 'Github :')}}
            </div>
            <div class="col-md-4">
            {{Form::text('github', '', ['class' => 'form-control', 'placeholder' => 'Github handle'])}}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-2">
            {{Form::label('medium', 'Medium :')}}
            </div>
            <div class="col-md-4">
            {{Form::text('medium', '', ['class' => 'form-control', 'placeholder' => 'Medium handle'])}}
            </div>
        </div>

        <div class="form-group pt-2">
            <div class="d-block d-lg-inline">
            {{Form::label('contact', 'Contact :')}}
            {{Form::number('contact', '', ['class' => 'ml-5 ml-lg-2 mr-4', 'placeholder' => 'Sponsor Contact no.'])}}
            </div>
            <div class="d-lg-inline pt-3">
            {{Form::label('email', 'Email Address :')}}
            {{Form::text('email', '', ['class' => 'd-inline mx-2', 'placeholder' => 'Sponsor Email address'])}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('media', 'Profile Image:',['class'=>'d-block'])}}
            {{Form::file('member_image')}}
        </div>

        <div class="d-flex justify-content-center align-items-center">
        {{Form::button('Submit', ['type'=>'submit','class'=>'btn component-button'])}}
        </div>
    {!! Form::close() !!}
</div>
</div>
</div>
@endsection