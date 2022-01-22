<div>
    <div class="user-profile-ov">
        <h3>
            Обзор
            @auth
                @if (auth()->user()->id == $user->id)
                <a href="javascript:void(0)" title="Edit Overview" class="overview-open" ><i class="fa fa-pencil"></i></a>
                @endif
            @endauth

        </h3>
        <p id="about-content">{!! nl2br($about) !!}</p>
    </div><!--user-profile-ov end-->

</div>


