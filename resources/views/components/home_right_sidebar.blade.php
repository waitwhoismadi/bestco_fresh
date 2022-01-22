<div>
    <div class="right-sidebar">

        <div class="widget widget-jobs">
            <div class="sd-title">
                <h3>Лидирующие вакансии</h3>
                <i class="la la-ellipsis-v"></i>
            </div>
            <div class="jobs-list">
                    @php
                        $jobs = App\Feed::jobs()
                                        ->where('is_active','1')
                                        ->orderby('view','desc')
                                        ->orderby('id','desc')
                                        ->limit(10)->get();
                    @endphp
                <livewire:frontend.job-sm-list :jobs="$jobs">
            </div><!--jobs-list end-->
        </div><!--widget-jobs end-->

        <div class="widget suggestions full-width">
            <div class="sd-title">
                <h3>Самые просматриваемые пользователи</h3>
                <i class="la la-ellipsis-v"></i>
            </div><!--sd-title end-->
            <div class="suggestions-list">
                @php
                    $users = App\User::users()->orderby('view','desc')->limit(10)->get();
                @endphp
                    <livewire:frontend.users-sm-list :users="$users">

            </div><!--suggestions-list end-->
        </div>
    </div><!--right-sidebar end-->
</div>
