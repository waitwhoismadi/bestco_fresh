@php
    $get_page = App\Seo_pages_list::where('route_name',Route::currentRouteName())->first();


if($get_page){
    $seo_data = $get_page->seo;
    $user = $user??null;
    $job = $job??null;
    $project = $project??null;
    if($user != null){
        $page_name = $user->name;
    }
    elseif($job != null || $project != null){
        $page_name = $job?$job->title:$project->title;
    }
    else{
        $page_name = '';
    }

    if($seo_data){
    $seo = [
        'seo_title' => Str::replaceArray('{page_name}', [$page_name], $seo_data->seo_title),
        'seo_tags' => $seo_data->seo_tages,
        'seo_description' => Str::replaceArray('{page_name}', [$page_name], $seo_data->seo_description),
    ];
    }
}
@endphp
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{ $seo['seo_title']??config('web.title') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="{{ $seo['seo_description']??config('web.title') }}" />
    <meta name="keywords" content="{{ $seo['seo_tags']??config('web.title') }}" />
    <link rel="shortcut icon" href="{{ config('web.icon') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/line-awesome.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/line-awesome-font-awesome.min.css') }}">
	<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick-theme.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flatpickr.min.css') }}">


<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <livewire:styles>
@stack('styles')
</head>

<body>

<div class="wrapper" id="app">

@include('includes/header')

@yield('top_cover_sec')

<main>
@yield('content')

@auth
@include('includes.edit_feed')
@endauth

</main>

@include('includes.footer')
</div>


<livewire:scripts>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('lib/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/scrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flatpickr.min.js') }}"></script>



<script src="{{ asset('vendor/notify.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/datatables.min.css') }}"/>

    <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


    $(document).ready(function() {
    $("#datatable").DataTable();
});

$('.change-login_Status').click(function (e) {
    var status = $(this).data('status');
    console.log(status);
    $.ajax({
        url:"{{ url('/change-login-status') }}",
        type:"POST",
        data:{'status':status}
    })
    .done(function(response){
        console.log(response);
        if(response.status == 'success'){
            flash_notification(response.msg,'success');
            setTimeout(function() {
                location.reload(true);
                }, 1000);
        }
        else{
            flash_notification('Status Changed Failed!','error');
        }
    })
    .fail(function(status){
        flash_notification('Status Changed Failed!','error');
    })
})
</script>

@yield('my_profile_push')

@stack('scripts')

@if(session('flash_notification'))
<script>

    $.notify("<?= session('flash_notification')['msg']?>", "<?= session('flash_notification')['type']?>");
</script>

@endif
<script>

    function flash_notification(msg,type) {
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
    .then((isConfirm) => {
      if (isConfirm) {
        $('#'+form_id+record_id).submit();
      }
    });
    }

