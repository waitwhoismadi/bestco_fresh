@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title w-100">SEO Setting</h4>
              <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">


              </div>
            </div>
          </div>

        </div>
        <!-- Page Title Header Ends-->


        <!---------------page Content----------------->

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body" id="app">


           <seo_form base_url="{{ url('') }}" :pages="{{ $pages }}"></seo_form>

          </div>
        </div>
      </div>
</div>
        <!---------------page Content end----------------->


@endsection


