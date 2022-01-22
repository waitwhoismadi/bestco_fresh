@extends('layouts.authapp')

@section('content')
<div class="sign_in_sec current" id="tab-1">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf


                        <input type="hidden" name="token" value="{{ $token }}">


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

                            <div class="col-lg-12 no-pdd mb-3">
                                <div class="sn-field mb-0">
                                    <input type="password" name="password" placeholder="Password" class="{{ $errors->first('password')?'is_invaild':'' }}">

                                    <i class="la la-lock"></i>
                                </div>
                                @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="col-lg-12 no-pdd mb-3">
                                <div class="sn-field mb-0">
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="{{ $errors->first('password_confirmation')?'is_invaild':'' }}">

                                    <i class="la la-lock"></i>
                                </div>
                                @error('password_confirmation')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>


                        <div class="col-lg-12 no-pdd">
                            <button type="submit" value="submit">Reset Password</button>
                        </div>



                        </div>
                    </form>
                </div>

@endsection
