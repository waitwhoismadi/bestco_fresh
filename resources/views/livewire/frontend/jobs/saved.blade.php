<div>

    @foreach($jobs as $key => $bookmarks)
    @foreach($bookmarks->jobs as $key => $job)
    {{-- {{ $job }} --}}
    @if ($feed_removebookmark != $job->id)
    <div class="post-bar">
        <div class="p-all saved-post">
            <div class="usy-dt">
                <div class="wordpressdevlp">
                    <h2>{{ $job->title }}</h2>

                    <p><i class="la la-clock-o"></i>Опубликовано в {{ date('d F Y',strtotime($job->created_at)) }}</p>
                </div>
            </div>

        </div>
        <ul class="savedjob-info saved-info">
            <li>
                <h3>Претенденты</h3>
                <p>10</p>
            </li>
            <li>
                <h3>Тип работы</h3>
                <p>{{ $job->job_types->type??'' }}</p>
            </li>
            <li>
                <h3>Зарплата</h3>
                <p>$ {{ $job->min_price }}</p>
            </li>
            <li>
                <h3>Опубликовано :  @if($job->created_at->diffInSeconds() < 60)
                    {{ $job->created_at->diffInSeconds() }} Сек
                @elseif($job->created_at->diffInMinutes() < 60)
                {{ $job->created_at->diffInMinutes() }} Мин
                @elseif($job->created_at->diffInHours() < 24)
                {{ $job->created_at->diffInHours() }} Час
                @elseif($job->created_at->diffInDays() < 30)
                {{ $job->created_at->diffInDays() }} День
                @elseif($job->created_at->diffInMonths() < 12)
                {{ $job->created_at->diffInMonths() }} Мес
                @else
                {{ $job->created_at->diffInYears() }} Год
                @endif
                 назад </h3>
                <p>{{ $job->is_active?'Open':'Close' }}</p>
            </li>
            <div class="devepbtn saved-btn">
                <a class="clrbtn" href="#/" wire:click="remove_bookmark({{ $job->id }})">Убрать из сохранении</a>
                <a class="clrbtn" href="#/">Сообщение</a>
            </div>
        </ul>
    </div>
    @endif

    @endforeach
    @endforeach
</div>
