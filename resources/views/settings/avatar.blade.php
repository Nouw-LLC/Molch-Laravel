@extends('layouts.extensions.settings')

@section('content.extra')
    <div class="row">
        <div class="col">
            <img class="avatar" src="{{url('storage/avatars/'.$user->avatar_name)}}">
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col my-auto">
            <p>The maximum dimensions for avatars is 140x140 px.
                <br>
                The maximum file size is 2mb.
            </p>
        </div>
    </div>
    <hr>
    <form class="form-group" method="POST" action="{{ url('settings/avatar/') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="file" class="form-control-file avatar-upload" name="avatar" id="avatarFile" aria-describedby="fileHelp">
        </div>
        <button type="submit" class="btn btn-primary justify-content-center">Submit</button>
    </form>
@endsection
