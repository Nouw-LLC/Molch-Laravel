@extends('layouts.staff')

@section('content')
    <div class="container-fluid" style="height: 75vh;">
        <a href="{{ url('staff/users') }}"><button class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to list</button></a>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col">
                <div class="card-deck d-flex">
                    <div class="card shadow-lg white">
                        <div class="card-body my-auto" style="background-image:url('Synthwave-Neon-80s-Background-4K.jpg');background-size:cover;background-repeat:no-repeat;background-position:center;">
                            <h4 class="card-title"><img class="rounded-circle mx-auto d-block avatar" src="{{url('storage/avatars/'.$user->avatar_name)}}"/></h4>
                            <div class="profile-container">
                                <h3 class="text-center">{{$user->name}}</h3>
                                <p>{{ $user->status }}</p>
                                <hr style="  {{$hr}}
                                    " />
                                <div class="overflow-auto">
                                    <div class="left">Posts:</div>
                                    <div class="right">{{$user->posts_count}}</div>
                                </div>
                                <div class="overflow-auto">
                                    <div class="left">Likes:</div>
                                    <div class="right">{{$user->likes_count}}</div>
                                </div>
                                <div class="overflow-auto">
                                    <div class="left">Joined:</div>
                                    <div class="right">{{ (new Carbon\Carbon($user->created_at, 'Europe/Amsterdam'))->diffForHumans() }}</div>
                                </div>
                            </div>

                            <hr style="  {{$hr}};
                                " />
                            <div class="text-center">
                                <a href="{{url('chat/create/'.$user->id)}}">
                                    <button class="btn btn-primary mx-auto" type="button" style="  width: 90%;">Send a message</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg">
                        <table class="table dataTable my-0" id="dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Reason</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($warnings as $warning)
                                <tr>
                                    <td>{{$warning->id}}</td>
                                    <td>{{$warning->reason}}</td>
                                    <td>{{$warning->created_at}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
