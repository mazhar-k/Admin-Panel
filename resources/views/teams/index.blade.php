@extends('layouts.app')
@section('content')
<div class="container">

    <div class="move-back">
        {{-- <div class="d-flex justify-content-start align-items-center">
        <a href="/teams/create" class="component-button"><i class="fas fa-plus mr-2"></i> New Member</a>
        </div> --}}

        <div class="d-none d-xl-flex justify-content-around align-items-center" id="team-filter">

                <a href="/teams/quintet"><div class="component-button mb-4">Quintet</div></a>
                <a href="/teams/admins"><div class="component-button mb-4">Admins</div></a>
                <a href="/teams/heads" id="heads"><div class="component-button mb-4">Heads</div></a>               

                {!! Form::open(['action' => 'TeamsController@filterByTeam','method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group row ml-lg-2 pt-2">
                <div class="col-8">
                {{Form::select('team',['Public Relations Team'=>'Public Relations Team','Technical Team'=>'Technical Team','Organising Team'=>'Organising Team','Finance Team'=>'Finance Team','Marketing Team'=>'Marketing Team','Creative Team'=>'Creative Team','Social Media Team'=>'Social Media Team'],null, ['class'=>'mx-3 text-secondary form-control','placeholder' => 'Select a Team...'])}}
                </div>
                <div class="col-2">
                {{ Form::button('<i class="fas fa-filter"></i>',['type'=>'submit','class'=>'btn btn-outline-primary d-inline']) }}
                </div>
                </div>
                {!! Form::close() !!}


                <a href="/teams/create" class="component-button mb-4 new-member"><i class="fas fa-plus mr-2"></i> New Member</a>

        </div>

        <div class="d-flex d-xl-none justify-content-center align-items-center mb-4" id="team-filter-small">

            <a href="/teams/quintet"><div class="component-button d-none d-md-inline filter-button">Quintet</div></a>
            <a href="/teams/admins"><div class="component-button d-none d-md-inline filter-button">Admins</div></a>
            <a href="/teams/heads" id="heads"><div class="component-button d-none d-md-inline filter-button">Heads</div></a>               

            {{-- {!! Form::open(['action' => 'TeamsController@filterByTeam','method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group row ml-lg-2 pt-2">
            <div class="col-8">
            {{Form::select('team',['Public Relations Team'=>'Public Relations Team','Technical Team'=>'Technical Team','Organising Team'=>'Organising Team','Finance Team'=>'Finance Team','Marketing Team'=>'Marketing Team','Creative Team'=>'Creative Team','Social Media Team'=>'Social Media Team'],null, ['class'=>'mx-3 text-secondary form-control','placeholder' => 'Select a Team...'])}}
            </div>
            <div class="col-2">
            {{ Form::button('<i class="fas fa-filter"></i>',['type'=>'submit','class'=>'btn btn-outline-primary d-inline']) }}
            </div>
            </div>
            {!! Form::close() !!} --}}


            <a href="/teams/create" class="component-button new-member"><i class="fas fa-plus mr-2"></i>New Member</a>

    </div>
        
        <!--Quintet Members Start-->
        {{-- @if(count($members)>0) --}}
        {{-- @foreach($departments as $department) --}}
        @foreach($departments as $department)
        @if($filter_id==0)
        <?php $members=App\Team::where('department','=',$department)->get() ?>
        @elseif($filter_id==1)
        <?php $members=App\Team::where('department','=',$department)->where('post','like',"%Head%")->get() ?>
        @else
        @break
        @endif
        {{-- @if(count($members)==0)
        <h2 class="text-white text-center">No Members Found</h2>
        @endif --}}
        @if(count($members)>0)
        <div class="row flex-column flex-xl-row justify-content-around align-items-center px-lg-4 px-lg-0">
            @foreach($members as $member)
            <div class="col-9 col-sm-7 col-md-6 col-lg-5 col-xl-4 mb-4">
                <div class="card bg-component component-text d-flex flex-column justify-content-around" id='team-card'>
                    <div class="d-flex justify-content-between align-items-center py-2 px-3">
                    <h6 class='department'>{{$member->department}}</h6>
                        <i class="fas fa-ellipsis-v dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item text-center" href="#">Edit</a>
                                <a class="dropdown-item text-center" href="#">Remove</a>
                            </div>
                        </i>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-around align-items-center">
                        <img src="/storage/team_profile_images/{{$member->member_image}}" class="profile-image" alt="...">
                        <div class="py-2 text-white text-center">
                            <a href="/teams/{{$member->id}}"><h4>{{$member->name}}</h4></a>
                        <h5>{{$member->post}}</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around media-handles">
                    <a href="https://www.instagram.com/{{$member->instagram}}/" target="blank"><i class="fab fa-instagram-square"></i></a>
                    <a href="https://www.linkedin.com/{{$member->linkedIn}}/" target="blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.facebook.com/{{$member->facebook}}" target="blank"><i class="fab fa-facebook-square"></i> </a>
                    </div>
                    <div class="card-text text-center py-3">
                        <small class="message">Message</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        <hr>
        @endif
        @endforeach

        @if($filter_id==2)
        <?php $members=App\Team::where('post','=',$team)->get() ?>
        @if(count($members)>0)
        <div class="row flex-column flex-xl-row justify-content-around align-items-center px-lg-4 px-lg-0">
            @foreach($members as $member)
            <div class="col-9 col-sm-7 col-md-6 col-lg-5 col-xl-4 mb-4">
                <div class="card bg-component component-text d-flex flex-column justify-content-around" id='team-card'>
                    <div class="d-flex justify-content-between align-items-center py-2 px-3">
                    <h6 class='department'>{{$member->department}}</h6>
                        <i class="fas fa-ellipsis-v dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item text-center" href="#">Edit</a>
                                <a class="dropdown-item text-center" href="#">Remove</a>
                            </div>
                        </i>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-around align-items-center">
                        <img src="/storage/team_profile_images/{{$member->member_image}}" class="profile-image" alt="...">
                        <div class="py-2 text-white text-center">
                            <a href="/teams/{{$member->id}}"><h4>{{$member->name}}</h4></a>
                        <h5>{{$member->post}}</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around media-handles">
                    <a href="https://www.instagram.com/{{$member->instagram}}/" target="blank"><i class="fab fa-instagram-square"></i></a>
                    <a href="https://www.linkedin.com/{{$member->linkedIn}}/" target="blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.facebook.com/{{$member->facebook}}" target="blank"><i class="fab fa-facebook-square"></i> </a>
                    </div>
                    <div class="card-text text-center py-3">
                        <small class="message">Message</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        <hr>
        @endif
        @endif
    </div>
    </div>

</div>
@endsection