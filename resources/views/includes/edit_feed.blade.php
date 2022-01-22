<div class="post-popup updatepst-pj" >
    <div class="post-project">
        <h3>Обновить проект</h3>
        <div class="post-project-fields">

            <form id="update_project" data-update_projectid="">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="text" name="title" placeholder="Название" id='project_title'>

                            <div class="error project_title">

                            </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="inp-field">
                            <select id="project_category">
                                <option>Категория</option>
                                @foreach(App\user_categories::all() as $key => $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>

                            <div class="error project_category">

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" name="skills" placeholder="Навыки разделите через запятую (например: html,css)" id='project_skills'>
                    </div>
                    <div class="col-lg-6">
                        <div class="price-br">
                            <input type="text" name="price1" placeholder="Бюджет" id=project_budget>
                            <i class="la la-dollar"></i>
                        </div>
                        <div class="error project_budget">

                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="inp-field">
                            <select id='payment_type'>
                                <option value="full">Полная оплата</option>
                                <option value="hr">Почасовая оплата</option>
                            </select>

                            <div class="error paymeny_type">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <textarea name="description" placeholder="Описание" id='project_description'></textarea>
                        <div class="error project_description">

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <ul>
                            <li><button class="active" type="submit" value="post">Обновить</button></li>

                        </ul>
                    </div>
                </div>
            </form>
        </div><!--post-project-fields end-->
        <a href="#" title=""><i class="la la-times-circle-o"></i></a>
    </div><!--post-project end-->
</div>

<!--post-project-popup end-->

<div class="post-popup updatejob_post">
    <div class="post-project">
        <h3>Обновить вакансию</h3>
        <div class="post-project-fields">


            <form id="update_job" data-update_jobid="">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="text" name="title" placeholder="Название" id="job_title">
                        <div class="error job_title">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="inp-field">
                            <select  id='job_category'>
                                <option>Категория</option>
                                @foreach(App\user_categories::all() as $key => $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <div class="error job_category">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" name="skills" placeholder="Навыки разделите через запятую (например: html,css)" id='job_skills'>
                    </div>
                    <div class="col-lg-12">

                            <input type="text" name="location" placeholder="Место работы" id='job_location'>
                            <div class="error job_location">
                            </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="price-br">
                            <input type="text" name="price" placeholder="Зарплата" id=job_salary>
                            <i class="la la-dollar"></i>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="inp-field">
                            <select id='job_type'>
                                @foreach(App\job_type::all() as $key => $job_type)
                                <option value="{{ $job_type->id }}">{{ $job_type->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <textarea name="description" placeholder="Описание" id='job_description'></textarea>
                        <div class="error job_description">

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <ul>
                            <li><button class="active" type="submit" value="post">Обновить</button></li>

                        </ul>
                    </div>
                </div>
            </form>
        </div><!--post-job-fields end-->
        <a href="#" title=""><i class="la la-times-circle-o"></i></a>
    </div><!--post-job end-->
</div>
<!--post-job-popup end-->
