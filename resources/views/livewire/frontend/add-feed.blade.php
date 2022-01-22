<div wire:ignore>

    <!-------------------add feed modal popup-------------------------->

    <div class="post-popup pst-pj">
        <div class="post-project">
            <h3>Post a project</h3>
            <div class="post-project-fields">
                @if($response_msg != '')
                    <div class="alert alert-success">
                        {{ $response_msg }}
                    </div>
                @endif
               <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
               </ul>
                <form wire:submit.prevent="post_project">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="title" placeholder="Название" wire:model='project_title' required>
                            @error('project_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="inp-field">
                                <select wire:model="project_category" required>
                                    <option>Категория</option>
                                    @foreach(App\user_categories::all() as $key => $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('project_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" name="skills" placeholder="Навыки разделите через запятую (например: html,css)" wire:model='project_skills' >
                        </div>
                        <div class="col-lg-6">
                            <div class="price-br">
                                <input type="text" name="price1" placeholder="Бюджет" wire:model=budget required>
                                <i class="la la-dollar"></i>
                            </div>
                            @error('budget')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="inp-field">
                                <select wire:model='payment_type' required>
                                    <option value="full">Полная оплата</option>
                                    <option value="hr">Почасовая оплата</option>
                                </select>
                                @error('payment_type')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <textarea name="description" placeholder="Описание" wire:model='project_description' required></textarea>
                        </div>
                        <div class="col-lg-12">
                            <ul>
                                <li>
                                    {{ $loadbtn }}
                                    @if ($loadbtn)
                                    <button class="active" type="button" disabled>Загрузка..</button>
                                    @else
                                    <button class="active" type="submit" value="post">Опубликовать</button>
                                    @endif

                                </li>

                            </ul>
                        </div>
                    </div>
                </form>
            </div><!--post-project-fields end-->
            <a href="#" title=""><i class="la la-times-circle-o"></i></a>
        </div><!--post-project end-->
    </div>

    <!--post-project-popup end-->

    <div class="post-popup job_post" wire:ignore.self>
        <div class="post-project">
            <h3>Post a job</h3>
            <div class="post-project-fields">

                @if($response_msg != '')
                    <div class="alert alert-success">
                        {{ $response_msg }}
                    </div>
                @endif

                <form wire:submit.prevent="post_job">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="title" placeholder="Название" wire:model="job_title" required>
                            @error('job_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="inp-field">
                                <select  wire:model='job_category' required>
                                    <option>Category</option>
                                    @foreach(App\user_categories::all() as $key => $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('job_category')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" name="skills" placeholder="Навыки разделите через запятую (например: html,css)" wire:model='job_skills'>
                        </div>
                        <div class="col-lg-12">

                                <input type="text" name="location" placeholder="Место работы" wire:model='job_location' required>
                                @error('job_location')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="col-lg-6">
                            <div class="price-br">
                                <input type="text" name="price1" placeholder="Зарплата" wire:model=salary required>
                                <i class="la la-dollar"></i>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="inp-field">
                                <select wire:model='job_type' required>
                                    @foreach(App\job_type::all() as $key => $job_type)
                                    <option value="{{ $job_type->id }}">{{ $job_type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <textarea name="description" placeholder="Описание" wire:model='job_description' required></textarea>
                            @error('job_description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <ul>
                                <li><button class="active" type="submit" value="post">Опубликовать</button></li>

                            </ul>
                        </div>
                    </div>
                </form>
            </div><!--post-job-fields end-->
            <a href="#" title=""><i class="la la-times-circle-o"></i></a>
        </div><!--post-job end-->
    </div>
    <!--post-job-popup end-->

</div>
