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
                                        <h3>Ставки</h3>
                                        <br>
                                        <p>{{ $project->bids->count() }}</p>
                                    </li>
                                    <li>
                                        <h3>Средняя ставка($)</h3>
                                        <br>
                                        <p>{{ number_format($project->bids()->avg_bid($project->id)) }}</p>
                                    </li>
                                    <li>
                                        <h3>Бюджет проекта($)</h3>
                                        <br>
                                        <p>{{ number_format($project->min_price) }}{{ $project->payment_type=='hr'?'/ hr':'' }}</p>
                                    </li>
                                    <li>
                                        <h3>Просомтры</h3>
                                        <br>
                                        <p>{{ $project->view }}</p>
                                    </li>
                                </ul>
                                <div class="bids-time">
                                   <h3>Опубликовано : @if($project->created_at->diffInSeconds() < 60)
                                    {{ $project->created_at->diffInSeconds() }} Сек
                                @elseif($project->created_at->diffInMinutes() < 60)
                                {{ $project->created_at->diffInMinutes() }} Мин
                                @elseif($project->created_at->diffInHours() < 24)
                                {{ $project->created_at->diffInHours() }} Час
                                @elseif($project->created_at->diffInDays() < 31)
                                {{ $project->created_at->diffInDays() }} День
                                @elseif($project->created_at->diffInMonths() < 12)
                                {{ $project->created_at->diffInMonths() }} Мес
                                @else
                                {{ $project->created_at->diffInYears() }} Год
                                @endif
                                 назад</h3>
                                        <br>
                                        <p>{{ $project->is_active?'Open':'Close' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-ws-sec">
                        <div class="posts-section">

                            <livewire:frontend.feed-detail :feed='$project'>
                            <!--post-bar end-->
                        </div>
                        <!--posts-section end-->
                    </div>
                    <!--main-ws-sec end-->
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="right-sidebar">
                        @auth

                        @if (auth()->user()->role_type != 'user' && auth()->user()->id != $project->user_id)
                            <div class="widget widget-about bid-place">

                            @if(!auth()->user()->working_projects()->where('project_id',$project->id)->exists())
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applyjob" data-whatever="@mdo">Сделать ставку</button>
                            @else
                                <button type="button" class="btn btn-primary" disabled>Уже сделали ставку</button>
                            @endif
                        </div>
                        @endif


                        @endauth


                        <x-feed_detail_sidebar :feed="$project"></x-feed_detail_sidebar>

                        <!--widget-jobs end-->
                    </div>
                    <!--right-sidebar end-->
                </div>
            </div>
            <!-- freelancerbiding -->

            <x-projects.bidder_list :project="$project"></x-projects.bidder_list>

        </div>
    </div>
</div>



<!--------------------apply job modal------------------------>
@auth

@if (auth()->user()->role_type != 'user' && auth()->user()->id !== $project->user_id && !auth()->user()->working_projects()->where('project_id',$project->id)->exists())

<livewire:frontend.projects.place-bid :project='$project'/>

@endif

@endauth

@endsection

@push('scripts')
    <script>

$( document ).ready(function () {
    $('.comments_area{{ $project->id }}').show();
})
    </script>
@endpush
