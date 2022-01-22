@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title w-100">General Setting</h4>
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
          <div class="card-body">


            <form action="{{ route('setting.general.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label>Site Name</label>
              <input type="text" name="site_name" id="" class="form-control {{ $errors->has('site_name')?'is-invalid':'' }}" placeholder="Site Name" value="{{ old('site_name', $setting->site_name??'') }}">
                @error('site_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label>Site Title</label>
                <input type="text" name="site_title" id="" class="form-control {{ $errors->has('site_title')?'is-invalid':'' }}" placeholder="Site Title" value="{{ old('site_title', $setting->site_title??'') }}">
                  @error('site_title')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group">
                <label>Site Tagline</label>
                <input type="text" name="site_tagline" id="" class="form-control {{ $errors->has('site_tagline')?'is-invalid':'' }}" placeholder="Site Tagline" value="{{ old('site_tagline', $setting->site_tagline??'') }}">
                  @error('site_tagline')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group">
                <label>Site Logo</label>
                <input type="file" name="site_logo" id="" class="form-control {{ $errors->has('site_logo')?'is-invalid':'' }}" >
                  @error('site_logo')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group">
                <label>Site Icon</label>
                <input type="file" name="site_icon" id="" class="form-control {{ $errors->has('site_icon')?'is-invalid':'' }}" >
                  @error('site_icon')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <button type="submit" class="btn btn-primary">Update</button>

            </form>


          </div>
        </div>
      </div>
</div>
        <!---------------page Content end----------------->


@endsection


