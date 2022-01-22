<div >
    @foreach ($cadidates as $cadidate)
    @if ($cadidate->id != $delete_cadidate)
    <div class="post-bar" id="applied-candidate{{ $cadidate->id }}">
        <div class="post_topbar applied-post">
            <div class="usy-dt">
                <img src="images/resources/us-pic.png" alt="">
                <div class="usy-name">
                    <h3>{{ $cadidate->name }}</h3>
                    <div class="epi-sec epi2">

                    </div>
                </div>
            </div>

            <div class="job_descp noborder">
                <div class="star-descp review profilecnd">
                    <ul class="bklik">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-half-o"></i></li>
                        <a href="#" title="">5.0 из 5 Отзывы</a>
                    </ul>
                </div>
                <div class="devepbtn appliedinfo noreply">
                    <a class="clrbtn " onclick="show_cadidate_detail({{ $cadidate->id }})" href="#/">Посмотреть детали</a>
                    @if ($cadidate->role_type == 'user')
                        <a class="clrbtn" href="{{ route('user_profile',[$cadidate->slug]) }}">Посмотерть</a>
                    @endif
                    <a class="clrbtn" href="#/">Сообщение</a>

                    <a href="#/" onclick="candidate_delete({{ $cadidate->id }})">
                        <i class="far fa-trash-alt"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>

    @push('scripts')
        <script>
            function show_cadidate_detail(cadidate){
                $(".post-popup.cadidate_detail").addClass("active");
                $(".wrapper").addClass("overlay");


                $.ajax({
                    method: "GET",
                    url: "{{ url('api') }}/job_candidate_detail/"+cadidate,
                })
                    .done(function( data ) {

                        $(".cadidate_detail table tr #cadidate-name").html(data.name);
                        $(".cadidate_detail table tr #cadidate-email").html(data.email);
                        $(".cadidate_detail table tr #cadidate-contact").html(data.contact);
                        $(".cadidate_detail table tr #cadidate-experience").html(data.experience+' Years');
                        if(data.resume != null){
                        $(".cadidate_detail table tr #cadidate-cv a").attr('href','{{ asset('storage') }}/'+data.resume);
                        }
                    });
                    $("#cadidate-name").html();
            }

            function delete_candidate(candidate_id){
                swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                            $.ajax({
                                method: "DELETE",
                                url: "{{ url('api') }}/job_candidate_delete/"+candidate_id,
                                })
                            .done(function( data ) {
                                flash_notification('Delete Record Successfully!','success');
                                $('#applied-candidate'+candidate_id).hide();
                            })
                    }
                });
            }
        </script>

    @endpush





