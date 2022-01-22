@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title w-100">Mail Configuration</h4>
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

            <h1>Mail Smtp Setting</h1>

            <form action="{{ route('setting.mail.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label>Mail Host</label>
              <input type="text" name="mail_host" class="form-control {{ $errors->has('mail_host')?'is-invalid':'' }}" placeholder="Mail Host" value="{{ old('mail_host', $setting->mail_host??'') }}">
                @error('mail_host')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label>Mail Port</label>
                <input type="text" name="mail_port" class="form-control {{ $errors->has('mail_port')?'is-invalid':'' }}" placeholder="Mail Port" value="{{ old('mail_port', $setting->mail_port??'') }}">
                  @error('mail_port')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group">
                <label>Mail Encryption</label>
                <input type="text" name="mail_encryption" class="form-control {{ $errors->has('mail_encryption')?'is-invalid':'' }}" placeholder="Mail Encryption" value="{{ old('mail_encryption', $setting->mail_encryption??'') }}">
                  @error('mail_encryption')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group">
                <label>Mail Username</label>
                <input type="text" name="mail_username" class="form-control {{ $errors->has('mail_username')?'is-invalid':'' }}" placeholder="Mail Username" value="{{ old('mail_username', $setting->mail_username??'') }}">
                  @error('mail_username')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <label>Mail Password</label>
              <div class="input-group">

                <input type="password" name="mail_password" class="form-control {{ $errors->has('mail_password')?'is-invalid':'' }}" id="password-visibilty" placeholder="Mail Password" value="{{ old('mail_password', $setting->mail_password??'') }}">
                <div class="input-group-append">
                    <span class="input-group-text" id="password_show_hide"><i class="fa fa-eye"></i></span>
                  </div>
                @error('mail_password')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <fieldset>
                  <hr>
                  <label>From Mail</label>
              <div class="form-group">
                <label>Email Id</label>
                <input type="email" name="from_email" class="form-control {{ $errors->has('from_email')?'is-invalid':'' }}" placeholder="From Email" value="{{ old('from_email', $setting->from_email??'') }}">
                  @error('from_email')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group">
                <label>Name</label>
                <input type="name" name="from_name" class="form-control {{ $errors->has('from_name')?'is-invalid':'' }}" placeholder="From Name" value="{{ old('from_name', $setting->from_name??'') }}">
                  @error('from_name')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              </fieldset>

              <fieldset class="mb-4">
                <hr>
                <label>To Mail</label>
            <div class="form-group">
              <label>Email Id</label>
              <input type="email" name="to_email" class="form-control {{ $errors->has('to_email')?'is-invalid':'' }}" placeholder="To Email" value="{{ old('to_email', $setting->to_email??'') }}">
                @error('to_email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
              <label>Name</label>
              <input type="name" name="to_name" class="form-control {{ $errors->has('to_name')?'is-invalid':'' }}" placeholder="To Name" value="{{ old('to_name', $setting->to_name??'') }}">
                @error('to_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="float-right">

            <a href="javascript:void(0)" class="float-right test-mail">Send test mail..</a>
            <br>
                <span class="d-none test-mail-res"></span>
            </div>
            </fieldset>
              <button type="submit" class="btn btn-primary">Update</button>

            </form>


          </div>
        </div>
      </div>
</div>
        <!---------------page Content end----------------->


@endsection

@push('scripts')
    <script>

        $('.test-mail').click(function (e) {

            $('.test-mail-res').removeClass('d-none');
            $('.test-mail-res').html('');
            $('.test-mail-res').addClass('spinner-border');
            $.ajax({
                'url':'{{ url("api/send-test-mail") }}',
                'type':'get'
            })
            .done(function (data) {
                $('.test-mail-res').removeClass('spinner-border');
                if(data.status == 'success'){
                    $('.test-mail-res').addClass('text-success');
                }
                else{
                    $('.test-mail-res').addClass('text-danger');
                }
                notify_message(data.response,data.status)
                $('.test-mail-res').html(data.response);
            })
        })
    </script>
@endpush
