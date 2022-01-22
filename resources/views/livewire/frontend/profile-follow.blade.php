<div>


    <ul class="flw-hr">

    @auth

        @if (auth()->user()->id != $user->id)

        @if(App\follow_list::my_following($status='approve')->where('follow_to',$user->id)->exists())
            <li>
                <a href="javascript:void(0)" title="Following" class="bg-success" wire:click="unfollow({{ $user->id }})">
                    <i class="la la-check"></i>Отписаться
                </a>
            </li>
        @elseif(App\follow_list::my_following($status='pending')->where('follow_to',$user->id)->exists())
            <li>
                <a href="javascript:void(0)" title="Following" class="bg-light text-dark"  wire:click="unfollow({{ $user->id }})">
                    <i class="fa fa-clock"></i>Отменить запрос
                </a>
            </li>
        @else
            {{--  @if ($requested_id == $user->id)
                <li><a href="javascript:void(0)" title="Following" class="bg-light text-dark"  wire:click="unfollow({{ $user->id }})">Отменить запрос</a></li>
            @elseif($cancel_id == $user->id)
                <li><a href="javascript:void(0)" title="Подпишитесь" class="follow" wire:click="follow({{ $user->id }})">Подписаться</a></li>
                @else
                <li><a href="javascript:void(0)" title="Подпишитесь" class="follow" wire:click="follow({{ $user->id }})">Подписаться</a></li>

                @endif  --}}
                <li><a href="javascript:void(0)" title="Подпишитесь" class="follow" wire:click="follow({{ $user->id }})">Подписаться</a></li>

        @endif


    @endif

    @endauth
    @php
        if(auth()->user()){
            $auth_userid = auth()->user()->id;
        }
        else{
            $auth_userid = 0;
        }
    @endphp


    </ul>



</div>
