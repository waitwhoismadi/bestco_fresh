<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('web.name') }} admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="{{ config('web.icon') }}" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{--  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>  --}}


<script src="https://cdn.tiny.cloud/1/21w8b7nesyd28ezko85gfp8w4pbr34mt4voc3qcl3ni246b3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

@stack('styles')

  </head>
  <body>
    <div class="container-scroller">

        @include('admin.includes.nav')

        <div class="container-fluid page-body-wrapper">

            @include('admin.includes.sidebar')
            <div class="main-panel">
              <div class="content-wrapper">
                @yield('content')
              </div>
              <!-- content-wrapper ends -->

              @include('admin.includes.footer')
            </div>
            <!-- main-panel ends -->
          </div>
          <!-- page-body-wrapper ends -->

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->


    <script src="{{ asset('js/app.js') }}"></script>


    {{--  <script src="{{ asset('admin') }}/assets/vendors/js/vendor.bundle.base.js"></script>  --}}
    <script src="{{ asset('admin') }}/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('admin') }}/assets/js/shared/off-canvas.js"></script>
    <script src="{{ asset('admin') }}/assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('admin') }}/assets/js/demo_1/dashboard.js"></script>
    <!-- End custom js for this page-->



    <script src="{{ asset('vendor/notify.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('vendor') }}/DataTables/datatables.min.css"/>

    <script type="text/javascript" src="{{ asset('vendor') }}/DataTables/datatables.min.js"></script>

<script>
    $(document).ready(function() {
    $("#datatable").DataTable();
});
</script>


@if(session('flash_notification'))
<script>

    $.notify("<?= session('flash_notification')['msg']?>", "<?= session('flash_notification')['type']?>");
</script>
@endif

<script>

    function notify_message(msg,type){
        $.notify(msg, type);
    }
    function delete_record(form_id,record_id){
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $('#'+form_id+record_id).submit();
      }
    });
    }



</script>

@stack('scripts')

<style>
.container-fluid{
    padding-left: 0px;
    padding-right: 0px;
}
    </style>
  </body>
</html>
