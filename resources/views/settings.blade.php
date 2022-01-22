@extends('layouts.app')

@section('content')

@php
    if (Request::query('page') != 'account' && Request::query('page') != 'status' && Request::query('page') != 'change-password' && Request::query('page') != 'notification' && Request::query('page') != 'request') {
        $default = 'show active';
        $default_nav = 'active';

    }
    else{
        $default = '';
        $default_nav = '';
    }
@endphp

<section class="profile-account-setting">
    <div class="container">
        <div class="account-tabs-setting">
            <div class="row">
                <div class="col-lg-3">
                    <div class="acc-leftbar">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link {{ (Request::query('page') == 'account')?'active':'' }} {{ $default_nav }}" id="nav-acc-tab" data-toggle="tab" href="#nav-acc" role="tab" aria-controls="nav-acc" aria-selected="true"><i class="la la-cogs"></i>Настройка учетной записи</a>
                            <a class="nav-item nav-link {{ (Request::query('page') == 'status')?'active':'' }}" id="nav-status-tab" data-toggle="tab" href="#nav-status" role="tab" aria-controls="nav-status" aria-selected="false"><i class="fa fa-line-chart"></i>Статус</a>
                            <a class="nav-item nav-link {{ (Request::query('page') == 'change-password')?'active':'' }}" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false"><i class="fa fa-lock"></i>Изменить пароль</a>
                            <a class="nav-item nav-link {{ (Request::query('page') == 'notification')?'active':'' }}" id="nav-notification-tab" data-toggle="tab" href="#nav-notification" role="tab" aria-controls="nav-notification" aria-selected="false"><i class="fa fa-flash"></i>Уведомления</a>
                            <a class="nav-item nav-link {{ (Request::query('page') == 'request')?'active':'' }}" id="nav-privcy-tab" data-toggle="tab" href="#privcy" role="tab" aria-controls="privacy" aria-selected="false"><i class="fa fa-group"></i>Запросы</a>

                          </div>
                    </div><!--acc-leftbar end-->
                </div>
                <div class="col-lg-9">

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{ (Request::query('page') == 'account')?'show active':'' }} {{ $default }}" id="nav-acc" role="tabpanel" aria-labelledby="nav-acc-tab">

                            <x-setting.account_setting :user="auth()->user()"></x-setting.account_setting>
                        </div>
                          <div class="tab-pane fade {{ (Request::query('page') == 'status')?'show active':'' }}" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">

                            <x-setting.profile_performance :user="auth()->user()"></x-setting.profile_performance>


                          </div>
                          <div class="tab-pane fade {{ (Request::query('page') == 'change-password')?'show active':'' }}" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">

                                <x-setting.change_password></x-setting.change_password>

                          </div>
                          <div class="tab-pane fade {{ (Request::query('page') == 'notification')?'show active':'' }}" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">

                              <x-setting.notifications_list></x-setting.notifications_list>
                          </div>


                          <div class="tab-pane fade {{ (Request::query('page') == 'request')?'show active':'' }}" id="privcy" role="tabpanel" aria-labelledby="nav-privcy-tab">
                                <livewire:frontend.setting.accept-request>
                          </div>


                    </div>
                </div>
            </div>
        </div><!--account-tabs-setting end-->
    </div>
</section>
@endsection
