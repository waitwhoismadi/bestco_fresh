@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title w-100">Create Page</h4>
              <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">

                <ul class="quick-links ml-auto">
                  <li><a href="{{ route('cms.index') }}"><button class="btn btn-primary">All pages</button></a></li>
                </ul>
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
            <h4 class="card-title">Create New Page</h4>

                <form action="{{ route('cms.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label >Page Type*</label>
                    <select class="form-control" name="page_type">
                        <option value="other" {{ old('page_type') == 'other'?'selected':'' }}>Other</option>
                        <option value="terms" {{ old('page_type') == 'terms'?'selected':'' }}>Terms & Condition</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Page Name*</label>
                    <input type="text" name="page_name" class="form-control {{ $errors->has('page_name')?'is-invalid':'' }}" value="{{ old('page_name') }}" placeholder="Page Name">
                    @if($errors->has('page_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('page_name') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Page Slug</label>
                    <input type="text" name="page_slug" class="form-control {{ $errors->has('page_slug')?'is-invalid':'' }}" value="{{ old('page_slug') }}" placeholder="Page Slug">
                    @if($errors->has('page_slug'))
                        <div class="invalid-feedback">
                            {{ $errors->first('page_slug') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Page Content</label>
                    <textarea name="page_content" id="tinymce" class="form-control {{ $errors->has('page_content')?'is-invalid':'' }}" placeholder="Page Content">{{ old('page_content') }}</textarea>
                    @if($errors->has('page_content'))
                        <div class="invalid-feedback">
                            {{ $errors->first('page_content') }}
                        </div>
                    @endif
                </div>

            <hr>

                <div class="form-group">
                    <label>Seo Title*</label>
                    <input type="text" name="seo_title" class="form-control {{ $errors->has('seo_title')?'is-invalid':'' }}" value="{{ old('seo_title') }}" placeholder="Seo Title">
                    @if($errors->has('seo_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('seo_title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Seo tags</label>
                    <input type="text" name="seo_tags" class="form-control {{ $errors->has('seo_tags')?'is-invalid':'' }}" value="{{ old('seo_tags') }}" placeholder="Seo Tags">

                </div>

                <div class="form-group">
                    <label>Seo Page Img*</label>
                    <input type="file" name="seo_img" class="form-control {{ $errors->has('seo_img')?'is-invalid':'' }}">
                    @if($errors->has('seo_img'))
                        <div class="invalid-feedback">
                            {{ $errors->first('seo_img') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Seo Description</label>
                    <textarea name="seo_description" class="form-control {{ $errors->has('seo_description')?'is-invalid':'' }}" placeholder="Seo Description">{{ old('seo_description') }}</textarea>
                    @if($errors->has('seo_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('seo_description') }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-success">Create</button>
                </form>

          </div>
        </div>
      </div>
</div>
        <!---------------page Content end----------------->


@endsection
