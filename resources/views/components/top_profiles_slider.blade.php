<div>
    <div class="top-profiles">
        <div class="pf-hd">
            <h3>Лидирующие профили</h3>
            <i class="la la-ellipsis-v"></i>
        </div>
        <div class="profiles-slider">

            @php
                $users = App\User::where('role_type','user')->orderby('view','desc')->get();
            @endphp

            <livewire:frontend.users-slider-list :users="$users">

        </div><!--profiles-slider end-->
    </div><!--top-profiles end-->
</div>
