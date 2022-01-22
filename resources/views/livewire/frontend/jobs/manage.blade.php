<div id="manage-job">
    @foreach($jobs as $key => $job)
    <div class="posts-bar" id="manage-job{{ $job->id }}">
        <div class="post-bar bgclr">
            <div class="wordpressdevlp">
                <h2>{{ $job->title}}</h2>

                <p><i class="la la-clock-o"></i>Опубликовано в {{ date('d F Y',strtotime($job->created_at)) }}</p>
            </div>
            <br>
            <div class="row no-gutters">
                <div class="col-md-6 col-sm-12">
                    <div class="cadidatesbtn">
                        <button type="button" class="btn btn-primary candidates-list" data-feedid="{{ $job->id }}">
                            <span class="badge badge-light">{{ $job->candidate->count() }}</span>
                            Кандидаты
                        </button>
                        <a href="javascript:void(0)" class="update_job" data-feed="{{ $job }}">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="#/" class="delete_feed" data-feedid="{{ $job->id }}" data-maindiv="#manage-job">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <ul class="bk-links bklink">
                         @if (App\feed_bookmark::my_bookmark($job->id)->exists())
                            <li><a href="#/" wire:click="remove_bookmark({{ $job->id }})"><i class="la la-bookmark bg-dark" ></i></a></li>
                            @else
                            <li><a href="#/"  wire:click="add_bookmark({{ $job->id }})"><i class="la la-bookmark bg-info"></i></a></li>
                            @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>

@push('scripts')
    <script>
            $('.candidates-list').click(function() {
                var feed_id = $(this).data('feedid');
                var user = $('.candidate_list #user');
                $(".post-popup.candidate_list").addClass("active");
                $(".wrapper").addClass("overlay");
                    $.ajax({
                        method:'GET',
                        url:'{{ url("/api") }}/job_candidates_list/'+feed_id,
                    })
                    .done(function (data) {
                        user.html('');
                        $.each(data, function (key, candidate) {
                            var data = `<div class="float-left w-75">
<h2 class="pb-2" style="font-size:20px">`+candidate.name+`</h2>
<span>`+candidate.experience+` Year Experience</span>
<div class="pt-2">
    <a class="btn btn-success rounded-circle btn-sm" href="tel:`+candidate.contact+`" role="button"><i class="fa fa-phone"></i></a>
    <a class="btn btn-danger rounded-circle btn-sm" href="mail:`+candidate.email+`" role="button"><i class="fa fa-envelope"></i></a>
</div>

                </div>
                <div class="float-right w-25 py-3">
                    <a class="btn btn-danger" target="_blank" href="{{ url('user') }}/`+candidate.user.slug+`" role="button">View Profile</a>
                </div>`;
                            user.append(data);

                        })
                    })
            })
    </script>
@endpush
