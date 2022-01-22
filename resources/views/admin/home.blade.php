@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title">Dashboard</h4>

            </div>
          </div>

        </div>
        <!-- Page Title Header Ends-->
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 col-md-6">
                    <div class="d-flex">
                      <div class="wrapper">
                        <h3 class="mb-0 font-weight-semibold">{{ number_format(App\User::where('role_type','user')->count()) }}</h3>
                        <h5 class="mb-0 font-weight-medium text-primary">Users</h5>
                        {{--  <p class="mb-0 text-muted">+14.00(+0.50%)</p>  --}}
                      </div>
                      <div class="wrapper my-auto ml-auto ml-lg-4">
                        <canvas height="50" width="100" id="stats-line-graph-1"></canvas>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                    <div class="d-flex">
                      <div class="wrapper">
                        <h3 class="mb-0 font-weight-semibold">{{ number_format(App\User::where('role_type','company')->count()) }}</h3>
                        <h5 class="mb-0 font-weight-medium text-primary">Companies</h5>
                        {{--  <p class="mb-0 text-muted">+138.97(+0.54%)</p>  --}}
                      </div>
                      <div class="wrapper my-auto ml-auto ml-lg-4">
                        <canvas height="50" width="100" id="stats-line-graph-2"></canvas>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                    <div class="d-flex">
                      <div class="wrapper">
                        <h3 class="mb-0 font-weight-semibold">{{ number_format(App\Feed::jobs()->count()) }}</h3>
                        <h5 class="mb-0 font-weight-medium text-primary">Jobs</h5>
                        {{--  <p class="mb-0 text-muted">+57.62(+0.76%)</p>  --}}
                      </div>
                      <div class="wrapper my-auto ml-auto ml-lg-4">
                        <canvas height="50" width="100" id="stats-line-graph-3"></canvas>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                    <div class="d-flex">
                      <div class="wrapper">
                        <h3 class="mb-0 font-weight-semibold">{{ number_format(App\Feed::projects()->count()) }}</h3>
                        <h5 class="mb-0 font-weight-medium text-primary">Projects</h5>
                        {{--  <p class="mb-0 text-muted">+138.97(+0.54%)</p>  --}}
                      </div>
                      <div class="wrapper my-auto ml-auto ml-lg-4">
                        <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>




        {{-- ---------Graph section here ----------- --}}




        <div class="row">
          <div class="col-md-12">
            <div class="row">

              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h4 class="card-title mb-0">Active Bids</h4>
                      {{-- <a href="#"><small>Show All</small></a> --}}
                    </div>
                    <p>List of projects bids are working</p>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Project</th>
                            <th>Customer</th>
                            <th>Bidder</th>
                            <th>Delivery Time</th>
                            <th>Bid Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Project_bid::where('bid_status','accept')->orderBy('Updated_at','DESC')->limit(10)->get() as $bid)
                            <tr>
                                <td>
                                    <a href="{{ route('project_detail',[$bid->project->slug]) }}" target="_blank">
                                    {{ Str::limit($bid->project->title,'15','..') }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ $bid->project->user->company?route('company_profile',[$bid->project->user->company->slug]):route('user_profile',[$bid->project->user->slug]) }}" target="_blank">
                                        {{ $bid->project->user->name }}
                                    </a>

                                </td>
                                <td>
                                    <a href="{{ $bid->user->company?route('company_profile',[$bid->user->company->slug]):route('user_profile',[$bid->user->slug]) }}" target="_blank">
                                        {{ $bid->user->name }}
                                    </a>
                                </td>
                                <td>{{ $bid->delivery_time }} Days</td>
                                <td>${{ number_format($bid->your_bid) }}</td>
                              </tr>
                            @endforeach


                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-danger mr-2"></div>
                          <p class="mb-0">Total active projects</p>
                        </div>
                        <h4 class="font-weight-semibold">{{ number_format(App\Project_bid::where('bid_status','accept')->count()) }}</h4>
                        <div class="progress progress-md">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: {{ App\Project_bid::where('bid_status','accept')->count() }}%" aria-valuenow="{{ App\Project_bid::where('bid_status','accept')->count() }}" aria-valuemin="0" aria-valuemax="78"></div>
                        </div>
                      </div>
                      <div class="col-md-6 mt-4 mt-md-0">
                        <div class="d-flex align-items-center pb-2">
                          <div class="dot-indicator bg-success mr-2"></div>
                          <p class="mb-0">Total Applied Jobs</p>
                        </div>
                        <h4 class="font-weight-semibold">
                            {{
                                number_format(App\apply_job::distinct('job_id')->count())
                                }}
                        </h4>
                        <div class="progress progress-md">
                          <div class="progress-bar bg-success" role="progressbar" style="width: {{ app\apply_job::distinct('job_id')->count() }}%" aria-valuenow="{{ app\apply_job::distinct('job_id')->count() }}" aria-valuemin="0" aria-valuemax="45"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 grid-margin stretch-card average-price-card">
                <div class="card text-white">
                  <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 align-items-center">
                      <h2 class="font-weight-semibold mb-0">${{
                        number_format(App\Project_bid::where('bid_status','accept')->sum('your_bid'))
                        }}</h2>
                      <div class="icon-holder">
                        <i class="mdi mdi-briefcase-outline"></i>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between">
                      <h5 class="font-weight-semibold mb-0">Total active bids amount</h5>
                      {{-- <p class="text-white mb-0">Since last month</p> --}}
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>



        <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title mb-0">Recent Registration</h4>
                @foreach (App\User::where('role_type','!=','admin')->orderBy('created_at','DESC')->limit(10)->get() as $user)
                <div class="d-flex py-2 border-bottom">
                    <div class="wrapper">
                      <small class="text-muted">{{ date('d M Y',strtotime($user->created_at)) }}</small>
                      <p class="font-weight-semibold text-gray mb-0">
                        <a href="{{ $user->company?route('company_profile',[$user->company->slug]):route('user_profile',[$user->slug]) }}" target="_blank">
                            {{ $user->name }}
                        </a>
                      </p>
                    </div>
                    {{-- <small class="text-muted ml-auto">Edit event</small> --}}
                  </div>
                @endforeach

                {{-- <a class="d-block mt-5" href="{{ route('user', array) }}">Show all</a> --}}
              </div>
            </div>
          </div>

          <div class="col-md-6 grid-margin stretch-card">

                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title mb-0">Top Performer</h4>

                      @php
                          $performers = App\User::where('role_type','!=','admin')
                          ->withCount('reviews')
                          ->orderBy('reviews_count','Desc')
                          ->get()
                      @endphp
                      @foreach ($performers as $performer)
                      <div class="d-flex mt-3 py-2 border-bottom">
                        @if ($performer->role_type == 'company')
                        <img class="img-sm rounded-circle" src="{{ asset('storage/'.$performer->company->logo) }}" alt="{{ $performer->company->company_logo }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/cmp-icon.png') }}';">
                    @else
                        <img class="img-sm rounded-circle" src="{{ asset('storage/'.$performer->image) }}" alt="{{ $performer->name }}" onerror="this.onerror=null;this.src='{{ asset('images/resources/user-pic.png') }}';">
                    @endif

                        <div class="wrapper ml-2">
                          <p class="mb-n1 font-weight-semibold">
                            <a href="{{ $performer->company?route('company_profile',[$performer->company->slug]):route('user_profile',[$performer->slug]) }}" target="_blank">
                                {{ $performer->name }}
                            </a>
                          </p>
                          <small>{{ $performer->reviews->count() }} Reviews</small>
                        </div>
                        {{-- <small class="text-muted ml-auto">1 Hours ago</small> --}}
                      </div>
                      @endforeach


                    </div>
                  </div>


          </div>
        </div>


@endsection
