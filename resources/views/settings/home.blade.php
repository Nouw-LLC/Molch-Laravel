@extends('layouts.extensions.settings')

@section('content.extra')
    <table class="table">
        <tbody>
            <tr>
                <td>Username:</td>
                <td>{{ $user->name }}</td>
                <td><a href="{{url('settings/username')}}"><button class="btn btn-primary"><i class="fa fa-cog"></i> </button> </a></td>

            </tr>
            <tr>
                <td>Email:</td>
                <td>{{ $user->email }}</td>
                <td><a href="{{url('settings/email')}}"><button class="btn btn-primary"><i class="fa fa-cog"></i> </button> </a></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>{{ $user->status }}</td>
                <td><a href="{{url('settings/status')}}"><button class="btn btn-primary"><i class="fa fa-cog"></i> </button> </a></td>
            </tr>
        </tbody>
    </table>
@endsection
