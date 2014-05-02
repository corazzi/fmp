        @if ($message = Session::get('success-home'))       
        <div data-alert class="alert-box success">
            <div class="row">
                <div class="large-12 columns">
                    {{ $message }}     
                    <a href="#" class="close">&times;</a>
                </div>
            </div>
        </div>
        @endif

        @if ($message = Session::get('error-home'))      
        <div data-alert class="alert-box alert">
            <div class="row">
                <div class="large-12 columns">
                    {{ $message }}     
                    <a href="#" class="close">&times;</a>
                </div>
            </div>
        </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="row">
            <div class="large-12 columns">
        
                <div data-alert class="alert-box success">
                    {{ $message }}     
                    <a href="#" class="close">&times;</a>
                </div>

            </div>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="row">
            <div class="large-12 columns">
        
                <div data-alert class="alert-box alert">
                    {{ $message }}     
                    <a href="#" class="close">&times;</a>
                </div>

            </div>
        </div>       
        @endif



