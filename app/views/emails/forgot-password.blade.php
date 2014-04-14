@extends('emails/layouts/default')

@section('content')
<p>Hey {{ $user->username }},</p>

<p>Please click on the following link to update your password:</p>

<p><a href="{{ $forgotPasswordUrl }}">{{ $forgotPasswordUrl }}</a></p>

<p>Best regards,</p>

<p>Webrepo.io Team</p>
@stop