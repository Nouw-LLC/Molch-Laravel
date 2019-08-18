@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card" style="height: 75vh">
            <div class="card-header"><span style="font-size: 20px;">The Feed</span><button class="btn btn-primary btn-sm border rounded float-right" id="feed-msg-btn" type="button" data-target="#feed-form" data-toggle="modal"><i class="fa fa-plus"></i></button></div>
            <div class="card-body card-body-overflow">
                <feed-messages :messages="messages"></feed-messages>
            </div>
        </div>
    </div>
@endsection
