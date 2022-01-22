@php
    use App\Http\Controllers\ChatController as Chat;
@endphp

    @foreach ($users as $user)
    <div class="user-profy">
        @if ($user->image)
        <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';" class="img">
        @else
        <img src="{{ asset('images/resources/user-pic.png') }}" alt="{{ $user->name }}" class="img">

        @endif

         <h3>{{ $user->name }}</h3>

        <span>{{ $user->category_detail->category_name }}</span>
        <ul>
            @auth
            @if(App\follow_list::my_following($status='approve')->where('follow_to',$user->id)->exists())
                <li><a href="{{ route('user_profile',[$user->slug]) }}" title="Following" class="bg-success">Отпиаться</a></li>
            @elseif(App\follow_list::my_following($status='pending')->where('follow_to',$user->id)->exists())
                <li><a href="{{ route('user_profile',[$user->slug]) }}" title="Following" class="bg-danger text-light btn-sm">Отменить запрос</a></li>
            @else
                @if ($requested_id == $user->id)
                    <li><a href="{{ route('user_profile',[$user->slug]) }}" title="Following" class="bg-danger text-light btn-sm">Отменить запрос</a></li>
                @else
                    <li><a href="{{ route('user_profile',[$user->slug]) }}" title="Follow me" class="follow">Подписаться</a></li>
                @endif
            @endif

            @if (auth()->user()->role_type !== 'admin')
        <li><a href="{{ Chat::create_link(auth()->user()->role_type,$user->id) }}" target="_blank" title="chat" class="message-us"><i class="fa fa-envelope"></i></a></li>

        @endif

        @else

        <li><a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}" title="Follow me" class="follow">Подписаться</a></li>
        <li><a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>

        @endauth
        </ul>
        <a href="{{ route('user_profile',[$user->slug]) }}" title="" class="view-more-pro">Посмотреть профиль</a>

    </div><!--user-profy end-->
    @endforeach


