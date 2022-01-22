@php
    use Illuminate\Support\Str;
@endphp
<div>
    <div class="main-ws-sec">
        @if(auth()->user() && $is_upload && (auth()->user()->role_type=='user' || auth()->user()->role_type=='company'))
            <div class="post-topbar">
                <div class="user-picy">
                    <img src="{{ asset('images/resources/user-pic.png') }}" alt="">
                </div>
                <div class="post-st">
                    <ul>
                        <li><a class="post_project" href="#" title="">Опубликовать проект</a></li>
                        <li><a class="post-jb active" href="#" title="">Опубликовать вакансию</a></li>
                    </ul>
                </div><!--post-st end-->
            </div>
        @endif
        <!--post-topbar end-->

        <div class="posts-section">

            @foreach($feeds as $key => $feed)
            <div class="post-bar">
                <div class="post_topbar">
                    <div class="usy-dt">
                        <img src="{{ asset('images/resources/us-pic.png') }}" alt="">
                        <div class="usy-name">
                            @if($feed->user->role_type == 'user')
                            <a href="{{ route('user_profile',[$feed->user->slug]) }}">
                            <h3>{{ $feed->user->name }}</h3>
                            </a>
                            @else:
                            <a href="{{ route('company_profile',[$feed->user->company->slug]) }}">
                                <h3>{{ $feed->user->company->company_name }}</h3>
                                </a>
                            @endif
                            <span><img src="{{ asset('images/clock.png') }}" alt="">3 мин назад</span>
                        </div>
                    </div>
                    <div class="ed-opts">
                        <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>

                        @if(auth()->user() && $feed->user_id == auth()->user()->id)
                            <ul class="ed-options">
                                <li><a href="#" title="">Редактировать публикцию</a></li>
                                <li><a href="#" title="">Убрать из сохранении</a></li>
                                <li><a href="#" title="">Убрать ставку</a></li>
                                <li><a href="#" title="">Закрыть</a></li>
                                <li><a href="#" title="">Скрыть</a></li>
                            </ul>
                        @endif

                    </div>
                </div>
                <div class="epi-sec">
                    <ul class="descp">
                        <li><img src="{{ asset('images/icon8.png') }}" alt=""><span>{{ $feed->category_detail->category_name }}</span></li>
                        <li><img src="{{ asset('images/icon9.png') }}" alt=""><span>Индия</span></li>
                    </ul>
                    @auth
                        <ul class="bk-links">

                            @if (App\feed_bookmark::my_bookmark($feed->id)->exists() || $feed_bookmark == $feed->id)
                            <li><a href="#/" wire:click="remove_bookmark({{ $feed->id }})"><i class="la la-bookmark bg-dark" ></i></a></li>
                            @else
                            <li><a href="#/"  wire:click="add_bookmark({{ $feed->id }})"><i class="la la-bookmark bg-info"></i></a></li>
                            @endif

                            <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                            @if($feed->feed_type == 'project')
                            <li><a href="#" title="" class="bid_now">Сделать ставку</a></li>
                        @endif

                        </ul>
                    @endauth

                </div>
                <div class="job_descp">
                    <h3>{{ $feed->title }}</h3>
                    <ul class="job-dt">
                        @if($feed->feed_type == 'job')
                            <li><a href="#" title="">{{ $feed->job_types->type }}</a></li>
                        @endif

                        <li><span>₹{{ $feed->min_price }} {{ $feed->payment_type=='hr'?'/ hr':'' }}</span></li>
                    </ul>
                    <p id="less_content{{ $feed->id }}">{{ Str::limit($feed->description,100) }} @if(Str::length($feed->description) >= 100)<a href="#/" onclick="more_content({{ $feed->id }})">больше</a>@endif</p>
                    <p id="more_content{{ $feed->id }}" style="display: none;">{{ $feed->description }} <a href="#/" onclick="less_content({{ $feed->id }})">меньше</a></p>
                    @php
                       $skills= explode(',', $feed->skills)
                    @endphp
                    @if (count($skills) >= 1)
                        <ul class="skill-tags">
                            @foreach($skills as $key => $skill)
                                @if ($skill != '')
                                <li><a href="#/" title="">{{ $skill }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    @endif

                </div>
                <div class="job-status-bar">
                    <ul class="like-com">
                        <li>
                            <a href="#"><i class="fas fa-heart"></i> Нравится</a>
                            {{-- <img src="images/liked-img.png') }}" alt="">
                            <span>25</span> --}}
                        </li>
                        <li><a href="#" class="com"><i class="fas fa-comment-alt"></i> Комментировать</a></li>
                    </ul>
                    <a href="#"><i class="fas fa-eye"></i>Просмотры {{ $feed->view }}</a>
                </div>
            </div>
            @endforeach

            <!--post-bar end-->

        </div>
    </div>


    <!-------------------add feed modal popup-------------------------->

    <div class="post-popup pst-pj"  wire:ignore.self>
        <div class="post-project">
            <h3>Опубликовать проект</h3>
            <div class="post-project-fields">
                @if($response_msg != '')
                    <div class="alert alert-success">
                        {{ $response_msg }}
                    </div>
                @endif
                <form wire:submit.prevent="post_project">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="title" placeholder="Название" wire:model='project_title'>
                            @error('project_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="inp-field">
                                <select wire:model="project_category">
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
                            <input type="text" name="skills" placeholder="Навыки" wire:model='project_skills'>
                        </div>
                        <div class="col-lg-6">
                            <div class="price-br">
                                <input type="text" name="price1" placeholder="Бюджет" wire:model=budget>
                                <i class="la la-inr"></i>
                            </div>
                            @error('budget')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="inp-field">
                                <select wire:model='payment_type'>
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
                            <textarea name="description" placeholder="Описание" wire:model='project_description'></textarea>
                        </div>
                        <div class="col-lg-12">
                            <ul>
                                <li><button class="active" type="submit" value="post">Опубликовать</button></li>
                                <li><a href="#" title="">Отмена</a></li>
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
            <h3>Опубликовать вакансию</h3>
            <div class="post-project-fields">

                @if($response_msg != '')
                    <div class="alert alert-success">
                        {{ $response_msg }}
                    </div>
                @endif

                <form wire:submit.prevent="post_job">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="title" placeholder="Название" wire:model="job_title">
                            @error('job_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="inp-field">
                                <select  wire:model='job_category'>
                                    <option>Категория</option>
                                    @foreach(App\user_categories::all() as $key => $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('job_title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" name="skills" placeholder="Навыки" wire:model='job_skills'>
                        </div>
                        <div class="col-lg-6">
                            <div class="price-br">
                                <input type="text" name="price1" placeholder="Зарплата" wire:model=salary>
                                <i class="la la-inr"></i>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="inp-field">
                                <select wire:model='job_type'>
                                    @foreach(App\job_type::all() as $key => $job_type)
                                    <option value="{{ $job_type->id }}">{{ $job_type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <textarea name="description" placeholder="Описание" wire:model='job_description'></textarea>
                            @error('job_description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <ul>
                                <li><button class="active" type="submit" value="post">Опубликовать</button></li>
                                <li><a href="#" title="">Отмена</a></li>
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


@push('scripts')
<script>
    function more_content(id){
        $('#less_content'+id).hide();
        $('#more_content'+id).show();
        console.log(id);
    }
    function less_content(id){
        $('#less_content'+id).show();
        $('#more_content'+id).hide();
    }
</script>
@endpush
