@extends('layouts.authapp')

@section('content')

<div class="sign_in_sec current" id="tab-1">

    <h3>Войти</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row">
            <div class="col-lg-12 no-pdd">
                <div class="sn-field">
                    <input type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Почта">

                    <i class="la la-envelope"></i>

                </div><!--sn-field end-->
                @error('email')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-12 no-pdd">
                <div class="sn-field">
                    <input type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Пароль">

                    <i class="la la-lock"></i>

                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-lg-12 no-pdd">
                <div class="checky-sec">
                    <div class="fgt-sec">
                        <input type="checkbox" name="remember" id="c1" {{ old('remember') ? 'checked' : '' }}>
                        <label for="c1">
                            <span></span>
                        </label>
                        <small>Запомнить</small>
                    </div><!--fgt-sec end-->
                    <a href="{{ route('password.request') }}" title="">Забыли пароль?</a>
                </div>
            </div>
            <div class="col-lg-12 no-pdd">
                <button type="submit" value="submit">Войти</button>
            </div>
        </div>
    </form>
    {{--  <div class="login-resources">
        <h4>Войти через социальные сети</h4>
        <ul>
            @if (config('services.google.client_id'))
            <li><a href="#" title="" class="bg-danger"><i class="fa fa-google"></i>Google</a></li>
            @endif
            @if (config('services.facebook.client_id'))
            <li><a href="#" title="" class="fb"><i class="fa fa-facebook"></i>Facebook</a></li>
            @endif
            @if (config('services.github.client_id'))
            <li><a href="#" title="" class="bg-dark"><i class="fa fa-github"></i>Github</a></li>
            @endif
        </ul>
    </div>  --}}
    <!--login-resources end-->
</div><!--sign_in_sec end-->
@endsection
