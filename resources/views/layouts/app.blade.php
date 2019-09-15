<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Molch</title>
    <link rel="stylesheet" href="{{asset("bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <script src="https://kit.fontawesome.com/2698fbf7e9.js"></script>
    <link rel="stylesheet" href="{{asset("css/laravel-bss.css")}}">
    <link rel="stylesheet" href="{{asset("css/untitled.css")}}">
    <link rel="stylesheet" href="{{asset("css/untitled.compiled.css")}}">
    <script src="{{ asset('js/chat.js')}}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/@pusher/chatkit-client@1/dist/web/chatkit.js"></script>
    <script>console.log(id);</script>

</head>

<body id="page-top">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background-color: rgb(205,40,159);">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{ route('home') }}">
                Molch
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
{{--                <li class="nav-item" role="presentation"><a class="nav-link text-center" href="#"><i class="fa fa-plus"></i><span class="text-center">Make new chat</span></a></li>--}}
                @foreach($chats->body as $instance)
                    <li class="nav-item" role="presentation"><a class="nav-link text-center" href="{{url("chat/{$instance['id']}")}}"><i class="fa fa-comment"></i>{{$instance["name"]}}</a></li>
                @endforeach
            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for user">
                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                        </div>
                    </form>
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                            <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto navbar-search w-100">
                                    <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                        <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                        <li class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                                 role="menu">
                                <h6 class="dropdown-header">alerts center</h6>
                                <a class="d-flex align-items-center dropdown-item" href="#">
                                    <div class="mr-3">
                                        <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                    </div>
                                    <div><span class="small text-gray-500">December 12, 2019</span>
                                        <p>A new monthly report is ready to download!</p>
                                    </div>
                                </a>
                                <a class="d-flex align-items-center dropdown-item" href="#">
                                    <div class="mr-3">
                                        <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                    </div>
                                    <div><span class="small text-gray-500">December 7, 2019</span>
                                        <p>$290.29 has been deposited into your account!</p>
                                    </div>
                                </a>
                                <a class="d-flex align-items-center dropdown-item" href="#">
                                    <div class="mr-3">
                                        <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                    </div>
                                    <div><span class="small text-gray-500">December 2, 2019</span>
                                        <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                    </div>
                                </a><a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a></div>
                        </li>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow" role="presentation">
                        <li class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">{{Auth::user()->name}}</span><img class="border rounded-circle img-profile" src="{{url('storage/avatars/'.$user->avatar_name)}}"></a>
                            <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                <a class="dropdown-item" role="presentation" href="{{ url('profile/'.Auth::user()->id) }}"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                <a class="dropdown-item" role="presentation" href="{{url('settings/home')}}"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                @hasanyrole('Moderator|Admin')
                                <a class="dropdown-item" role="presentation" href="{{url('staff/dashboard')}}"><i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Staff Dashboard</a>
                                @endhasanyrole
                                <a class="dropdown-item" role="presentation" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('Logout') }}</a></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="" id="app">
                @yield('content')

            </div>

        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Molch 2019</span></div>
            </div>
        </footer>
<script src="{{asset("js/jquery.min.js")}}"></script>
<script src="{{asset("bootstrap/js/bootstrap.min.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="{{asset("js/modal.js")}}"></script>
<script src="{{asset("js/theme.js")}}"></script>
</body>

</html>
<script>

</script>
