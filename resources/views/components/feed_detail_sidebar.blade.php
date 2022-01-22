<div>
    <div class="widget widget-jobs">
        <div class="sd-title">
            <h3>О клиенте</h3>
            <i class="la la-ellipsis-v"></i>
        </div>
        <div class="sd-title paymethd">
            @if($feed->user->role_type == 'user')
            <a href="{{ route('user_profile',[$feed->user->slug]) }}">
            <h3>{{ $feed->user->name }}</h3>
            </a>
            @else
            <a href="{{ route('company_profile',[$feed->user->company->slug]) }}">
                <h3>{{ $feed->user->company->company_name }}</h3>
                </a>
            @endif

            <ul class="star">
                @php
                    $rating_avg = App\Review::review_avg_byuser($feed->user->id)
                @endphp
                    @if ($rating_avg)
                        @php
                            $rating_avg = 1.0;
                        @endphp
                    @endif
                @php
                    $review_avg = number_format($rating_avg);
                @endphp
                @for ($i = 0; $i < $review_avg; $i++)
                    <li><i class="fa fa-star"></i></li>
                @endfor

                @for($i = 0; $i < 5-$review_avg; $i++)
                <li><i class="fa fa-star-o"></i></li>
                @endfor
                <li>
                    <a>{{ $review_avg }} из 5 отзывов</a>
                </li>
            </ul>
        </div>
        <div class="sd-title">
            @if($feed->user->overview)
            <h4>{{ $feed->user->overview->city_detail?$feed->user->overview->city_detail->name:'' }} {{ $feed->user->overview->city_detail?',':'' }} {{ $feed->user->overview->city_detail?$feed->user->overview->city_detail->state_detail->country_detail->name:'' }}</h4>
            @endif
            <p>Address: {{ $feed->user->overview->address??'' }}</p>
        </div>
        <div class="sd-title">
            <h4>{{ $feed->user->feeds()->projects()->count() }} Projects Posted | {{ $feed->user->feeds()->jobs()->count() }} Опубликованне вакансии</h4>
            {{--  <p>85% часть найма, 15% открытые</p>  --}}
        </div>
        <div class="sd-title">
            <h4>Является пользователем с</h4>
            <p>{{ date('F d, Y', strtotime($feed->user->created_at)) }}</p>
        </div>
    </div>
    <!--widget-jobs end-->
    <div class="widget widget-jobs">
        <div class="sd-title">
            <h3>Ссылка на проект</h3>
            <i class="la la-ellipsis-v"></i>
        </div>
        <div class="sd-title copylink">

            <input type="text" id="copy_text" value="{{ $feed->feed_type == 'project'?route('project_detail',[$feed->slug]):route('job_detail',[$feed->slug]) }}">
            <span><a href="javascript:void(0)" id="copy_textbtn">Скопировать ссылку</a></span>
            <div class="alert alert-success" id="copy_textstatus" style="display: none">
                Ссылка скопирована в буффер!
            </div>
        </div>
    </div>
    <!--widget-jobs end-->
    <div class="widget widget-jobs">
        <div class="sd-title">
            <h3>Поделиться</h3>
        </div>
        <div class="sd-title copylink">
            <ul>
                <li>
                    <img src="{{ asset('images/social3.png') }}" alt="image"> </li>
                <li>
                    <img src="{{ asset('images/social4.png') }}" alt="image"></li>
                <li>
                    <img src="{{ asset('images/social1.png') }}" alt="image"></li>
                <li>
                    <img src="{{ asset('images/social5.png') }}" alt="image"></li>
                <li>
                    <img src="{{ asset('images/social2.png') }}" alt="image"></li>
            </ul>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $('#copy_textbtn').click(function (){
            var copyText = $('#copy_text');
            copyText.select();
            // copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            $('#copy_textstatus').show();
        })
    </script>
@endpush
