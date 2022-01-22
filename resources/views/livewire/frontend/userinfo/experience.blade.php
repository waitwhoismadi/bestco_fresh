<div>
    <div class="user-profile-ov st2">
        <h3>Опыт
            @auth
                @if (auth()->user()->id == $user->id)
            <a href="javascript:void(0)" title="" class="exp-bx-open" data-type="new"><i class="fa fa-plus-square"></i></a>
                @endif
            @endauth
        </h3>

        @foreach ($experiences as $experience)
        <div id="experience{{ $experience->id }}" class="pb-2">
        <h4>{{ $experience->title }}
            @auth
                @if (auth()->user()->id == $user->id)
                <a href="javascript:void(0)" title="" class="exp-bx-open" data-type="existing" data-experience="{{ $experience }}"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0)" title="" class="delete_experience" data-experience="{{ encrypt($experience->id) }}"><i class="fa fa-trash"></i></a>
            </h4>
                @endif
            @endauth

        <p>
            {!! nl2br($experience->detail) !!}
        </p>
        </div>
        @endforeach


    </div><!--user-profile-ov end-->
</div>
