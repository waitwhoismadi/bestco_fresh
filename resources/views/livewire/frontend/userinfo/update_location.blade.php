<div class="user-profile-ov">
    <h3>Местоположение
        <a href="javascript:void(0)" title="" class="lct-box-open" data-state_id="{{ $location->city_detail->state_detail->id }}" data-city_id="{{ $location->city_detail->id??'' }}"  data-country_id="{{ $location->city_detail->state_detail->country_detail->id }}" data-address="{{ $location->address??'' }}">
            <i class="fa fa-pencil"></i></a>
    </h3>
    <h4>{{ $location->city_detail->name??'' }}, {{ $location->city_detail->state_detail->country_detail->name }}</h4>
    <p>{{ $location->address??'' }}</p>
</div><!--user-profile-ov end-->
