<div class="post_topbar post-reply py-2">
    <div class="usy-dt">
        <div class="review-user">
            @if ($reply->user->role_type == 'company')
                <img src="{{ asset('storage/'.$reply->user->company->logo) }}" alt="{{ $reply->user->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
            @else
                <img src="{{ asset('storage/'.$reply->user->image) }}" alt="{{ $reply->user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
            @endif
        </div>
        <div class="usy-name">
            @if($reply->user->role_type == 'company')
                <a href="{{ route('company_profile',$reply->user->company->slug) }}">
                    <h3>{{ $reply->user->company->company_name }}</h3>
                </a>
            @else
                <a href="{{ route('user_profile',$reply->user->slug) }}">
                    <h3>{{ $reply->user->name }}</h3>
                </a>
            @endif
            <div class="epi-sec epi2">
                <p><i class="la la-clock-o"></i>
                    now
                </p>
                <p class="tahnks">{{ $reply->description }}</p>
            </div>
        </div>
    </div>
</div>
