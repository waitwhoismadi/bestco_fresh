@extends('layouts.app')

@section('content')

<section class="messages-page">
    <div class="container">
        <div class="messages-sec">

                <frontend_chat base_url="{{ url('/') }}" :auth_user="{{ auth()->user() }}" custom_user="{{ \Request::query('user') }}" custom_msg="{{ \Request::query('message') }}"></frontend_chat>
        </div><!--messages-sec end-->
    </div>
</section><!--messages-page end-->
@endsection
