<!-- freelancerbiding -->
<div class="col-12">
    <div class="freelancerbiding">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <h3>Ставки фрилансеров ({{ $project->bids->count() }})</h3>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="repcent">
                    <h3>Репутация<i class="la la-angle-down"></i></h3>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="bidrit">
                    <h3>Ставка ($)</h3>
                </div>
            </div>
        </div>
        <hr>
        @forelse ($project->bids as $bid)


        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="usy-dt">
                    <div class="user-info float-none p-0">
                    @if ($bid->user->role_type == 'company')
                    <img src="{{ asset('storage/'.$bid->user->company->logo) }}" alt="{{ $bid->user->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
                @else
                    <img src="{{ asset('storage/'.$bid->user->image) }}" alt="{{ $bid->user->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                @endif
                    </div>
                    <div class="usy-name">
                        @if($bid->user->role_type == 'company')
                                <a href="{{ route('company_profile',$bid->user->company->slug) }}">
                                    <h3>{{ $bid->user->company->company_name }}</h3>
                                </a>
                            @else
                                <a href="{{ route('user_profile',$bid->user->slug) }}">
                                    <h3>{{ $bid->user->name }}</h3>
                                </a>
                            @endif
                        <span><img src="images/icon9.png" alt="">{{ $bid->user->overview->city_detail->name??'' }} {{ $bid->user->overview?',':'' }} {{ $bid->user->overview->city_detail->state_detail->country_detail->name??'' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="repcent">
                    <ul class="star">
                        @php
                        $review_avg = number_format(App\Review::review_avg_byuser($bid->user->id));
                    @endphp
                    @for ($i = 0; $i < $review_avg; $i++)
                        <li><i class="fa fa-star"></i></li>
                    @endfor

                    @for($i = 0; $i < 5-$review_avg; $i++)
                    <li><i class="fa fa-star-o"></i></li>
                    @endfor
                    </ul>

                    <p>{{ $bid->user->reviews()->count() }} Отзывы</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="bidrit">
                    <h3>${{ number_format($bid->your_bid) }}</h3>
                    <p>В {{ $bid->delivery_time }} день</p>
                </div>
            </div>
        </div>
        <hr>
        @empty
        <div class="row">
            <div class="col-md-12 col-sm-12 p-3 text-center">
                <h3>Претендент не найден!</h3>
            </div>
        </div>
        @endforelse



    </div>
</div>
