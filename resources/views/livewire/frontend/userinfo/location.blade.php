<div id="location_section">
    <div class="user-profile-ov">
        <h3>Местоположение
            @auth
            @if (auth()->user()->id == $user->id)
            <a href="javascript:void(0)" title="" class="lct-box-open" data-state_id="{{ $location?$location->city_detail->state_detail->id:'' }}" data-city_id="{{ $location?$location->city_detail->id:'' }}"  data-country_id="{{ $location?$location->city_detail->state_detail->country_detail->id:'' }}" data-address="{{ $location->address??'' }}">
                <i class="fa fa-pencil"></i></a>
                @endif
                @endauth
        </h3>
        @if ($location)
        <h4>{{ $location->city_detail?$location->city_detail->name:'' }}, {{ $location->city_detail?$location->city_detail->state_detail->country_detail->name:'' }}</h4>
        <p>{{ $location->address??'' }}</p>
        @endif

    </div><!--user-profile-ov end-->
</div>
