@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card" style="height: 75vh;">
            <div class="card-header">
                <span id="username" style="font-size: 20px;">Username&nbsp;</span> <span id="presence">●</span>
                <button class="btn btn-primary dropdown-toggle float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item"><i class="fa fa-trash"></i> Delete </a>
                </div>
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
