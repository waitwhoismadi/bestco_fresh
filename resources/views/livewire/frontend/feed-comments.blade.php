<div>
    <div class="comment-section">

<div class="comment-sec">
            <ul>
                @foreach ($comments as $comment)
                <li>
                    <div class="comment-list">
                        <div class="bg-img">
                            @if ($comment->user->role_type == 'company')
                                <img src="{{ asset('storage/'.$comment->user->company->logo) }}" alt="{{ $comment->user->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
                            @else
                                <img src="{{ asset('storage/'.$comment->user->image) }}" alt="{{ $comment->user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                            @endif
                        </div>
                        <div class="comment">
                            @if($comment->user->role_type == 'company')
                                <a href="{{ route('company_profile',$comment->user->company->slug) }}">
                                    <h3>{{ $comment->user->company->company_name }}</h3>
                                </a>
                            @else
                                <a href="{{ route('user_profile',$comment->user->slug) }}">
                                    <h3>{{ $comment->user->name }}</h3>
                                </a>
                            @endif
                            <span><img src="images/clock.png" alt="">
                                @if($comment->created_at->diffInSeconds() < 60)
                                {{ $comment->created_at->diffInSeconds() }} Сек
                            @elseif($comment->created_at->diffInMinutes() < 60)
                            {{ $comment->created_at->diffInMinutes() }} Мин
                            @elseif($comment->created_at->diffInHours() < 24)
                            {{ $comment->created_at->diffInHours() }} Час
                            @elseif($comment->created_at->diffInDays() < 31)
                            {{ $comment->created_at->diffInDays() }} День
                            @elseif($comment->created_at->diffInMonths() < 12)
                            {{ $comment->created_at->diffInMonths() }} Мес
                            @else
                            {{ $comment->created_at->diffInYears() }} Год
                            @endif
                             назад</span>
                            <p>{{ $comment->comment }}</p>
                            {{--  <a href="#" title="" class="active"><i class="fa fa-reply-all"></i>Ответить</a>  --}}
                        </div>
                    </div><!--comment-list end-->
                            {{--  <ul>
                                <li>
                                    <div class="comment-list">
                                        <div class="bg-img">
                                            <img src="images/resources/bg-img2.png" alt="">
                                        </div>
                                        <div class="comment">
                                            <h3>John Doe</h3>
                                            <span><img src="images/clock.png" alt=""> 3 мин назад</span>
                                            <p>Hi John </p>
                                            <a href="#" title=""><i class="fa fa-reply-all"></i>Ответить</a>
                                        </div>
                                    </div><!--comment-list end-->
                                </li>
                            </ul>  --}}
                </li>
                @endforeach

            </ul>
        </div><!--comment-sec end-->
        @auth

        <div class="post-comment">
            <div class="cm_img">
                @if (auth()->user()->role_type == 'company')
                <img src="{{ asset('storage/'.auth()->user()->company->logo) }}" alt="{{ auth()->user()->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';" class="rounded-circle">
            @else
                <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';" class="rounded-circle">
            @endif
            </div>
            <div class="comment_box">
                <form wire:submit.prevent="save_comment({{ $feed_id }})" >
                    <input type="text" placeholder="Post a comment" wire:model="post_comment">
                    <button type="submit">Send</button>
                </form>
            </div>
        </div><!--post-comment end-->

        @else
            <p>Пожалуйста  <a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}">войдите</a> чтобы прокомментировать..</p>
        @endauth


    </div>
</div>

