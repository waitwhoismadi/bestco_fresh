<div>
    <div class="acc-setting">
        <h3>Настройки учетной записи</h3>
        <form action="{{ auth()->user()->role_type == 'company'? route('company_dashboard.change_password'):route('user_dashboard.change_password') }}" method="post">
            @csrf
            <div class="cp-field">
                <h5>Старый пароль</h5>
                <div class="cpp-fiel">
                    <input type="password" name="old_password" placeholder="Старый пароль" >
                    <i class="fa fa-lock"></i>
                </div>
                @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                @endif
            </div>
            <div class="cp-field">
                <h5>Новый пароль</h5>
                <div class="cpp-fiel">
                    <input type="password" name="password" placeholder="Новый пароль">
                    <i class="fa fa-lock"></i>
                </div>
                @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
            </div>
            <div class="cp-field">
                <h5>Подтвердить пароль</h5>
                <div class="cpp-fiel">
                    <input type="password" name="password_confirmation" placeholder="Подтвердить пароль">
                    <i class="fa fa-lock"></i>
                </div>
                @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
            </div>

            <div class="save-stngs pd2">
                <ul>
                    <li><button type="submit">Сохранить настройки</button></li>

                </ul>
            </div><!--save-stngs end-->
        </form>
    </div><!--acc-setting end-->
</div>
