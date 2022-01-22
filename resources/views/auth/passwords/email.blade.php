@extends('layouts.authapp')

@section('content')

<div class="sign_in_sec current" id="tab-1">

    <h3>Forget Password</h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row">
                            <div class="col-lg-12 no-pdd">
                                <div class="sn-field">
                                    <input type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                    <i class="la la-envelope"></i>

                                </div><!--sn-field end-->
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-12 no-pdd">
                                <button type="submit" value="submit">Send Password Reset Link</button>
                            </div>

                        </div>
                    </form>
                </div>

@endsection
