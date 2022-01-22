@php
    use App\Http\Controllers\ChatController as Chat;
@endphp
<div>
    <div class="row">
        @foreach($companies as $key => $company)

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="company_profile_info">
                    <div class="company-up-info">
                        <img src="{{ asset('images/resources/cmp-icon.png') }}" alt="">
                        <h3>{{ $company->company_name }}</h3>
                        <h4>{{ $company->industry_detail->industry_name }}</h4>
                        <ul>
                            @auth
                                @if(App\follow_list::my_following($status='approve')->where('follow_to',$company->user->id)->exists())
                                <li><a href="javascript:void(0)" title="Following" class="bg-success" wire:click="unfollow({{ $company->user->id }})">Отписаться</a></li>
                            @elseif(App\follow_list::my_following($status='pending')->where('follow_to',$company->user->id)->exists())
                                <li><a href="javascript:void(0)" title="Following" class="bg-danger text-light btn-light" wire:click="unfollow({{ $company->user->id }})">Отменить запрос</a></li>
                            @else
                                @if ($requested_id == $company->user->id)
                                    <li><a href="javascript:void(0)" title="Following" class="bg-danger text-light btn-light" wire:click="unfollow({{ $company->user->id }})">Отменить запрос</a></li>
                                @else
                                    <li><a href="javascript:void(0)" title="Follow me" class="follow" wire:click="follow({{ $company->user->id }})">Подписаться</a></li>
                                @endif
                            @endif
                            @if (auth()->user()->role_type !== 'admin')
                            <li><a href="{{ Chat::create_link(auth()->user()->role_type,$company->user->id) }}" target="_blank" title="chat" class="message-us"><i class="fa fa-envelope"></i></a></li>

                            @endif

                            @else
                            <li><a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}" title="Follow me" class="follow">Подписаться</a></li>
                            <li><a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>

                            @endauth

                        </ul>
                    </div>
                    <a href="{{ route('company_profile', [$company->slug]) }}" title="" class="view-more-pro">Посмотреть профиль</a>
                </div><!--company_profile_info end-->
            </div>

        @endforeach
    </div>
</div>
