@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="height: 75vh;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col">
                <div class="card-deck d-flex">
                    <div class="card shadow-lg white">
                        <div class="card-body my-auto" style="background-image:url('Synthwave-Neon-80s-Background-4K.jpg');background-size:cover;background-repeat:no-repeat;background-position:center;">
                            <h4 class="card-title"><img class="rounded-circle mx-auto d-block avatar" src="{{url('storage/avatars/'.$user->avatar_name)}}"/></h4>
                            <div class="profile-container">
                                <h3 class="text-center">{{$profileUser->name}}</h3>
                                <p>{{ $profileUser->status }}</p>
                                <hr style="  {{$hr}}
                                    " />
                                <div class="overflow-auto">
                                    <div class="left">Posts:</div>
                                    <div class="right">{{$profileUser->posts_count}}</div>
                                </div>
                                <div class="overflow-auto">
                                    <div class="left">Likes:</div>
                                    <div class="right">{{$profileUser->likes_count}}</div>
                                </div>
                                <div class="overflow-auto">
                                    <div class="left">Joined:</div>
                                    <div class="right">{{ (new Carbon\Carbon($profileUser->created_at, 'Europe/Amsterdam'))->diffForHumans() }}</div>
                                </div>
                            </div>

                            <hr style="  {{$hr}};
" />
                            <div class="text-center">
                                <a href="{{url('chat/create/'.$profileUser->id)}}">
                                    <button class="btn btn-primary mx-auto" type="button" @if($profileUser->id === $user->id) disabled @endif style="  width: 90%;">Send a message</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h4>Bio</h4>
                        </div>
                        <div class="card-body"></div>
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h4>Social</h4>
                        </div>
                        <div class="card-body"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
