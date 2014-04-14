

        @if ($message = Session::get('success'))
        <div class="row">
            <div class="large-12 columns">
        
                <div data-alert class="alert-box success">
                    <h5>Yay Success!</h5> {{ $message }}     
                    <a href="#" class="close">&times;</a>
                </div>

            </div>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="row">
            <div class="large-12 columns">
        
                <div data-alert class="alert-box alert">
                    <h5>Uh Oh Error!</h5> 
                    {{ $message }}     
                    <a href="#" class="close">&times;</a>
                </div>

            </div>
        </div>       
        @endif



