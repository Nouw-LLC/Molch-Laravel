<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row align-items-center text-center">
                <div class="col">
                    <h1>DENIED BY MAID</h1>
                    <p>You have been denied by our maid</p>
                </div>
            </div>
            <div class="row align-items-center text-center">
                <div class="col">
                    @if (session('message'))
                        <div class="alert alert-danger">
                            {!! session('message') !!}
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </div>

</div>
