<div>
    <div class="user-profile-ov st2">
        <h3>Основано
            @auth
            @if($user->id == auth()->user()->id)
                <a href="javascript:void(0)" title="" class="esp-bx-open"><i class="fa fa-pencil"></i></a>
            @endif
            @endauth

           </h3>
        <span id="establish_date" data-establish="{{ $establish?$establish->establish_date:'' }}">{{ $establish?date('F, Y',strtotime($establish->establish_date)):'' }}</span>
    </div><!--user-profile-ov end-->
</div>
