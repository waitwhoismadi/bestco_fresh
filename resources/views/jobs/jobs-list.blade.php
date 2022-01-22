@extends('layouts.app')


@section('content')

<div class="main-section">
    <div class="container">
        <div class="main-section-data">
            <div class="row">

                <!--------------jobs leftbar------------>

                <div class="col-lg-3">
                    <x-jobs.filter_sidebar :minprice="$min_price" :maxprice="$max_price"></x-jobs.filter_sidebar>
                </div>

                <!--------------jobs list content------------>

                <div class="col-lg-6">
                    <livewire:frontend.feed :feeds='$jobs'/>
                </div>

                <!--------------jobs right sidebar------------>

                <div class="col-lg-3">
                    <x-home_right_sidebar></x-home_right_sidebar>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.range.css') }}">
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.range-min.js') }}"></script>

<script>
    $(window).on("load", function(){
		$('.rn-slider').jRange({
    с: {{ $min_price?$min_price:1000 }},
    до: {{ $max_price?$max_price:10000 }},
    step: 1,
    scale: [],
    format: '%s',
    width: 300,
    showLabels: true,
    isRange : true
});

})
</script>
@endpush
