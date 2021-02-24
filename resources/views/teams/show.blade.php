@extends('layouts.app')
@section('content')
<div class="container">
<div class="move-back" id="member-card">
    <div class="card mb-3 bg-component">
        <div class="row flex-column flex-md-row no-gutters">
          <div class="col-md-4">
            <img src="/storage/team_profile_images/{{$member->member_image}}" class="img-fluid profile-image" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
            <p class="card-text text-white department">{{$member->department}}</p>
            <h4 class="card-title text-white">{{$member->name}}</h4>
            <p class="card-text text-white">{{$member->post}}</p>
            <div class="media-handles d-flex justify-content-between align-items-center">
                <a href="https://www.instagram.com/{{$member->instagram}}/" target="blank" class="pr-3 pr-sm-0"><i class="fab fa-instagram-square"></i></a>
                <a href="https://www.linkedin.com/{{$member->linkedIn}}/" target="blank" class="pr-3 pr-sm-0"><i class="fab fa-linkedin"></i></a>
                <a href="https://www.facebook.com/{{$member->facebook}}" target="blank" class="pr-3 pr-sm-0"><i class="fab fa-facebook-square"></i> </a>
                <a href="https://github.com/{{$member->github}}" target="blank" class="pr-3 pr-sm-0"><i class="fab fa-github-square"></i> </a>
            <a href="https://medium.com/@.{{$member->medium}}" target="blank" class="pr-3 pr-sm-0"><i class="fab fa-medium"></i> </a>
            </div>
            <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start text-white py-3">
                <span class="card-text">Phone : {{$member->contact}}</span>
                <span class="card-text mt-2 mt-sm-0 mx-sm-3">Email : {{$member->email}}</span>
            </div>
            <div class="d-flex justify-content-end page-buttons">
              <a href="/teams/{{$member->id}}/edit" class="btn btn-outline-warning mx-2"><i class="fas fa-edit"> Edit</i></a>
               {!!Form::open(['action' => ['TeamsController@destroy', $member->id], 'method' => 'DELETE','class'=>'d-inline'])!!}
               {{ Form::button('<i class="fa fa-trash-alt"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-outline-danger mr-2'])}}
               {!!Form::close()!!}
            </div>
            </div>
          </div>
        </div>
      </div>
</div>
</div>
@endsection