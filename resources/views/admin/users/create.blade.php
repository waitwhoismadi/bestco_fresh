@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title">Add User</h4>
              <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">

                <ul class="quick-links ml-auto">
                  <li><a href="{{ route('admin.user.index') }}"><button class="btn btn-primary">All Users</button></a></li>
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
            <h4 class="card-title">Add New User</h4>

                <form action="{{ route('admin.user.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Name*</label>
                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name')?'is-invalid':'' }}" value="{{ old('name') }}" placeholder="Name">
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" value="{{ old('email') }}" placeholder="Email">
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">

                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control {{ $errors->has('category')?'is-invalid':'' }}">
                    <option value="">Category</option>
                    @php
                                $user_categories = App\user_categories::all();
                            @endphp
                            @foreach($user_categories as $key => $user_category)
                            <option value="{{ $user_category->id }}" {{ old('category')==$user_category->id?'selected':'' }}>{{ $user_category->category_name }}</option>
                            @endforeach

                    </select>
                    @if($errors->has('category'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category') }}
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

                <input type="hidden" name="terms_and_condition" value="true">

                <button type="submit" class="btn btn-success">Submit</button>
                </form>

          </div>
        </div>
      </div>
</div>
        <!---------------page Content end----------------->


@endsection
