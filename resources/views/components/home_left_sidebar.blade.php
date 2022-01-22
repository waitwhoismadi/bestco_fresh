<div>
    <div class="main-left-sidebar no-margin">

        <!--user-data-->
        <div class="user-data full-width">
            @auth
            <div class="user-profile">
                <div class="username-dt">
                    <div class="usr-pic">
                        @if (auth()->user()->role_type == 'company')
                            <img src="{{ asset('storage/'.auth()->user()->company->logo) }}" alt="{{ auth()->user()->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
                        @else
                            <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                        @endif
                    </div>
                </div><!--username-dt end-->
                <div class="user-specs">
                    <h3>{{ auth()->user()->name }}</h3>
                    @if(auth()->user()->role_type == 'company')
                    <span>{{ auth()->user()->company->industry_detail->industry_name }}</span>
                    @elseif(auth()->user()->role_type == 'user')
                    <span>{{ auth()->user()->category_detail->category_name }} самозанятый</span>
                    @endif
                </div>
            </div><!--user-profile end-->
            <ul class="user-fw-status">
                <li>
                    <h4>Подписки</h4>
                    <span>{{ App\follow_list::my_following()->count() }}</span>
                </li>
                <li>
                    <h4>Подписчики</h4>
                    <span>{{ App\follow_list::my_follower()->count() }}</span>
                </li>
                <li>
                    @if(auth()->user()->role_type == 'user')
                    <a href="{{ route('user_dashboard.profile')}}" title="User Dashboard">Посмотреть профиль</a>
                    @elseif(auth()->user()->role_type == 'company')
                    <a href="{{ route('company_dashboard.profile')}}" title="Company Dashboard">Посмотреть профиль</a>
                    @else
                    <a href="{{ route('admin.home')}}" title="Admin Dashboard">Панель админа</a>
                    @endif
                </li>
            </ul>
            @endauth
            @guest
            <div class="py-4 px-4">
                <a href="{{ route('login') }}"><button class="btn btn-outline-danger text-uppercase w-100 font-weight-bold">Войти</button></a>
            </div>
            <h3>Нет аккаунта</h3>
            <div class="py-4 px-4">
                <a href="{{ route('register') }}"><button class="btn btn-outline-danger text-uppercase w-100 font-weight-bold">Зарегистрироваться</button></a>
            </div>
            @endguest
        </div><!--user-data end-->

        <!--suggestions-->
        <div class="suggestions full-width">
            <x-suggestions_section></x-suggestions_section>
            <livewire:frontend.suggest-users />
        </div><!--suggestions end-->

    </div><!--main-left-sidebar end-->
</div>
