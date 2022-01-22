<div>
    <div class="user-profile-ov">
        <h3>Образование

            @auth
            @if (auth()->user()->id == $user->id)
            <a href="#" title="" class="ed-box-open" data-type="new"><i class="fa fa-plus-square"></i></a>
            @endif
            @endauth
        </h3>

        @foreach($educations as $key => $education)
            <div id="education{{ $education->id }}" class="pb-2">
                <h4>{{ $education->degree }}
                    @auth
                    @if (auth()->user()->id == $user->id)
                    <a href="#" title="" class="ed-box-open" data-type="existing" data-education="{{ $education }}"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0)" title="" class="delete_education" data-education="{{ encrypt($education->id) }}"><i class="fa fa-trash"></i></a>
                    @endif
                    @endauth
                </h4>
                <span>{{ date('Y',strtotime($education->from)) }} - {{ date('Y',strtotime($education->to)) }} {{ $education->institute?'('.$education->institute.')':'' }}</span>
                <p>{!! nl2br($education->detail) !!}</p>
            </div>
        @endforeach

    </div><!--user-profile-ov end-->
</div>
