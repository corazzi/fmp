@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Change Password')

{{-- Page content --}}
@section('content')

<div class="page-header">
    <div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-user"></i> @yield('title') </h4>
        </div>
    </div>
</div>

<div class="breadcrumbs"> 
    <a href="{{ route('me-home') }}">Profile</a>
    <a class="unavailable">Change Password</a>  
</div>

<div class="inner-content">

    <div class="large-3 columns">

        @include('layout/profile_nav')

    </div>

    <div class="large-9 columns">
        <div class="content-box">
            
            <form action="{{ route('change-password') }}" method="post" class="add profile-edit">

                <fieldset>
                    
                    <legend>Change Password</legend>

                
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="small-12">
                    <div class="row">
                        <div class="small-4 columns">
                            <label for="old_password" class="right inline">Old Password</label>
                        </div>
                        <div class="small-8 columns">
                            <input class="{{ $errors->first('old_password', ' error') }}" type="password" name="old_password">
                            {{ $errors->first('old_password', '<small class="error">:message</small>') }}
                        </div>
                    </div>
                </div>

                <div class="small-12">
                    <div class="row">
                        <div class="small-4 columns">
                            <label for="password" class="right inline">New Password</label>
                        </div>
                        <div class="small-8 columns">
                            <input class="{{ $errors->first('password', ' error') }}" type="password" name="password">
                            {{ $errors->first('password', '<small class="error">:message</small>') }}
                        </div>
                    </div>
                </div>

                <div class="small-12">
                    <div class="row">
                        <div class="small-4 columns">
                            <label for="password_confirm" class="right inline">Confirm New Password</label>
                        </div>
                        <div class="small-8 columns">
                            <input class="{{ $errors->first('password_confirm', ' error') }}" type="password" name="password_confirm">
                            {{ $errors->first('password_confirm', '<small class="error">:message</small>') }}
                        </div>
                    </div>
                </div>


                <div class="large-12 columns">
                    <button class="tiny right" type="submit">Change Pass</button>
                </div>


                </fieldset>


            </form>

        </div>
    </div>

</div>

@stop