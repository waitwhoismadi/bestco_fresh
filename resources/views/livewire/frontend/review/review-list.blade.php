<div>
    <section ></section>


    <div class="posts-section">
        <div class="post-bar reviewtitle">
            <h2 class="float-left">Отзывы</h2>
            @auth
            @if (auth()->user()->id != $user->id && auth()->user()->role_type != 'admin')
            <a href="javascript:void(0)" class="float-right" onclick="$('#review_form').toggle()">Добавить отзыв</a>
            @endif
            @endauth

        </div><!--post-bar end-->

        @auth
            @if (auth()->user()->id != $user->id && auth()->user()->role_type != 'admin')

                <div class="post-bar" style="display: none" id="review_form" wire:ignore.self>
                    <div class="row">
                        <h2>Добавить новый отзыв</h2>
                        <div class="col-md-12">

                            <form class="rating-form" method="POST" wire:submit.prevent='add_review'>
                                @csrf

                                <div class="form-group p-t-30">
                                    <textarea cols="5" rows="3" placeholder="Напишите обо мне и о моей работе..." name="review_msg" wire:model='review_msg' class="form-control" required></textarea>
                                </div>
                                <div class="form-item">

                                    <input id="rating-5" name="rating" type="radio" value="5" wire:model='review_rating'/>
                                    <label for="rating-5" data-value="5">
                                    <span class="rating-star">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="ir">5</span>
                                    </label>
                                    <input id="rating-4" name="rating" type="radio" value="4" wire:model='review_rating'/>
                                    <label for="rating-4" data-value="4">
                                    <span class="rating-star">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="ir">4</span>
                                    </label>
                                    <input id="rating-3" name="rating" type="radio" value="3" wire:model='review_rating'/>
                                    <label for="rating-3" data-value="3">
                                    <span class="rating-star">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="ir">3</span>
                                    </label>
                                    <input id="rating-2" name="rating" type="radio" value="2" wire:model='review_rating'/>
                                    <label for="rating-2" data-value="2">
                                    <span class="rating-star">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="ir">2</span>
                                    </label>
                                    <input id="rating-1" name="rating" type="radio" value="1" wire:model='review_rating'/>
                                    <label for="rating-1" data-value="1">
                                    <span class="rating-star">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="ir">1</span>
                                    </label>
                                </div>

                                <button class="btn btn-danger" type="submit">Отправить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endauth


        @foreach ($reviews as $review)
        <div class="post-bar ">
            <div class="post_topbar">
                    <div class="usy-dt ">
                        <div class="review-user">
                            @if ($review->user->role_type == 'company')
                                <img src="{{ asset('storage/'.$review->user->company->logo) }}" alt="{{ $review->user->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
                            @else
                                <img src="{{ asset('storage/'.$review->user->image) }}" alt="{{ $review->user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                            @endif
                        </div>
                        <div class="usy-name">
                            @if($review->user->role_type == 'company')
                                <a href="{{ route('company_profile',$review->user->company->slug) }}">
                                    <h3>{{ $review->user->company->company_name }}</h3>
                                </a>
                            @else
                                <a href="{{ route('user_profile',$review->user->slug) }}">
                                    <h3>{{ $review->user->name }}</h3>
                                </a>
                            @endif

                                <div class="epi-sec epi2">
                                    <ul class="descp review-lt">
                                        @if($review->user->role_type == 'company')
                                        <li><img src="{{ asset('images/icon8.png') }}" alt=""><span>{{ $review->user->company->industry_detail->industry_name }}</span></li>
                                        @else
                                        <li><img src="{{ asset('images/icon8.png') }}" alt=""><span>{{ $review->user->category_detail->category_name }}</span></li>
                                        @endif
                                        <li><img src="{{ asset('images/icon9.png') }}" alt=""><span>{{ $review->user->overview->city_detail->name??'' }} {{ $review->user->overview?',':'' }} {{ $review->user->overview->city_detail->state_detail->country_detail->name??'' }}</span></li>
                                    </ul>
                                </div>
                        </div>
                    </div>
            </div>

            <div class="job_descp mngdetl">
                <div class="star-descp review">
                    <ul>

                        @for ($i = 0; $i < $review->rating; $i++)
                            <li><i class="fa fa-star"></i></li>
                        @endfor

                        @for($i = 0; $i < 5-$review->rating; $i++)
                        <li><i class="fa fa-star-o"></i></li>
                        @endfor


                    </ul>
                    <a href="#" title="">{{ $review->rating }} из 5 отзывов</a>
                </div>
                <div class="reviewtext">
                    <p>{{ $review->description }}</p>
                    @if ($review->replies->count() > 0)
                    <hr>
                    @endif

                </div>

        <!-----------replies-list-------------------->
        <div class="replies{{ $review->id }}">

        @foreach ($review->replies as $reply)
                <div class="post_topbar post-reply py-2">
                    <div class="usy-dt">
                        <div class="review-user">
                            @if ($reply->user->role_type == 'company')
                                <img src="{{ asset('storage/'.$reply->user->company->logo) }}" alt="{{ $reply->user->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
                            @else
                                <img src="{{ asset('storage/'.$reply->user->image) }}" alt="{{ $reply->user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                            @endif
                        </div>
                        <div class="usy-name">
                            @if($reply->user->role_type == 'company')
                                <a href="{{ route('company_profile',$reply->user->company->slug) }}">
                                    <h3>{{ $reply->user->company->company_name }}</h3>
                                </a>
                            @else
                                <a href="{{ route('user_profile',$reply->user->slug) }}">
                                    <h3>{{ $reply->user->name }}</h3>
                                </a>
                            @endif
                            <div class="epi-sec epi2">
                                <p><i class="la la-clock-o"></i>
                                    @if($reply->created_at->diffInSeconds() < 60)
                                    {{ $reply->created_at->diffInSeconds() }} Сек
                                @elseif($reply->created_at->diffInMinutes() < 60)
                                {{ $reply->created_at->diffInMinutes() }} Мин
                                @elseif($reply->created_at->diffInHours() < 24)
                                {{ $reply->created_at->diffInHours() }} Час
                                @elseif($reply->created_at->diffInDays() < 31)
                                {{ $reply->created_at->diffInDays() }} День
                                @elseif($reply->created_at->diffInMonths() < 12)
                                {{ $reply->created_at->diffInMonths() }} Мес
                                @else
                                {{ $reply->created_at->diffInYears() }} Год
                                @endif
                                 назад
                                </p>
                                <p class="tahnks">{{ $reply->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
        </div>


        <!-----------replies-list end-------------------->

        <!-----------replies-form-------------------->

        @if (auth()->user() && ($review->user_id == auth()->user()->id || $review->review_to == $user->id))
            <div class="post_topbar rep-post rep-thanks">
                <hr>
                <div class="usy-dt">

                    <div class="review-user">
                        @if (auth()->user()->role_type == 'company')
                            <img src="{{ asset('storage/'.auth()->user()->company->logo) }}" alt="{{ auth()->user()->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';" class="rounded-circle">
                        @else
                            <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';" class="rounded-circle">
                        @endif
                    </div>

                    <form method="POST" class="reply_form" data-reviewid="{{ $review->id }}">
                        <input class="reply" type="text" id="reply_input" placeholder="Ответить" >
                        <input type="submit" class="replybtn btn btn-sm" value="Send">
                    </form>

                </div>
            </div>
        @endif


         <!-----------replies-form end-------------------->

    </div>


        </div><!--post-bar end-->
        @endforeach



    </div><!--posts-section end-->


</div>


@push('scripts')
    <script>

        $('.reply_form').submit(function (e) {
            e.preventDefault();
            var review_id = $(this).data('reviewid');

            var reply = $(this).children('#reply_input').val();

            if(reply !== '' && reply !== null){

                $(this).children('#reply_input').val('');


            $.ajax({
                method:'POST',
                url:'{{ url("/api") }}/save_review_reply',
                data:{review_id:review_id,reply_text:reply}
            })
            .done(function (data) {
                if(data.status == 'success'){

                    $(this).children('#reply_input').val('');
                    $('.replies'+review_id).append(data.append);
                    flash_notification(data.response,'success');

                }
                else{
                    flash_notification(data.response,'error');
                    $(this).children('#reply_input').addClass('is_invalid');
                }
            })

            }
            else{
                $(this).children('#reply_input').addClass('is_invalid');
            }

        })

    </script>
@endpush

@push('styles')
<style>

    .review-toggle{
        float: right;
    color: #a98212;
    font-weight: bold;
    font-size: 17px;
    }
    .add_review input, .add_review textarea{

    border-radius: 10px;
    border: #959595 1px solid;
    }

    .add_review input{
        height: 45px;
    }


    .rating-form
    {
        margin-bottom:40px;
    }
	/* RATING - Form - Item */
	.rating-form .form-item {
		position: relative;
		/* margin: auto; */
		width: 300px;
		text-align: left;
		direction: rtl;
		/*background: green;*/
	}

	.rating-form .form-legend + .form-item {
		padding-top: 10px;
	}

		.rating-form input[type='radio'] {
			position: absolute;
			left: -9999px;
		}

	  /* RATING - Form - Label */
	  .rating-form label {
		display: inline-block;
		cursor: pointer;
	  }

		.rating-form .rating-star {
       display: inline-block;
			position: relative;
		}

	/* .rating-form input[type='radio'] + label:before {
		content: attr(data-value);
		position: absolute;
		right: 30px; top: 83px;
		font-size: 30px; font-size: 3rem;
		opacity: 0;
		direction: ltr;
		.transition();
	}

	.rating-form input[type='radio']:checked + label:before {
		right: 25px;
		opacity: 1;
	}

	.rating-form input[type='radio'] + label:after {
		content: "/ 5";
		position: absolute;
		right: 5px; top: 96px;
		font-size: 16px; font-size: 1.6rem;
		opacity: 0;
		direction: ltr;
		.transition();
	} */

	.rating-form input[type='radio']:checked + label:after {
		/*right: 5px;*/
		opacity: 1;
	}

		.rating-form label .fa {
		  font-size: 35px;
		  line-height: 60px;
		  .transition();
		}

		.rating-form label .fa-star-o {

		}

		.rating-form label:hover .fa-star-o,
		.rating-form label:focus .fa-star-o,
		.rating-form label:hover ~ label .fa-star-o,
		.rating-form label:focus ~ label .fa-star-o,
		.rating-form input[type='radio']:checked ~ label .fa-star-o {
		  opacity: 0;
		}

		.rating-form label .fa-star {
		  position: absolute;
		  left: 0; top: 0;
		  opacity: 0;
		}

		.rating-form label:hover .fa-star,
		.rating-form label:focus .fa-star,
		.rating-form label:hover ~ label .fa-star,
		.rating-form label:focus ~ label .fa-star,
		.rating-form input[type='radio']:checked ~ label .fa-star {
		  opacity: 1;
		}

		.rating-form input[type='radio']:checked ~ label .fa-star {
		  color: gold;
		}

		.rating-form .ir {
		  position: absolute;
		  left: -9999px;
		}

	/* RATING - Form - Action */
	.rating-form .form-action {
		opacity: 0;
		position: absolute;
		left: 5px; bottom: -40px;
		.transition();
	}

	.rating-form input[type='radio']:checked ~ .form-action {
	  cursor: pointer;
	  opacity: 1;
	}

	.rating-form .btn-reset {
		display: inline-block;
		margin: 0;
		padding: 4px 10px;
		border: 0;
		font-size: 10px; font-size: 1rem;
		background: #fff;
		color: #333;
		cursor: auto;
		border-radius: 5px;
		outline: 0;
		.transition();
	}

	   .rating-form .btn-reset:hover,
	   .rating-form .btn-reset:focus {
		 background: gold;
	   }

	   .rating-form input[type='radio']:checked ~ .form-action .btn-reset {
		 cursor: pointer;
	   }


	/* RATING - Form - Output */
	.rating-form .form-output {
		display: none;
		position: absolute;
		right: 15px; bottom: -45px;
		font-size: 30px; font-size: 3rem;
		opacity: 0;
		.transition();
	}

	.no-js .rating-form .form-output {
		right: 5px;
		opacity: 1;
	}

	.rating-form input[type='radio']:checked ~ .form-output {
		right: 5px;
		opacity: 1;
	}
    </style>
@endpush
