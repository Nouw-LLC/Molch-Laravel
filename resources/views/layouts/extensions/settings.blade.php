@extends('layouts.app')

@section('content')

    <div class="container-fluid" style="padding-left: 12px;height: 100%;">
        <div class="row" style="height: 100%;">
            <div class="col-sm-3 settings-nav-col" style="padding: 0px;margin-right: 12px;height: 100%;background-color: white;margin-top: -24px;">
                <a href="{{ url('settings/home') }}">
                    <div class="text-center settings-nav hover {{ Request::is('settings/home') ? 'active' : '' }}" style="height: 50px;width: 100%; border-top: 1px solid #e7e7e7">
                        <p class="text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;"><i class="fa fa-cogs"></i> Settings</p>
                    </div>
                </a>
                <a href="{{ url('settings/avatar') }}">
                    <div class="text-center settings-nav hover {{ Request::is('settings/avatar') ? 'active' : '' }}" style="height: 50px;width: 100%;">
                        <p class="text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;"><i class="fa fa-camera"></i> Change Avatar</p>
                    </div>
                </a>
                <a href="{{ url('settings/username') }}">
                    <div class="text-center settings-nav hover {{ Request::is('settings/username') ? 'active' : '' }}" style="height: 50px;width: 100%;">
                        <p class="text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;"><i class="fa fa-user"></i> Change Username</p>
                    </div>
                </a>
                <a href="{{ url('settings/email') }}">
                    <div class="text-center settings-nav hover {{ Request::is('settings/email') ? 'active' : '' }}" style="height: 50px;width: 100%;">
                        <p class="text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;"><i class="fa fa-envelope"></i> Change Email</p>
                    </div>
                </a>
                <a href="{{ url('settings/password') }}">
                    <div class="text-center settings-nav hover {{ Request::is('settings/password') ? 'active' : '' }}" style="height: 50px;width: 100%;">
                        <p class="text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;"><i class="fa fa-key"></i> Change Password</p>
                    </div>
                </a>
                <a href="{{ url('settings/status') }}">
                    <div class="text-center settings-nav hover {{ Request::is('settings/status') ? 'active' : '' }}" style="height: 50px;width: 100%;">
                        <p class="text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;"><i class="fa fa-user"></i> Change Status</p>
                    </div>
                </a>
                <a href="{{ url('settings/bio') }}">
                    <div class="text-center settings-nav hover {{ Request::is('settings/bio') ? 'active' : '' }}" style="height: 50px;width: 100%;">
                        <p class="text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;"><i class="fa fa-keyboard"></i> Change Bio</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @yield('content.extra')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
