<div>
    @foreach($bids as $key => $bid)

        <div class="post-bar" id="avtive-bid{{ $bid->id }}">
            <div class="post_topbar active-bids">
                <div class="usy-dt">
                    <div class="wordpressdevlp" >
                    <h2>{{ $bid->project->title }}</h2>
                </div>
                </div>
            </div>
            <ul class="savedjob-info activ-bidinfo">
                <li>
                    <h3>Fixed Price</h3>
                    <p>${{ $bid->your_bid }}</p>
                </li>
                <li>
                    <h3>Delivery Time</h3>
                    <p>{{ $bid->delivery_time }} Days</p>
                </li>
                <div class="py-3">
                    <button type="button" class="btn btn-danger text-light">
                        Message
                    </button>

                </div>
        </ul>
        </div>

    @endforeach

</div>

@push('scripts')
    <script>
         $('.reopen-bid').click(function (){
                var bid_id = $(this).data('bidid');

                swal({
                title: "Are you sure?",
                text: "Once Reopen, Bidder stop working this project",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {

                    if (willDelete) {
                        $.ajax({
                            method:'Put',
                            url:'{{ url("/api") }}/reopen_bid/'+bid_id
                        })
                        .done(function (data) {
                            $("#active-bid"+bid_id).hide();
                            flash_notification('Project Reopen Successfully!','success');
                        })
                    }

                })
    })
    </script>
@endpush
