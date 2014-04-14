@extends('emails/layouts/default')

@section('content')
<p>Hello {{ $user->first_name }},</p>

<p>Welcome to Webrepo! Please click on the following link to activate your account:</p>

<p><a href="{{ $activationUrl }}">{{ $activationUrl }}</a></p>

<p>See you soon,</p>

<p>Webrepo.io Team</p>
@stop