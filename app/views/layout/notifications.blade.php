

        @if ($errors->any())
        <div class="row">
            <div class="large-12 columns">
        
                <div data-alert class="alert-box alert radius">
                    <strong>Error</strong> Please check the form below for errors      
                    <a href="#" class="close">&times;</a>
                </div>

            </div>
        </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="row">
            <div class="large-12 columns">
        
                <div data-alert class="alert-box success radius">
                    <strong>Success</strong> {{ $message }}     
                    <a href="#" class="close">&times;</a>
                </div>

            </div>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="row">
            <div class="large-12 columns">
        
                <div data-alert class="alert-box alert radius">
                    <strong>Error</strong> {{ $message }}      
                    <a href="#" class="close">&times;</a>
                </div>

            </div>
        </div>       
        @endif



