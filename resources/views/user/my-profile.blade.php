
@extends('layouts.app')

@section('top_cover_sec')
    <section class="cover-sec">
        <img src="{{ asset('storage/'.auth()->user()->coverimages) }}" alt="{{ auth()->user()->name }}" id="coverimg" onerror="this.onerror=null;this.src='{{ asset('images/resources/cover-img.jpg') }}';">
        <div class="add-pic-box">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-12 col-sm-12">
                        <input type="file" id="coverimgupload">
                        <label id="coverimgbtn">Изменить изображение</label>
                        <label id="coverimgload" style="display: none">
                            Загрузка...
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
<div class="main-section" id="app">
    <div class="container">
        <div class="main-section-data">
            <div class="row">
                <div class="col-lg-3">

                    <x-user.my_profile_left-sidebar></x-user.my_profile_left-sidebar>
                </div>
                <div class="col-lg-6">
                    <div class="main-ws-sec" id="refresh">
                        <div class="user-tab-sec rewivew">
                            <h3>{{ auth()->user()->name }}</h3>
                            <div class="star-descp">
                                <span>{{ auth()->user()->category_detail->category_name }}</span>
                                <ul>
                                    @php
                                        $review_avg = number_format(App\Review::review_avg_byuser(auth()->user()->id));
                                    @endphp
                                    @for ($i = 0; $i < $review_avg; $i++)
                                        <li><i class="fa fa-star"></i></li>
                                    @endfor

                                    @for($i = 0; $i < 5-$review_avg; $i++)
                                    <li><i class="fa fa-star-o"></i></li>
                                    @endfor

                                </ul>
                                {{-- <a href="#" title="">Статус</a> --}}
                            </div><!--star-descp end-->
                                <div class="tab-feed st2 settingjb">
                                <ul>
                                    <li data-tab="feed-dd" class="active">
                                        <a href="#/" title="">
                                            <img src="{{ asset('images/ic1.png') }}" alt="">
                                            <span>Лента</span>
                                        </a>
                                    </li>
                                    <li data-tab="info-dd">
                                        <a href="#/" title="">
                                            <img src="{{ asset('images/ic2.png') }}" alt="">
                                            <span>Инфо</span>
                                        </a>
                                    </li>
                                    <li data-tab="saved-jobs">
                                        <a href="#/" title="">
                                            <img src="{{ asset('images/ic4.png') }}" alt="">
                                            <span>Вакансии</span>
                                        </a>
                                    </li>
                                    <li data-tab="my-bids">
                                        <a href="#/" title="">
                                            <img src="{{ asset('images/ic5.png') }}" alt="">
                                            <span>Ставки</span>
                                        </a>
                                    </li>
                                    <li data-tab="portfolio-dd">
                                        <a href="#/" title="">
                                            <img src="{{ asset('images/ic3.png') }}" alt="">
                                            <span>Порфтолио</span>
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
                        <div class="product-feed-tab" id="saved-jobs">
                            <x-my_jobs></x-my_jobs>
                        </div>
                        <div class="product-feed-tab current" id="feed-dd">
                            @php
                                $feeds = App\Feed::where('user_id',auth()->user()->id)
                                                ->orderby('id','desc')
                                                ->get();
                                $is_upload = '1';
                            @endphp
                            <livewire:frontend.feed :feeds="$feeds"/>
                        </div><!--product-feed-tab end-->

                        <div class="product-feed-tab" id="my-bids">
                            <x-my_projects></x-my_projects>

                        </div><!--product-feed-tab end-->

                        <div class="product-feed-tab" id="info-dd">
                            <livewire:frontend.userinfo.allinfo :user="auth()->user()"/>
                        </div><!--product-feed-tab end-->

                        <div class="product-feed-tab" id="portfolio-dd">

                            <livewire:frontend.portfolio.gallery :user="auth()->user()"/>

                        </div><!--portfolio-tab end-->

                        <div class="product-feed-tab" id="rewivewdata">

                            <livewire:frontend.review.review-list :user="auth()->user()"/>

                        </div><!--portfolio-tab end-->



                    </div><!--main-ws-sec end-->
                </div>
                <div class="col-lg-3">
                    <x-my_profile_right_sidebar></x-my_profile_right_sidebar>
                </div>
            </div>
        </div><!-- main-section-data end-->
    </div>
</div>


@yield('about-box')

@auth
    @include('my_profile_popup')

@endauth


<div class="post-popup cadidate_detail">
    <div class="post-project">
        <h3>О кандидате</h3>
        <div class="post-project-fields">

            <table class="table">

                <tbody>
                    <tr>
                        <th scope="row">Имя</th>
                        <td id="cadidate-name"></td>

                    </tr>
                    <tr>
                        <th scope="row">Почта</th>
                        <td id="cadidate-email"></td>
                    </tr>
                    <tr>
                        <th scope="row">Контакты</th>
                        <td id="cadidate-contact"></td>
                    </tr>
                    <tr>
                        <th scope="row">Опыт</th>
                        <td id="cadidate-experience"></td>
                    </tr>
                    <tr>
                        <th scope="row">Скачать CV</th>
                        <td id="cadidate-cv"><a class="btn btn-danger rounded" href="#/" role="button">Download</a></td>
                    </tr>

                </tbody>
            </table>
        </div><!--post-project-fields end-->
        <a href="#" title=""><i class="la la-times-circle-o"></i></a>
    </div><!--post-project end-->
</div><!-----applyjob_cadidate_detail---------->

<div class="post-popup candidate_list">
    <div class="post-project">
        <h3>Список кандидатов</h3>
        <div class="post-project-fields">

           <div class="py-3 border-bottom row" id="user">

           </div>
        </div><!--post-project-fields end-->
        <a href="#" title=""><i class="la la-times-circle-o"></i></a>
    </div><!--post-project end-->
</div><!-----applyjob_cadidate_list---------->

<div class="post-popup bidder_list">
    <div class="post-project">
        <h3>Bidder List</h3>
        <div class="post-project-fields">

           <div class="py-3 border-bottom row" id="bidders">

           </div>
        </div><!--post-project-fields end-->
        <a href="#" title=""><i class="la la-times-circle-o"></i></a>
    </div><!--post-project end-->
</div><!-----applyjob_cadidate_list---------->



</div>
@endsection


@section('my_profile_push')
@include('./push-myprofile')
@endsection
