<div>
    <div class="acc-setting">
        <h3>Настройки уведомлений учетной записи по электронной почте</h3>

        @php

            if($user->notification_setting){
                $request_notification = $user->notification_setting->request_notification;
                $feedcomment_notification = $user->notification_setting->feedcomment_notification;
                $feedcomment_notification = $user->notification_setting->feedcomment_notification;
                $jobapply_notification = $user->notification_setting->jobapply_notification;
                $projectbid_notification = $user->notification_setting->projectbid_notification;
                $acceptbid_notification = $user->notification_setting->acceptbid_notification;
                $message_notification = $user->notification_setting->message_notification;
            }
            else{
                $request_notification = 0;
                $feedcomment_notification = 0;
                $feedcomment_notification = 0;
                $jobapply_notification = 0;
                $projectbid_notification = 0;
                $acceptbid_notification = 0;
                $message_notification = 0;
            }
        @endphp
        <form method="POST" action="{{ $user->role_type == 'company'?route('company_dashboard.notification_setting'):route('user_dashboard.notification_setting') }}">
           @csrf
            <div class="notbar">
                <h4>Уведомление о запросе на подписку</h4>
                <p>Включить/выключить отправку уведомления по электронной почте о запросое на подписку.</p>
                <div class="toggle-btn">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="follow_request" {{ $request_notification?'checked':'' }}>
                        <label class="custom-control-label" for="customSwitch1"></label>
                    </div>
                </div>
            </div><!--notbar end-->
            <div class="notbar">
                <h4>Уведомления о комментарии в ленте</h4>
                <p>Пользователь комментирует вашу ленту, включить/выключить отправку уведомления по электронной почте.</p>
                <div class="toggle-btn">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch2" name="comment" {{ $feedcomment_notification?'checked':'' }}>
                        <label class="custom-control-label" for="customSwitch2"></label>
                    </div>
                </div>
            </div><!--notbar end-->
            <div class="notbar">
                <h4>Уведомление о приеме на работу</h4>
                <p>Включить/выключить уведомление о приеме на работу</p>
                <div class="toggle-btn">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch3" name="job_apply" {{ $jobapply_notification?'checked':'' }}>
                        <label class="custom-control-label" for="customSwitch3"></label>
                    </div>
                </div>
            </div><!--notbar end-->
            <div class="notbar">
                <h4>Уведомление о заявке на проект</h4>
                <p>Пользователь подает заявку на ваш проект, включить/выключить отправку уведомления по электронной почте.</p>
                <div class="toggle-btn">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch4" name="bid" {{ $projectbid_notification?'checked':'' }}>
                        <label class="custom-control-label" for="customSwitch4"></label>
                    </div>
                </div>
            </div><!--notbar end-->
            <div class="notbar">
                <h4>Уведомление о приеме заявки</h4>
                <p>Включить/выключить отправку уведомления о приеме заяки по электронной почте</p>
                <div class="toggle-btn">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch5" name="acceptbid" {{ $acceptbid_notification?'checked':'' }}>
                        <label class="custom-control-label" for="customSwitch5"></label>
                    </div>
                </div>
            </div><!--notbar end-->
            <div class="notbar">
                <h4>Уведомление о сообщении</h4>
                <p>Вы получаете новое сообщение, включить/выключить отправку уведомления по электронной почте</p>
                <div class="toggle-btn">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch6" name="message" {{ $message_notification?'checked':'' }}>
                        <label class="custom-control-label" for="customSwitch6"></label>
                    </div>
                </div>
            </div><!--notbar end-->
            <div class="save-stngs">
                <ul>
                    <li><button type="submit">Сохранить настройки</button></li>

                </ul>
            </div><!--save-stngs end-->
        </form>
    </div><!--acc-setting end-->
</div>
