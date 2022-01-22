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
	<link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick-theme.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
</head>


<body class="sign-in">


<div class="wrapper">

<div class="sign-in-page">
    <div class="signin-popup">
        <div class="signin-pop">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cmp-info">
                        <div class="cm-logo">
                        <img src="{{ config('web.logo') }}" alt="">
                        {{--  <p>BestCo – социальная сеть для поиска, проверки и найма стажеров и соискателей</p>  --}}
                        </div><!--cm-logo end-->
                    <img src="{{ asset('images/cm-main-img.png') }}" alt="">
                    </div><!--cmp-info end-->
                </div>
            <div class="col-lg-6">
                <div class="login-sec">
                    <ul class="sign-control-custom">
                    <li class="{{ Route::is('login')?'current':'' }}"><a href="{{ route('login') }}">Войти</a></li>
                    <li class="{{ Route::is('register')?'current':'' }}"><a href="{{ route('register') }}">Зарегистрироваться</a></li>
                    </ul>

                    <!------------content ---------------->

                    @yield('content')



                </div><!--login-sec end-->
            </div>
            </div>
        </div><!--signin-pop end-->
    </div><!--signin-popup end-->

    <!---------footer------------------------>
<div class="footy-sec">
    <div class="container">
        <ul>
            @foreach (App\Cms_pages::limit(8)->get() as $cms)
            <li><a href="{{ route('cms_page', [$cms->page_slug]) }}" title="{{ $cms->page_title }}">{{ $cms->page_title }}</a></li>
            @endforeach
        </ul>
    <p><img src="asset('images/copy-icon.png')" alt="">Copyright {{ date('Y') }}</p>
    </div>
</div><!--footy-sec end-->
</div><!--sign-in-page end-->


</div><!--theme-layout end-->



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
