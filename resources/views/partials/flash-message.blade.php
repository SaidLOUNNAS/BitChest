<div class="row">
    <div class="col-12">
        @if(Session::has('message'))
            <div class="alert alert-success" role="alert">
                <p class="m-0">{{ Session::get('message') }}</p>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                <p class="m-0">{{ Session::get('error') }}</p>
            </div>
        @endif
    </div>
</div>
