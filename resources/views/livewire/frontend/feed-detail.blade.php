@php
    use Illuminate\Support\Str;
    use App\Http\Controllers\ChatController as Chat;
@endphp
<div>

        <div class="posts-section">

            <div class="posty mb-4">
            <div class="post-bar no-margin" id="mainfeed{{ $feed->id }}">
                <div class="post_topbar">
                    <div class="usy-dt">
                        <div class="feed-img">
                            @if ($feed->user->role_type == 'company')
                                <img src="{{ asset('storage/'.$feed->user->company->logo) }}" alt="{{ $feed->user->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
                            @else
                                <img src="{{ asset('storage/'.$feed->user->image) }}" alt="{{ $feed->user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                            @endif
                        </div>
                        <div class="usy-name">
                            @if($feed->user->role_type == 'user')
                            <a href="{{ route('user_profile',[$feed->user->slug]) }}">
                            <h3>{{ $feed->user->name }}</h3>
                            </a>
                            @else
                            <a href="{{ route('company_profile',[$feed->user->company->slug]) }}">
                                <h3>{{ $feed->user->company->company_name }}</h3>
                                </a>
                            @endif
                            <span><img src="{{ asset('images/clock.png') }}" alt="">
                                @if($feed->created_at->diffInSeconds() < 60)
                                    {{ $feed->created_at->diffInSeconds() }} Сек
                                @elseif($feed->created_at->diffInMinutes() < 60)
                                {{ $feed->created_at->diffInMinutes() }} Мин
                                @elseif($feed->created_at->diffInHours() < 24)
                                {{ $feed->created_at->diffInHours() }} Час
                                @elseif($feed->created_at->diffInDays() < 31)
                                {{ $feed->created_at->diffInDays() }} День
                                @elseif($feed->created_at->diffInMonths() < 12)
                                {{ $feed->created_at->diffInMonths() }} Мес
                                @else
                                {{ $feed->created_at->diffInYears() }} Год
                                @endif
                                 назад</span>
                        </div>
                    </div>
                    @if(auth()->user() && $feed->user_id == auth()->user()->id)

                    <div class="ed-opts">
                        <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                            <ul class="ed-options">

                                @if($feed->feed_type == 'project')
                                <li><a href="javascript:void(0)" title="" class="update_project" data-feed="{{ $feed }}">Редактировать проект</a></li>
                                @if($feed->is_active)
                                <li><a href="javascript:void(0)" title="UnBid" wire:click="change_feedstatus({{ $feed->id }},0)">Убрать ставку</a></li>
                                @else
                                <li><a href="javascript:void(0)" title="Open Bid" wire:click="change_feedstatus({{ $feed->id }},1)">Открыть ставку</a></li>
                                @endif
                                @else
                                <li><a href="javascript:void(0)" title="" class="update_job" data-feed="{{ $feed }}">Редактировать вакансию</a></li>
                                @if($feed->is_active)
                                <li><a href="javascript:void(0)" title="Close Job" wire:click="change_feedstatus({{ $feed->id }},0)">Закрыть вакансию</a></li>
                                @else
                                <li><a href="javascript:void(0)" title="Open Job" wire:click="change_feedstatus({{ $feed->id }},1)">Открыть вакансию</a></li>
                                @endif
                                @endif
                                <li><a href="#/" title="Delete" class="delete_feed" data-feedid="{{ $feed->id }}" data-maindiv="#mainfeed">Удалить</a></li>
                            </ul>
                    </div>
                    @endif
                </div>
                <div class="epi-sec">
                    <ul class="descp">
                        <li><img src="{{ asset('images/icon8.png') }}" alt=""><span>{{ $feed->category_detail->category_name }}</span></li>
                        <li><img src="{{ asset('images/icon9.png') }}" alt=""><span>{{ $feed->location }}</span></li>
                    </ul>

                        <ul class="bk-links">
                            @auth
                            @if (App\feed_bookmark::my_bookmark($feed->id)->exists())
                            <li><a href="#/" wire:click="remove_bookmark({{ $feed->id }})"><i class="la la-bookmark bg-dark" ></i></a></li>
                            @else
                            <li><a href="#/"  wire:click="add_bookmark({{ $feed->id }})"><i class="la la-bookmark bg-info"></i></a></li>
                            @endif

                            @if(auth()->user()->role_type !== 'admin')
                            <li><a href="{{ Chat::create_link(auth()->user()->role_type,$feed->user->id,$feed->feed_type,$feed->id) }}" target="_blank" title="chat" ><i class="la la-envelope"></i></a></li>
                            @endif

                            @else
                            <li><a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}" ><i class="la la-bookmark bg-dark" ></i></a></li>
                            <li><a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}" title=""><i class="la la-envelope"></i></a></li>
                            @endauth
                        </ul>



                </div>
                <div class="job_descp">
                    <a href="{{ ($feed->feed_type == 'project')?route('project_detail', $feed->slug):route('job_detail', $feed->slug) }}"><h3>{{ $feed->title }}</h3></a>
                    <ul class="job-dt">
                        @if($feed->feed_type == 'job' && $feed->job_type)
                            <li><a href="#" title="">{{ $feed->job_types->type }}</a></li>
                        @endif

                        <li><span>${{ number_format($feed->min_price) }} {{ $feed->payment_type=='hr'?'/ hr':'' }}</span></li>
                    </ul>
                    <p id="less_content{{ $feed->id }}">{!! nl2br(Str::limit($feed->description,100)) !!} @if(Str::length($feed->description) >= 100)<a href="#/" onclick="more_content({{ $feed->id }})">больше</a>@endif</p>
                    <p id="more_content{{ $feed->id }}" style="display: none;">{!! nl2br($feed->description) !!} <a href="#/" onclick="less_content({{ $feed->id }})">меньше</a></p>
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
                @php
                    $like_count = $feed->likes->count();
                @endphp
                <div class="job-status-bar">
                    <ul class="like-com">
                        <li>
                            @auth

                                @if ($like_feed)
                                <a href="#/" wire:click="like({{ $feed->id }})"><i class="fas fa-heart"></i> Like</a>
                                @elseif($unlike_feed)
                                <a href="#/" class="text-danger" wire:click="unlike({{ $feed->id }})"><i class="fas fa-heart"></i> Убрать из понравшихся</a>
                                @endif

                                {{--  @if ($like_feed)
                                <a href="#/" class="text-danger" wire:click="unlike({{ $feed->id }})"><i class="fas fa-heart"></i> Убрать из понравшихся</a>
                                @else
                                <a href="#/" wire:click="like({{ $feed->id }})"><i class="fas fa-heart"></i> Нравится</a>
                                @endif  --}}
                            @endauth
                            @guest
                            <a href="{{ route('login', ['redirect_to'=>Crypt::encrypt(Route::currentRouteName())]) }}"><i class="fas fa-heart"></i> Нравится</a>
                            @endguest


                            @if ($like_count > 50)
                           <img src="{{ asset('images/liked-img.png') }}" alt="">
                            <span>50+</span>
                            @elseif($like_count > 0)


                            <span class="ml-0">{{ $like_count }}</span>
                            @endif

                        </li>
                        <li><a href="javascript:void(0)" class="com commentlink" data-feedid="{{ $feed->id }}" style="{{ ($like_count <= 0)?'top:0':'' }}"><i class="fas fa-comment-alt"></i> Comment  {{ ($feed->comments->count() > 0)?$feed->comments->count():'' }}</a></li>
                    </ul>
                    <a href="#"><i class="fas fa-eye"></i>Views {{ $feed->view }}</a>
                </div>


            </div>
            <div class="comments_area{{ $feed->id }}" >
            <livewire:frontend.feed-comments :comments="$feed->comments()->orderBy('created_at','ASC')->get()" :feed="$feed"></livewire:frontend.feed-comments>
            </div>
            </div>


            <!--post-bar end-->

        </div>






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

    $('.commentlink').click(function () {

            var feed_id = $(this).data('feedid');

            $('.comments_area'+feed_id).toggle();
            console.log(feed_id+'show');
    })
</script>
@endpush

