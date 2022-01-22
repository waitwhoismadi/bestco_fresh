<div>
    <div class="acc-setting">
        <h3>Статус профиля</h3>
        <div class="profile-bx-details">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="profile-bx-info">
                        <div class="pro-bx">
                            <img src="images/pro-icon1.png" alt="">
                            <div class="bx-info">
                                <h3>{{ $user->feeds()->jobs()->where('is_active',1)->count() }}</h3>
                                <h5>Открытые вакансии</h5>
                            </div><!--bx-info end-->
                        </div><!--pro-bx end-->
                        <p>Общее количество вакансии открытых в вашем профиле</p>
                    </div><!--profile-bx-info end-->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="profile-bx-info">
                        <div class="pro-bx">
                            <img src="images/pro-icon2.png" alt="">
                            <div class="bx-info">
                                <h3>
                                {{ App\Project_bid::wherein('project_id',$user->feeds()->projects()->pluck('id'))->is_active()->count() }}</h3>
                                <h5>Акттивные проекты</h5>
                            </div><!--bx-info end-->
                        </div><!--pro-bx end-->
                        <p>Общее количество работающих проектов</p>
                    </div><!--profile-bx-info end-->
                </div>
                @if ($user->role_type == 'user')
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="profile-bx-info">
                        <div class="pro-bx">
                            <img src="images/pro-icon3.png" alt="">
                            <div class="bx-info">
                                <h3>{{ $user->applying_jobs()->count() }}</h3>
                                <h5>Заявленные вакансии</h5>
                            </div><!--bx-info end-->
                        </div><!--pro-bx end-->
                        <p>Общее количество вакансии с вашими зявками</p>
                    </div><!--profile-bx-info end-->
                </div>
                @endif

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="profile-bx-info">
                        <div class="pro-bx">
                            <img src="images/pro-icon4.png" alt="">
                            <div class="bx-info">
                                <h3>{{ $user->working_projects()->is_active()->count() }}</h3>
                                <h5>Рабочие проекты</h5>
                            </div><!--bx-info end-->
                        </div><!--pro-bx end-->
                        <p>Вы работаете над сколькими проектами</p>
                    </div><!--profile-bx-info end-->
                </div>
            </div>
        </div><!--profile-bx-details end-->
        <div class="pro-work-status">
            <!-- <h4>Work Status  -  Last Months Working Status</h4> -->
        </div><!--pro-work-status end-->
    </div><!--acc-setting end-->
</div>
