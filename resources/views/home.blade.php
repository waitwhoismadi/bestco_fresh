@extends('layouts.app')

@section('content')

<div class="main-section">
    <div class="container">
        <div class="main-section-data">
            <div class="row">

                <!--main-left-sidebar end-->
                <div class="col-lg-3 col-md-4 pd-left-none no-pd">
                    <x-home_left_sidebar></x-home_left_sidebar>
                </div>

                <!--main-ws-sec end-->
                <div class="col-lg-6 col-md-8 no-pd">
                    @php
                        $feeds = App\Feed::where('is_active','1')
                                ->orderby('id','desc')
                                ->get();
                        $is_upload = '1';
                    @endphp
                    <livewire:frontend.feed :feeds="$feeds"/>


                    <livewire:frontend.add-feed/>
                </div>

                <!--right-sidebar end-->
                <div class="col-lg-3 pd-right-none no-pd">
                    <x-home_right_sidebar></x-home_right_sidebar>
                </div>


            </div>
        </div><!-- main-section-data end-->
    </div>
</div>
@endsection
