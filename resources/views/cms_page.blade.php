@extends('layouts.app')


@section('top_cover_sec')
<section class="banner">
    <div class="bannerimage">
    <img src="{{ asset('images/about.png') }}" alt="image">
</div>
    <div class="bennertext">
    <div class="innertitle">
        <h2>{{ $page->page_title }}</h2>

    </div>
    </div>
    <span class="banner-title">{{ $page->page_title }}</span>
</section>
@endsection

@section('content')

<section class="Company-overview">
    <div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h2 class="pt-2">
                {{ $page->page_title }}
            </h2>
            <p>
                {!! $page->page_description !!}
            </p>
        </div>
        {{-- <div class="col-md-6 col-sm-12">
            <img src="images/about3.png" alt="image">
        </div> --}}
    </div>
</div>
</section>

@endsection
