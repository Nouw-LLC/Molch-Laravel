@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card" style="height: 75vh;">
            <div class="card-header"><span id="username" style="font-size: 20px;">Username&nbsp;</span> <span id="presence">●</span>
            </div>
            <div class="card-body card-body-overflow">
                <div class="row">
                    <ul id="message-list"></ul>
                </div>
            </div>
            <div class="card-footer">
                <form id="message-form">
                    <div class="input-group">
                        <div class="input-group-prepend"></div><input id="message-text" class="form-control" type="text" placeholder="Type your message here!">
                        <div class="input-group-append"><input class="btn btn-primary" type="submit"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection