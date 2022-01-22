@extends('layouts.app')


@section('content')

<div class="main-section">
    <div class="container">
        <div class="main-section-data">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-12">
                    <div class="bids-detail">
                        <div class="row">
                            <div class="col-12 appliedjob">
                                <ul>
                                    <li>
                                        <h3>Претенденты</h3>
                                        <br>
                                        <p>{{ $job->candidate->count() }}</p>
                                    </li>
                                    <li>
                                        <h3>Тип работы</h3>
                                        <br>
                                        <p>{{ $job->job_types?$job->job_types->type:'' }}</p>
                                    </li>
                                    <li>
                                        <h3>Зарплата</h3>
                                        <br>
                                        <p>${{ number_format($job->min_price) }}</p>
                                    </li>
                                    <li>
                                        <h3>Просмотры</h3>
                                        <br>
                                        <p>{{ $job->view }}</p>
                                    </li>
                                </ul>
                                <div class="bids-time">
                                   <h3>Опубликовано : @if($job->created_at->diffInSeconds() < 60)
                                    {{ $job->created_at->diffInSeconds() }} Сек
                                @elseif($job->created_at->diffInMinutes() < 60)
                                {{ $job->created_at->diffInMinutes() }} Мин
                                @elseif($job->created_at->diffInHours() < 24)
                                {{ $job->created_at->diffInHours() }} Час
                                @elseif($job->created_at->diffInDays() < 31)
                                {{ $job->created_at->diffInDays() }} День
                                @elseif($job->created_at->diffInMonths() < 12)
                                {{ $job->created_at->diffInMonths() }} Мес
                                @else
                                {{ $job->created_at->diffInYears() }} Год
                                @endif
                                 назад</h3>
                                        <br>
                                        <p>{{ $job->is_active?'Open':'Close' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-ws-sec">
                        <div class="posts-section">

                            <livewire:frontend.feed-detail :feed='$job'>
                            <!--post-bar end-->
                        </div>
                        <!--posts-section end-->
                    </div>
                    <!--main-ws-sec end-->
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="right-sidebar">
                        @auth

                        @if ((auth()->user()->role_type != 'admin') && auth()->user()->id != $job->user_id)
                        <div class="widget widget-about bid-place">

                            @if(!auth()->user()->applying_jobs()->where('job_id',$job->id)->exists())
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mymodal" data-whatever="@mdo">Подать заявку</button>
                            @else
                                <button type="button" class="btn btn-primary" disabled>Работа с вашей заявкой</button>
                            @endif
                        </div>
                        @endif

                        @endauth


                        <x-feed_detail_sidebar :feed="$job"></x-feed_detail_sidebar>

                        <!--widget-jobs end-->
                    </div>
                    <!--right-sidebar end-->
                </div>
            </div>
            <!-- freelancerbiding -->
        </div>
    </div>
</div>



<!--------------------apply job modal------------------------>
@auth
@if ((auth()->user()->role_type != 'admin' && !auth()->user()->applying_jobs()->where('job_id',$job->id)->exists()) && auth()->user()->id != $job->user_id)

<livewire:frontend.jobs.apply-job :job='$job'/>

@endif
@endauth

@endsection

@push('scripts')
    <script>

$( document ).ready(function () {
    $('.comments_area{{ $job->id }}').show();
})
    </script>
@endpush
