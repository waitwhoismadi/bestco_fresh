<div>
   @foreach($users as $key => $user)
   @if ($requested_id != $user->id)

        <div class="suggestion-usd">
            @if ($user->image)
                        <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                        @else
                        <img src="{{ asset('images/resources/user-pic.png') }}" alt="{{ $user->name }}" >

                        @endif
                        <div class="sgt-text">
                <a href="{{ route('user_profile',[$user->slug]) }}">
                    <h4>{{ $user->name }}</h4>
                </a>
                <span>{{ $user->category_detail->category_name }}</span>
            </div>
            <span>
                @auth()

                    @if(App\follow_list::my_following($status='approve')->where('follow_to',$user->id)->exists())
                        <i class="la la-check"></i>
                    @elseif(App\follow_list::my_following($status='pending')->where('follow_to',$user->id)->exists())
                        <i class="fa fa-clock"></i>
                    @else
                        @if ($requested_id == $user->id)
                        <i class="fa fa-clock"></i>
                        @else
                        <i class="la la-plus" wire:click="follow({{ $user->id }})"></i>
                        @endif
                    @endif

                @else
                <a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}">
                    <i class="la la-plus"></i>
                </a>
                @endauth

            </span>
        </div>

    @endif

   @endforeach

   <div class="view-more">
    <a href="{{ route('users') }}" title="">больше</a>
</div>
</div>
