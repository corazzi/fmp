@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Edit Profile')

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
    <a class="unavailable">Edit Profile</a>  
</div>

<div class="inner-content">

    <div class="large-3 columns">

        @include('layout/profile_nav')

    </div>

    <div class="large-9 columns">
        <div class="content-box">

            @if(is_null(Sentry::getUser()->avatar))
            <form action="{{ route('post-avatar') }}" method="post" class="add profile-edit"  enctype="multipart/form-data">
            @else 
            <form action="{{ route('delete-avatar') }}" method="post" class="add profile-edit">
            @endif

                <fieldset>
                    
                    <legend>Change Avatar</legend>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="small-12">
                            <div class="row">
                                <div class="small-3 columns">
                                    <label for="upload" class="right inline">@if(is_null(Sentry::getUser()->username)) Upload @else Avatar @endif</label>
                                </div>
                                <div class="small-9 columns">

                                    @if(is_null(Sentry::getUser()->avatar))

                                    <input class="upload" type="file" name="avatar">

                                    @else 

                                    <img class="round edit-avatar" src="{{ "/uploads/avatar/".Sentry::getUser()->avatar }}">  

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <button title="Delete Avatar" type="submit" class="is-delete-avatar"> <i class="fa fa-times"></i> Delete Avatar</a>
         

                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="small-12">
                            <div class="row">
                                <div class="small-3 columns">
                                 
                                </div>
                                <div class="small-9 columns">

                                    <a class="green-link" target="_blank" href="//gravatar.com">OR Change on Gravatar</a>
                                </div>

                            </div>
                        </div>

                @if(is_null(Sentry::getUser()->avatar))
                <div class="large-12 columns">
                    <button class="tiny right" type="submit">Change Avatar</button>
                </div>
                @endif

                </fieldset>
            
            </form>


            <form action="{{ route('post-edit-profile') }}" method="post" class="add profile-edit">

                <fieldset>
                    
                    <legend>Edit Profile</legend>

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />



                <div class="small-12">
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="about_me" class="right inline">About Me</label>
                        </div>
                        <div class="small-9 columns">
                            <select name="preference">
                                <option value="Web Designer" {{ ($user->preference == "Web Designer" ? "selected" : "" )}}>Web Designer</option>
                                <option value="Web Developer" {{ ($user->preference == "Web Developer" ? "selected" : "" )}}>Web Developer</option>
                                <option value="Undecided" {{ ($user->preference == "Undecided" ? "selected" : "" )}}>Undecided</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="small-12">
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="location" class="right inline">Location</label>
                        </div>
                        <div class="small-9 columns">
                            <input type="text" name="location" value="{{ $user->location }}">
                        </div>
                    </div>
                </div>

                <div class="small-12">
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="twitter_handle" class="right inline">Twitter Handle</label>
                        </div>
                        <div class="small-9 columns">
                            <div class="row collapse">
                                <div class="small-2 large-1 columns">
                                    <span class="prefix">@</span>
                                </div>
                                <div class="small-10 large-11 columns">
                                    <input  type="text" name="twitter_handle" value="{{ $user->twitter_handle }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="small-12">
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="website" class="right inline">Website</label>
                        </div>
                        <div class="small-9 columns">
                            <div class="row collapse">
                                <div class="small-4 large-2 columns">
                                    <span class="prefix">http://</span>
                                </div>
                                <div class="small-8 large-10 columns">
                                    <input type="text" name="website" value="{{ $user->website }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="small-12">
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="about_me" class="right inline">About Me</label>
                        </div>
                        <div class="small-9 columns">
                            <textarea type="text" rows="4" name="about_me">{{ $user->about_me }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="large-12 columns">
                    <button class="tiny right" type="submit">Edit Profile</button>
                </div>


                </fieldset>


            </form>

        </div>
    </div>

</div>

@stop