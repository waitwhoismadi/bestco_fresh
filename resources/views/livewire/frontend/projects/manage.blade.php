<div >

    @foreach ($projects as $project)
            <div class="post-bar" id="manage-project{{ $project->id }}">
                <div class="post_topbar">
                    <div class="wordpressdevlp">
                    <h2>{{ $project->title }}</h2>

                    <p><i class="la la-clock-o"></i>
                    @if($project->created_at->diffInSeconds() < 60)
                        {{ $project->created_at->diffInSeconds() }} Sec
                    @elseif($project->created_at->diffInMinutes() < 60)
                    {{ $project->created_at->diffInMinutes() }} Min
                    @elseif($project->created_at->diffInHours() < 24)
                    {{ $project->created_at->diffInHours() }} Hr
                    @elseif($project->created_at->diffInDays() < 30)
                    {{ $project->created_at->diffInDays() }} Days
                    @elseif($project->created_at->diffInMonths() < 12)
                    {{ $project->created_at->diffInMonths() }} Month
                    @else
                    {{ $project->created_at->diffInYears() }} Years
                    @endif
                     ago</p>
                </div>
                <ul class="savedjob-info mangebid manbids">
                        <li>
                            <h3>Bids</h3>
                            <p>{{ $project->bids->count() }}</p>
                        </li>
                        <li>
                            <h3>Avg Bid (INR)</h3>
                            <p>${{ App\Project_bid::avg_bid($project->id)  }}</p>
                        </li>
                        <li>
                            <h3>Project Budget (INR)</h3>
                            <p>
                                ${{ $project->min_price }} {{ $project->payment_type=='hr'?'/ hr':'' }}
                            </p>
                        </li>
                        <ul class="bk-links bklink">
                            @if (App\feed_bookmark::my_bookmark($project->id)->exists())
                            <li><a href="#/" wire:click="remove_bookmark({{ $project->id }})"><i class="la la-bookmark bg-dark" ></i></a></li>
                            @else
                            <li><a href="#/"  wire:click="add_bookmark({{ $project->id }})"><i class="la la-bookmark bg-info"></i></a></li>
                            @endif

                    </ul>
                </ul>
                <br>
                    <div class="cadidatesbtn bidsbtn">
                    <button type="button" class="btn btn-primary bidders-list" data-projectid="{{ $project->id }}">
                        <span class="badge badge-light">{{ $project->bids()->count() }}</span>Candidates
                    </button>
                    <a href="javascript:void(0)" class="update_project" data-feed="{{ $project }}">
                        <i class="far fa-edit"></i>
                    </a>
                    <a href="#/" class="delete_feed" data-feedid="{{ $project->id }}" data-maindiv="#manage-project">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    @endforeach


</div>

@push('scripts')
    <script>

$('.bidders-list').click(function() {
                var project_id = $(this).data('projectid');

                $(".post-popup.bidder_list").addClass("active");
                $(".wrapper").addClass("overlay");

                append_bidders(project_id)
            })


function  append_bidders(project_id) {
    var bidders = $('.post-popup.bidder_list #bidders');
    var data = get_bidders_list(project_id).responseJSON;
    var acceptbtn = '';

    bidders.html('');


                        var is_active = data.is_active;

                            $.each(data.bidders, function (key, bidder) {

                                if(is_active == false){

                                var acceptbtn = `<button class="btn btn-outline-danger" onclick="accept_bid(`+bidder.id+`,`+bidder.project_id+`)" type="button">Accept</button>`;
                                }
                                else{
                                    var acceptbtn = `<button class="btn btn-outline-primary reopen-bid" onclick="reopen_bid(`+bidder.id+`,`+bidder.project_id+`)" type="button">Re Open</button>`;
                                }
                                var data = `<div class="float-left w-50">
    <h2 class="pb-2" style="font-size:20px">`+bidder.name+`</h2>
                            <ul class="savedjob-info mangebid manbids">
                                <li>
                                    <h4>Bid (INR)</h4>
                                    <p>₹`+bidder.your_bid+`</p>
                                </li>
                                <li>
                                    <h4>Delivery Time</h4>
                                    <p>`+bidder.delivery_time+` days</p>
                                </li>
                            </ul>
    <div class="pt-2">
        <a class="btn btn-success rounded-circle btn-sm" href="tel:`+bidder.user.phone+`" role="button"><i class="fa fa-phone"></i></a>
        <a class="btn btn-danger rounded-circle btn-sm" href="mail:`+bidder.email+`" role="button"><i class="fa fa-envelope"></i></a>
    </div>

                    </div>
                    <div class="float-right w-50 py-3 text-center align-middle">
                        `+acceptbtn+`
                        <button class="btn btn-danger" type="button">Message</button>
                    </div>`;
                                bidders.append(data);

                            })

}

        function accept_bid(bidder_id, project_id){


            $.ajax({
                method:'PUT',
                url:'{{ url("/api") }}/accept-bid/'+bidder_id+'/'+project_id
            })
            .done(function (data) {
                    append_bidders(project_id);
                    flash_notification('Bid Accept Successfully','success');
            })
        }

        function reopen_bid(bidder_id, project_id){

            $.ajax({
                            method:'Put',
                            url:'{{ url("/api") }}/reopen_bid/'+bidder_id
                        })
                        .done(function (data) {
                            append_bidders(project_id);
                            flash_notification('Project Reopen Successfully!','success');
                        })
        }
    </script>
@endpush
