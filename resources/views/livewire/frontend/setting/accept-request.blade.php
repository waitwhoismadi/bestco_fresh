<div>
    <div class="acc-setting">
        <h3>Запросы</h3>
        <div class="requests-list">


            @foreach($follow_requests as $key => $follow_request)
            @if ($follow_request->followeruser->role_type !== 'admin')

                <div class="request-details">
                    <div class="noty-user-img">
                        @if ($follow_request->followeruser->role_type == 'company')
                                <img src="{{ asset('storage/'.$follow_request->followeruser->company->logo) }}" alt="{{ $follow_request->followeruser->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';" class="rounded-circle">
                            @else
                                <img src="{{ asset('storage/'.$follow_request->followeruser->image) }}" alt="{{ $follow_request->followeruser->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';" class="rounded-circle">
                            @endif
                    </div>
                    <div class="request-info">
                        @if ($follow_request->followeruser->role_type == 'company')
                        <a href="{{ route('company_profile',$follow_request->followeruser->company->id) }}" title="{{ $follow_request->followeruser->company->company_name }}"><h3>{{ $follow_request->followeruser->company->company_name }}</h3></a>
                        <span>{{ $follow_request->followeruser->company->industry_detail->industry_name }}</span>
                        @else
                        <a href="{{ route('user_profile',$follow_request->followeruser->id) }}" title="{{ $follow_request->followeruser->name }}"><h3>{{ $follow_request->followeruser->name }}</h3></a>
                        <span>{{ $follow_request->followeruser->category_detail->category_name }}</span>
                        @endif

                    </div>
                    <div class="accept-feat">
                        <ul>
                            <li><button type="submit" class="accept-req" wire:click="accept_request({{ $follow_request->id }})">Принять</button></li>
                            <li><button type="submit" class="close-req" wire:click="delete_request({{ $follow_request->id }})"><i class="la la-close"></i></button></li>
                        </ul>
                    </div><!--accept-feat end-->
                </div><!--request-detailse end-->


            @endif
            @endforeach


        </div><!--requests-list end-->
    </div><!--acc-setting end-->
</div>
