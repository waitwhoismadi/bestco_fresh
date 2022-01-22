<div>
    <livewire:frontend.userinfo.about :user="$user">

    @if ($user->role_type == 'user')
    <livewire:frontend.userinfo.category :user="$user">
    @endif

    @if ($user->role_type == 'user')
    <livewire:frontend.userinfo.experience :user="$user">
    @endif

    @if ($user->role_type == 'user')
    <livewire:frontend.userinfo.education :user="$user">
    @endif

    @if ($user->role_type == 'company')
    <livewire:frontend.companyinfo.establish :user="$user">
    @endif
    {{-- <div class="user-profile-ov">
        <h3><a href="#" title="" class="emp-open">Общее количество сотрудников</a> <a href="#" title="" class="emp-open"><i class="fa fa-pencil"></i></a> <a href="#" title="" class="emp-open"><i class="fa fa-plus-square"></i></a></h3>
        <span>17,048</span>
    </div><!--user-profile-ov end--> --}}

    <livewire:frontend.userinfo.location :user="$user">

    @if ($user->role_type == 'user')
    <livewire:frontend.userinfo.skills :user='$user'>
    @endif

</div>

