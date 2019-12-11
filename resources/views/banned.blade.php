<head>
    <link rel="stylesheet" href="{{asset("bootstrap/css/bootstrap.min.css")}}">
    <title>Oh no! | Banned </title>
</head>
<body style="background-color: #353842;">
    <div style="  height: 100vh;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="  color: rgb(255,255,255);  font-size: 60px;">
                        <strong>DENIED BY OUR LOVELY MAID</strong>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="text-center" style="  font-size: 30px;  color: rgb(255,255,255);">
                        Your IP is in our blocked IP list because of the following reason: <br />
                    @if (session('message'))
                        {{ session('message') }}
                    @endif
                    <br />
                    If this block is not rightful please contact us at <button class="btn btn-primary" type="button">Reveal email</button><br />
                    Please include this information or the email will be deleted:<br />
                    <strong>IP: </strong>{{\Request::getClientIp()}}<br />
                    <strong>Webclient: </strong>{{\Request::header('user-agent')}}<br />
                    <strong>Date:</strong>{{\Carbon::now()}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

