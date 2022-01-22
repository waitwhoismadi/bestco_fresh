@extends('layouts.app')

@section('top_cover_sec')
<section class="cover-sec">
    <img src="{{ asset('storage/'.$user->coverimages) }}" alt="{{ $user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cover-img.jpg') }}';">
</section>
@endsection
@section('content')

<div class="main-section">
    <div class="container">
        <div class="main-section-data">
            <div class="row">
                <div class="col-lg-3">
                    <div class="main-left-sidebar">
                        <div class="user_profile">
                            <div class="user-pro-img">
                                @if ($user->role_type == 'company')
                                <img src="{{ asset('storage/'.$user->company->logo) }}" alt="{{ $user->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
                            @else
                                <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                            @endif
                            </div><!--user-pro-img end-->
                            <div class="user_pro_status">
                                <livewire:frontend.profile-follow :user="$user">
                                <ul class="flw-status">
                                    <li>
                                        <span>Подписки</span>
                                        <b>{{ App\follow_list::following_byuser($user->id)->count() }}</b>
                                    </li>
                                    <li>
                                        <span>Подписчики</span>
                                        <b>{{ App\follow_list::follower_byuser($user->id)->count() }}</b>
                                    </li>
                                </ul>
                            </div><!--user_pro_status end-->

                            <livewire:frontend.social-links :user='$user'>

                        </div><!--user_profile end-->
                        <div class="suggestions full-width">
                           <livewire:frontend.suggest-users>
                        </div><!--suggestions end-->
                    </div><!--main-left-sidebar end-->
                </div>
                <div class="col-lg-6">
                    <div class="main-ws-sec">
                        <div class="user-tab-sec">
                            <h3>{{ ($user->role_type == 'user')?$user->name:$user->company->company_name }}</h3>
                            <div class="star-descp">
                                <span>{{ ($user->role_type == 'user')?$user->category_detail->category_name:$user->company->industry_detail->industry_name }}</span>
                                <ul>


                                    @php
                                        $review_avg = number_format(App\Review::review_avg_byuser($user->id));
                                    @endphp
                                    @for ($i = 0; $i < $review_avg; $i++)
                                        <li><i class="fa fa-star"></i></li>
                                    @endfor

                                    @for($i = 0; $i < 5-$review_avg; $i++)
                                    <li><i class="fa fa-star-o"></i></li>
                                    @endfor
                                </ul>
                            </div><!--star-descp end-->
                            <div class="tab-feed">
                                <ul>
                                    <li data-tab="feed-dd" class="active">
                                        <a href="#" title="">
                                            <img src="{{ asset('images/ic1.png') }}" alt="">
                                            <span>Лента</span>
                                        </a>
                                    </li>
                                    <li data-tab="info-dd">
                                        <a href="#" title="">
                                            <img src="{{ asset('images/ic2.png') }}" alt="">
                                            <span>Инфо</span>
                                        </a>
                                    </li>
                                    <li data-tab="portfolio-dd">
                                        <a href="#" title="">
                                            <img src="{{ asset('images/ic3.png') }}" alt="">
                                            <span>Портфолио</span>
                                        </a>
                                    </li>
                                    <li data-tab="rewivewdata">
                                        <a href="#/" title="">
                                            <img src="{{ asset('images/review.png') }}" alt="">
                                            <span>Отзывы</span>
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- tab-feed end-->
                        </div><!--user-tab-sec end-->
                        <div class="product-feed-tab current" id="feed-dd">
                            @php
                                $feeds=App\Feed::where('user_id',$user->id)
                                                ->where('is_active','1')
                                                ->orderby('id','desc')
                                                ->get();
                            @endphp
                            <livewire:frontend.feed :feeds='$feeds'>
                        </div><!--product-feed-tab end-->
                        <div class="product-feed-tab" id="info-dd">

                            <livewire:frontend.userinfo.allinfo :user='$user'>
                        </div><!--product-feed-tab end-->
                        <div class="product-feed-tab" id="portfolio-dd">
                            <livewire:frontend.portfolio.gallery :user='$user'>
                        </div><!--product-feed-tab end-->

                        <div class="product-feed-tab" id="rewivewdata">

                            <livewire:frontend.review.review-list :user="$user"/>

                        </div><!--portfolio-tab end-->
                    </div><!--main-ws-sec end-->
                </div>
                <div class="col-lg-3">


                    <x-profile_right_sidebar :user="$user"></x-profile_right_sidebar>
                </div>
            </div>
        </div><!-- main-section-data end-->
    </div>
</div>

@if ($user->role_type == 'user')
    <livewire:frontend.hire-user :user="$user">
@endif

@auth
    @include('my_profile_popup')

@endauth

@endsection
