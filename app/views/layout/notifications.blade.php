<div class="container">
    <div class="row">
        <div class="col-md-12">

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error</strong>
            <p>Please check the form below for errors </p>
        </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success</strong>
            <p> {{ $message }} </p>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error</strong>
            <p> {{ $message }} </p>
        </div>
        @endif

        </div>
    </div>
</div>