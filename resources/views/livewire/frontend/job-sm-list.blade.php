@php
    use Illuminate\Support\Str;
@endphp
<div>
    @foreach($jobs as $key => $job)

    <div class="job-info">
        <div class="job-details">
            <a href="{{ route('job_detail', $job->slug) }}"><h3>{{ $job->title }}</h3></a>
            <p>{{ Str::limit($job->description, '30', '...') }}</p>
        </div>
        <div class="hr-rate">
            <span>{{ $job->min_price?'$'.$job->min_price:'' }}</span>
        </div>
    </div><!--job-info end-->

    @endforeach

</div>
