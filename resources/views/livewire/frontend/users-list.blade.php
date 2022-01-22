@php
    use App\Http\Controllers\ChatController as Chat;
@endphp
<div>
    <div class="row">

        @foreach($users as $key => $user)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="company_profile_info">
                    <div class="company-up-info">
                        @if ($user->image)
                        <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                        @else
                        <img src="{{ asset('images/resources/user-pic.png') }}" alt="{{ $user->name }}" >

                        @endif

                        <a href="{{ route('user_profile',[$user->slug]) }}">
                            <h3>{{ $user->name }}</h3>
                        </a>
                        <h4>{{ $user->category_detail->category_name }}</h4>

                            <ul>
                            @auth
                                @if(App\follow_list::my_following($status='approve')->where('follow_to',$user->id)->exists())
                                    <li><a href="javascript:void(0)" title="Following" class="bg-success" wire:click="unfollow({{ $user->id }})">Отписаться</a></li>
                                @elseif(App\follow_list::my_following($status='pending')->where('follow_to',$user->id)->exists())
                                    <li><a href="javascript:void(0)" title="Following" class="bg-danger text-light btn-sm" wire:click="unfollow({{ $user->id }})">Отменить запрос</a></li>
                                @else
                                    @if ($requested_id == $user->id)
                                        <li><a href="javascript:void(0)" title="Following" class="bg-danger text-light btn-sm" wire:click="unfollow({{ $user->id }})">Отменить запрос</a></li>
                                    @else
                                        <li><a href="javascript:void(0)" title="Follow me" class="follow" wire:click="follow({{ $user->id }})">Подписаться</a></li>
                                    @endif
                                @endif

                                @if (auth()->user()->role_type !== 'admin')
                            <li><a href="{{ Chat::create_link(auth()->user()->role_type,$user->id) }}" target="_blank" title="chat" class="message-us"><i class="fa fa-envelope"></i></a></li>

                            @endif

                            @else

                            <li><a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}" title="Follow me" class="follow">Подписаться</a></li>
                            <li><a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>

                            @endauth
                                {{-- <li><a href="{{ route('user_profile',[$user->slug]) }}" title="Hire" class="hire-us">Нанять</a></li> --}}
                            </ul>


                    </div>
                    <a href="{{ route('user_profile',[$user->slug]) }}" title="" class="view-more-pro">Посмотерть профиль</a>
                </div><!--company_profile_info end-->
            </div>
        @endforeach

    </div>
</div>
