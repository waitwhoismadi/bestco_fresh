@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title">Categories</h4>
              <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">


              </div>
            </div>
          </div>

        </div>
        <!-- Page Title Header Ends-->


        <!---------------page Content----------------->

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card" id="app">

            <category_index base_url="{{ url('/') }}"></category_index>
      </div>
</div>
        <!---------------page Content end----------------->


@endsection


