<header>
    <div class="container">
        <div class="header-data">
            <div class="logo">
                <a href="{{ route('home') }}" title=""><img src="{{ config('web.icon') }}" alt=""></a>
            </div><!--logo end-->
            <div class="search-bar">
                <form method="GET" action="{{ route('jobs_list') }}">
                    <input type="text" name="keyword" placeholder="Поиск вакансии...">
                    <button type="submit"><i class="la la-search"></i></button>
                </form>
            </div><!--search-bar end-->
            <nav>
                <ul>
                    <li>
                        <a href="{{ route('home') }}" title="Home">
                            <span><img src="{{ asset('images/icon1.png') }}" alt=""></span>
                            Главная
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('companies') }}" title="Companies">
                            <span><img src="{{ asset('images/icon2.png') }}" alt=""></span>
                            Компании
                        </a>
                        {{--  <ul>
                            <li><a href="companies.html" title="">Компании</a></li>
                            <li><a href="company-profile.html" title="">Профиль компании</a></li>
                        </ul>  --}}
                    </li>
                    <li>
                        <a href="{{ route('projects_list') }}" title="Projects">
                            <span><img src="{{ asset('images/icon3.png') }}" alt=""></span>
                            Проекты
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users') }}" title="Users">
                            <span><img src="{{ asset('images/icon4.png') }}" alt=""></span>
                            Пользователи
                        </a>
                        {{--  <ul>
                            <li><a href="user-profile.html" title="">Профиль пользователя</a></li>
                            <li><a href="my-profile-feed.html" title="">my-profile-feed</a></li>
                        </ul>  --}}
                    </li>
                    <li>
                        <a href="{{ route('jobs_list') }}" title="Jobs">
                            <span><img src="{{ asset('images/icon5.png') }}" alt=""></span>
                            Вакансии
                        </a>
                    </li>

                    @auth
                    @if(auth()->user()->role_type != 'admin')
                    <li>
                        <a href="#" title="" class="not-box-open">
                            <span><img src="{{ asset('images/icon6.png') }}" alt=""></span>
                            Сообщения
                        </a>
                        <div class="notification-box noti" id="notification">
                            <div class="nt-title">
                                <h4>Сообщения</h4>
                                {{-- <a href="{{ route('unread-notification') }}" title="">Очистить все</a> --}}
                            </div>
                            <div class="nott-list" >

                                <notifications_header base_url="{{ url('/') }}" :notifications="{{ auth()->user()->unreadNotifications()->where('type','App\Notifications\Send_msg')->take(5)->get() }}" :user="{{ auth()->user() }}"></notifications_header>


                            </div><!--nott-list end-->

                        </div><!--notification-box end-->
                    </li>

                    <li>
                        <a href="#" title="" class="not-box-open">
                            <span><img src="{{ asset('images/icon7.png') }}" alt=""></span>
                            Уведомления
                        </a>
                        <div class="notification-box noti" id="notification">
                            <div class="nt-title">
                                <h4>Уведомления</h4>
                                <a href="{{ route('unread-notification') }}" title="">Очистить все</a>
                            </div>
                            <div class="nott-list" >

                                <notifications_header base_url="{{ url('/') }}" :notifications="{{ auth()->user()->unreadNotifications()->where('type','!=','App\Notifications\Send_msg')->take(5)->get() }}" :user="{{ auth()->user() }}"></notifications_header>


                            </div><!--nott-list end-->
                            <div class="view-all-nots">
                                @if(auth()->user()->role_type == 'user')
                                <a href="{{ route('user_dashboard.setting',['page'=>'notification']) }}" title="">Посмотреть все уведомления</a>
                            @else
                                <a href="{{ route('company_dashboard.setting',['page'=>'notification']) }}" title="">Посмотреть все уведомления</a>

                            @endif

                              </div>
                        </div><!--notification-box end-->
                    </li>
                    @endif
                    @endauth

                </ul>
            </nav><!--nav end-->
            <div class="menu-btn">
                <a href="#/" title=""><i class="fa fa-bars"></i></a>
            </div><!--menu-btn end-->
            <div class="user-account">
                <div class="user-info">
                    @if (auth()->user())

                    @if (auth()->user()->role_type == 'company')
                        <img src="{{ asset('storage/'.auth()->user()->company->logo) }}" alt="{{ auth()->user()->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
                    @else
                        <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                    @endif

                     @endif
                    <a href="#/" title="">{{ auth()->user()?auth()->user()->name:'Guest' }}</a>
                    <i class="la la-sort-down"></i>
                </div>
                <div class="user-account-settingss" id="users">
                    @auth()

                    <h3>Статус онлайна</h3>
                    <ul class="on-off-status">
                        <li>
                            <div class="fgt-sec">
                                <input type="radio" name="cc" id="c5" class="change-login_Status" data-status="online" {{ Cache::has('user-is-online-' . auth()->user()->id)?'checked':'' }}>
                                <label for="c5">
                                    <span></span>
                                </label>
                                <small>Онлайн</small>
                            </div>
                        </li>
                        <li>
                            <div class="fgt-sec">
                                <input type="radio" name="cc" id="c6" class="change-login_Status" data-status="offline" {{ Cache::has('user-is-online-' . auth()->user()->id)?'':'checked' }}>
                                <label for="c6">
                                    <span></span>
                                </label>
                                <small>Офлайн</small>
                            </div>
                        </li>
                    </ul>
                    {{-- <h3>Свой статус</h3> --}}

                    <h3>{{ auth()->user()->name }}</h3>
                    <div class="search_form">
                        <form method="GET" action="{{ route('users') }}">
                            <input type="text" name="keyword" placeholder="Search freelancer">
                            <button type="submit">Ок</button>
                        </form>
                    </div><!--search_form end-->
                    <ul class="us-links">
                        <li>
                            @if(auth()->user()->role_type == 'user')
                    <a href="{{ route('user_dashboard.profile') }}" title="User Dashboard">Посмотреть профиль</a>
                    @elseif(auth()->user()->role_type == 'company')
                    <a href="{{ route('company_dashboard.profile') }}" title="Company Dashboard">Посмотреть профиль</a>
                    @else
                    <a href="{{ route('admin.home')}}" title="Admin Dashboard">Панель админа</a>
                    @endif
                        </li>
                        <li>
                    @if (auth()->user()->role_type !== 'admin')
                    <a href="{{ route(auth()->user()->role_type.'_dashboard.chat') }}" title="Chat">Чат</a>
                    @endif
                        </li>
                        <li>
                            @if(auth()->user()->role_type == 'user')
                            <a href="{{ route('user_dashboard.setting') }}" title="">Настройки учетной записи</a>
                        @elseif(auth()->user()->role_type == 'company')
                            <a href="{{ route('company_dashboard.setting') }}" title="">Настройки учетной записи</a>
                        @else
                        <a href="{{ route('setting.general') }}" title="">Настройки</a>
                        @endif
                        </li>
                        <li><a href="{{ route('cms_page', 'privacy') }}" title="">Приватность</a></li>
                        <li><a href="{{ route('cms_page', 'faqs') }}" title="">Часто задаваемые вопросы</a></li>
                        @if (App\Cms_pages::where('page_type','terms')->value('page_slug'))
                        <li><a href="{{ route('cms_page', [App\Cms_pages::where('page_type','terms')->value('page_slug')]) }}" title="">Правила и условия</a></li>
                        @endif
                    </ul>
                    <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <h3 class="tc"><a href="#/" onclick="document.getElementById('formLogOut').submit();" title="">Выйти</a></h3>
                    @endauth

                    @guest
                        <div class="py-4 px-2">
                            <a href="{{ route('login') }}"><button class="btn btn-outline-danger text-uppercase w-100 font-weight-bold">Войти</button></a>
                        </div>
                        <h3>Нет аккаунта</h3>
                        <div class="py-4 px-2">
                            <a href="{{ route('register') }}"><button class="btn btn-outline-danger text-uppercase w-100 font-weight-bold">Зарегистрироваться</button></a>
                        </div>
                    @endguest
                </div><!--user-account-settingss end-->
            </div>
        </div><!--header-data end-->
    </div>
</header><!--header end-->
