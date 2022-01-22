@php
    $terms_condition_slug = App\Cms_pages::where('page_type','terms')->value('page_slug');
@endphp
@extends('layouts.authapp')

@section('content')
<div class="sign_in_sec current" id="tab-1">
    <div class="signup-tab">

        <ul>
            <li data-tab="tab-3" class="{{ session()->get('register_type')=='company'?'':'current' }}"><a href="#" title="">Пользователь</a></li>
            <li data-tab="tab-4" class="{{ session()->get('register_type')=='company'?'current':'' }}"><a href="#" title="">Компания</a></li>
        </ul>
    </div><!--signup-tab end-->
    <div class="dff-tab {{ session()->get('register_type')=='company'?'':'current' }}" id="tab-3">
        <form action="{{ route('register.user') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12 no-pdd mb-3">
                    <div class="sn-field mb-0">
                        <input type="text" name="name" placeholder="Полное имя" class="{{ $errors->first('name') ? 'is_invaild':'' }}" value="{{ old('name') }}" autofocus>

                        <i class="la la-user"></i>
                    </div>
                    @error('name')
                       <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-12 no-pdd mb-3">
                    <div class="sn-field mb-0">
                        <input type="email" name="email" placeholder="Почта" class="{{ $errors->first('email')?'is_invaild':'' }}" value="{{ old('email') }}">

                    <i class="la la-envelope"></i>
                    </div>
                    @error('email')
                      <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-lg-12 no-pdd mb-3">
                    <div class="sn-field mb-0">
                        <select name="category" class="{{ $errors->first('category')?'is_invaild':'' }}" value="{{ old('category') }}">
                            <option value="">Категоря</option>
                            @php
                                $user_categories = App\user_categories::all();
                            @endphp
                            @foreach($user_categories as $key => $user_category)
                            <option value="{{ $user_category->id }}">{{ $user_category->category_name }}</option>
                            @endforeach
                        </select>

                        <i class="la la-dropbox"></i>
                        <span><i class="fa fa-ellipsis-h"></i></span>
                    </div>
                    @error('category')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="col-lg-12 no-pdd mb-3">
                    <div class="sn-field mb-0">
                        <input type="password" name="password" placeholder="Пароль" class="{{ $errors->first('password')?'is_invaild':'' }}">

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
                        <input type="password" name="password_confirmation" placeholder="Подтвердите пароль" class="{{ $errors->first('password_confirmation')?'is_invaild':'' }}">

                        <i class="la la-lock"></i>
                    </div>
                    @error('password_confirmation')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="col-lg-12 no-pdd">
                    <div class="checky-sec st2">
                        <div class="fgt-sec">
                            <input type="checkbox" name="terms_and_condition" id="c2">
                            <label for="c2">
                                <span></span>
                            </label>
                            <small>Да, Я соглашаюсь и принимаю {{ config('web.name') }} <a href="{{ $terms_condition_slug?route('cms_page',[$terms_condition_slug]):'#/' }}">Условия и Положения</a>.</small>
                            @error('terms_and_condition')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!--fgt-sec end-->
                    </div>
                </div>
                <div class="col-lg-12 no-pdd">
                    <button type="submit" value="submit">Начать</button>
                </div>
            </div>
        </form>
    </div><!--dff-tab end-->
    <div class="dff-tab {{ session()->get('register_type')=='company'?'current':'' }}" id="tab-4">

        <form action="{{ route('register.company') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12 no-pdd mb-3">
                    <div class="sn-field mb-0">
                        <input type="text" name="company_name" placeholder="Название компании" class="{{ $errors->first('company_name')?'is-invalid':'' }}" value="{{ old('company_name') }}" autofocus>
                        <i class="la la-building"></i>
                    </div>
                    @error('company_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="col-lg-12 no-pdd mb-3">
                    <div class="sn-field mb-0">
                        <input type="email" name="company_email" placeholder="Почта" class="{{ $errors->first('company_email')?'is-invalid':'' }}" value="{{ old('company_email') }}">
                        <i class="la la-envelope"></i>
                    </div>
                    @error('company_email')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
                </div>
                <div class="col-lg-12 no-pdd mb-3">
                    <div class="sn-field mb-0">
                        <select name="industry_type" class="{{ $errors->first('industry_type')?'is_invaild':'' }}" value="{{ old('industry_type') }}">
                            <option value="">Тип отрасли</option>
                            @php
                                $industry_types = App\industry_type::all();
                            @endphp
                            @foreach($industry_types as $key => $industry_type)
                            <option value="{{ $industry_type->id }}">{{ $industry_type->industry_name }}</option>
                            @endforeach
                        </select>

                        <i class="la la-dropbox"></i>
                        <span><i class="fa fa-ellipsis-h"></i></span>
                    </div>
                    @error('industry_type')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="col-lg-12 no-pdd mb-3">
                    <div class="sn-field mb-0">
                        <input type="password" name="password" placeholder="Пароль" class="{{ $errors->first('password')?'is-invalid':'' }}">
                        <i class="la la-lock"></i>
                    </div>
                    @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
                </div>
                <div class="col-lg-12 no-pdd">
                    <div class="sn-field">
                        <input type="password" name="password_confirmation" placeholder="Подтвердите пароль">
                        <i class="la la-lock"></i>
                    </div>
                </div>
                <div class="col-lg-12 no-pdd">
                    <div class="checky-sec st2">
                        <div class="fgt-sec">
                            <input type="checkbox" name="terms_and_condition" id="c3">
                            <label for="c3">
                                <span></span>
                            </label>
                            <small>Да, Я соглашаюсь и принимаю {{ config('web.name') }} <a href="{{ $terms_condition_slug?route('cms_page',[$terms_condition_slug]):'#/' }}">Условия и Положения</a>.</small>
                            @error('terms_and_condition')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div><!--fgt-sec end-->
                    </div>
                </div>
                <div class="col-lg-12 no-pdd">
                    <button type="submit" value="submit">Начать</button>
                </div>
            </div>
        </form>
    </div><!--dff-tab end-->
</div>
@endsection
