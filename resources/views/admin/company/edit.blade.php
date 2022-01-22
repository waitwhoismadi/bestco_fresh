@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title">Update Company</h4>
              <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">

                <ul class="quick-links ml-auto">
                  <li><a href="{{ route('admin.company.index') }}"><button class="btn btn-primary">All Companies</button></a></li>
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
            <h4 class="card-title">Update Company</h4>

                <form action="{{ route('admin.company.update',[$company->id]) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="name">Company Name*</label>
                    <input type="text" name="company_name" id="name" class="form-control {{ $errors->has('company_name')?'is-invalid':'' }}" value="{{ old('company_name')??$company->company_name }}" placeholder="Company Name">
                    @if($errors->has('company_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_name') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">Company Email*</label>
                    <input type="email" name="company_email" id="email" class="form-control {{ $errors->has('company_email')?'is-invalid':'' }}" value="{{ old('company_email')??$company->email }}" placeholder="Company Email">
                    @if($errors->has('company_email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">Login Email*</label>
                    <input type="email" name="login_email" id="email" class="form-control {{ $errors->has('login_email')?'is-invalid':'' }}" value="{{ old('login_email')??$company->user->email }}" placeholder="Company Email">
                    @if($errors->has('login_email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('login_email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="phone">Contact No</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ old('phone')??$company->contact_no }}">

                </div>

                <div class="form-group">
                    <label for="industry">Industry</label>
                    <select name="industry_type" id="industry" class="form-control {{ $errors->has('industry_type')?'is-invalid':'' }}">
                    <option value="">Industry</option>
                    @php
                                $industries = App\industry_type::all();
                            @endphp
                            @foreach($industries as $key => $industry)
                            <option value="{{ $industry->id }}" {{ (old('industry_type')==$industry->id || $company->industry == $industry->id)?'selected':'' }}>{{ $industry->industry_name }}</option>
                            @endforeach

                    </select>
                    @if($errors->has('industry_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('industry_type') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" placeholder="Password">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password*</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">

                </div>

                <button type="submit" class="btn btn-success">Submit</button>
                </form>

          </div>
        </div>
      </div>
</div>
        <!---------------page Content end----------------->


@endsection
