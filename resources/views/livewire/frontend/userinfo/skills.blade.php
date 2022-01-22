<div>
    <div class="user-profile-ov" >
        <h3>Навыки
            @auth
            @if (auth()->user()->id == $user->id)
           <a href="javascript:void(0)" class="skills-open"><i class="fa fa-plus-square"></i></a>
           @endif
           @endauth
        </h3>
        <ul class="skills-list">
            @foreach ($skills as $skill)
            <li id="skillid{{ $skill->id }}"><a href="javascript:void(0)" class="skl-name">{{ $skill->skill }}</a>
                @if ($user->id == auth()->user()->id)
                <a href="javascript:void(0)" class="close-skl" data-skill="{{ $skill->id }}"><i class="la la-close"></i></a>
                @endif
            </li>


            @endforeach


        </ul>

        <ul>

           </ul>
    </div><!--user-profile-ov end-->


</div>