// ------------feed js-----------------

    $('.delete_feed').click(function (){
                var feed_id = $(this).data('feedid');
                var maindiv = $(this).data('maindiv');
                swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {

                    if (willDelete) {
                        $.ajax({
                            method:'DELETE',
                            url:'{{ url("/api") }}/delete_feed/'+feed_id
                        })
                        .done(function (data) {
                            $(maindiv+feed_id).hide();
                            flash_notification('Delete feed Successfully!','success');
                        })
                    }

                })
    })

    function edit_job(job) {


        $('#job_title').val(job.title);
        $( "#job_category option" ).each(function( index, option ) {

            if(option.value == job.category){

                $(this).attr('selected','selected');
            }
        })
        $('#job_skills').val(job.skills);
        $('#job_location').val(job.location);
        $('#job_salary').val(job.min_price);
        $( "#job_type option" ).each(function( index, option ) {

            if(option.value == job.job_type){

                $(this).attr('selected','selected');
            }
        })
        $('#job_description').html(job.description);

        $('#update_job').attr('data-update_jobid',job.id);
    }

    $('#update_job').submit( function(e){

        e.preventDefault();


        var job_title = $('#job_title').val();
        var job_category = $( "#job_category").val();
        var job_skills = $( "#job_skills").val();
        var job_location = $( "#job_location").val();
        var job_salary = $( "#job_salary").val();
        var job_type = $( "#job_type").val();
        var job_description = $( "#job_description").val();

        var job_id = $(this).data("update_jobid");

        $.ajax({
            url:'{{ url("api") }}/update_job/'+job_id,
            type:'PUT',
            data:
            {
                'job_title':job_title,
                'job_category':job_category,
                'job_skills':job_skills,
                'job_location':job_location,
                'job_salary':job_salary,
                'job_type':job_type,
                'job_description':job_description
            }
        })
        .done(function (data) {

            if(data.status == 'success'){

                flash_notification(data.response,'success');

                setTimeout(function() {
                location.reload(true);
                }, 1000);
            }
            else{

                var error = data.msg;

                if(error.job_title){
                $('.error.job_title').html(`
                <div class="text-danger">
                        `+error.job_title+`
                    </div>
                `);
                }

                if(error.job_category){
                $('.error.job_category').html(`
                <div class="text-danger">
                        `+error.job_category+`
                    </div>
                `);
                }

                if(error.job_location){
                $('.error.job_location').html(`
                <div class="text-danger">
                        `+error.job_location+`
                    </div>
                `);
                }
                if(error.job_description){
                    $('.error.job_description').html(`
                    <div class="text-danger">
                            `+error.job_description+`
                        </div>
                    `);
                    }
                flash_notification(data.response,'error');
            }
        })


    })

    function edit_project(project) {

        console.log(project);
        $('#project_title').val(project.title);
        $("#project_category option" ).each(function( index, option ) {

            console.log(option.value)
            if(option.value == project.category){
                console.log(option)

                $(this).attr('selected','selected');
            }
        })
        $('#project_skills').val(project.skills);
        $('#project_budget').val(project.min_price);
        $("#payment_type option" ).each(function( option ) {

            if(option.value == project.payment_type){

                $(this).attr('selected','selected');
            }
        })
        $('#project_description').html(project.description);

        $('#update_project').attr('data-update_projectid',project.id);

}

        $('#update_project').submit( function(e){

            e.preventDefault();


            var project_title = $('#project_title').val();
            var project_category = $( "#project_category").val();
            var project_skills = $( "#project_skills").val();
            var project_budget = $( "#project_budget").val();
            var payment_type = $( "#payment_type").val();
            var project_description = $( "#project_description").val();

            var job_id = $(this).data("update_projectid");

            $.ajax({
                url:'{{ url("api") }}/update_project/'+job_id,
                type:'PUT',
                data:
                {
                    'project_title':project_title,
                    'project_category':project_category,
                    'project_skills':project_skills,
                    'project_budget':project_budget,
                    'payment_type':payment_type,
                    'project_description':project_description
                }
            })
            .done(function (data) {
                console.log(data);
                if(data.status == 'success'){

                    flash_notification(data.response,'success');

                    setTimeout(function() {
                    location.reload(true);
                    }, 1000);
                }
                else{

                    var error = data.msg;

                    if(error.project_title){
                    $('.error.project_title').html(`
                    <div class="text-danger">
                            `+error.project_budget+`
                        </div>
                    `);
                    }

                    if(error.project_category){
                    $('.error.job_category').html(`
                    <div class="text-danger">
                            `+error.project_budget+`
                        </div>
                    `);
                    }

                    if(error.project_budget){
                    $('.error.project_budget').html(`
                    <div class="text-danger">
                            `+error.project_budget+`
                        </div>
                    `);
                    }

                    if(error.project_description){
                    $('.error.project_description').html(`
                    <div class="text-danger">
                            `+error.project_description+`
                        </div>
                    `);
                    }
                    flash_notification(data.response,'error');
                }
            })


})
    //----------------projects js--------------------

    function get_bidders_list(project_id) {
            var tdata;
                   return $.ajax({
                        method:'GET',
                        url:'{{ url("/api") }}/project_bidders/'+project_id,
                        async:false
                    })
                    .done(function (data) {
                        tdata = data;
                        return(tdata);
                    })

    }

</script>

<script>
    window.livewire.on('flash_notification', (msg,type) => {
        $.notify(msg, type);
        $('#post-projects a').click();
        $('.close-box').click();
    });



    tinymce.init({
    selector: '#tinymce',

  });
    </script>
</body>
</html>
