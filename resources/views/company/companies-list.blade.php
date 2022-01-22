@extends('layouts.app')

@section('content')

<section class="companies-info">
    <div class="container">

        <div class="company-title">
            <h3>Все компании</h3>
        </div><!--users-title end-->


        <div class="companies-list">

            <livewire:frontend.companies-list :companies="$companies">


        </div><!--companies-list end-->

        {{-- <div class="process-comm">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div> --}}
        <!--process-comm end-->
    </div>
</section><!--users-info end-->

@endsection
