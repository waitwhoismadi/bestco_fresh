@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title">Jobs</h4>
              <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">

                {{-- <ul class="quick-links ml-auto">
                  <li><a href="{{ route('job.create') }}"><button class="btn btn-primary">Add New Job</button></a></li>
                </ul> --}}
              </div>
            </div>
          </div>

        </div>
        <!-- Page Title Header Ends-->


        <!---------------page Content----------------->

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">All Jobs</h4>

            <table class="table table-striped" id="datatable">
              <thead>
                <tr>
                  <th> # </th>
                  <th>Job Title </th>
                  <th>Category </th>
                  <th>Job Type </th>
                  <th>Salary </th>
                  <th>Total Likes </th>
                  <th>Total Comments</th>
                  <th>Total Views</th>
                  <th>Job Status </th>
                 <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($jobs as $key => $job)
                  <tr>
                    <td class="py-1">
                    {{ $key+1 }}
                    </td>
                    <td>
                    <a href="{{ route('job_detail',[$job->slug]) }}" target="_blank">{{ Str::limit($job->title,20,'..') }}</a>
                    </td>
                    <td>
                    {{ $job->category_detail->category_name }}
                    </td>
                    <td>
                    {{ $job->job_types?$job->job_types->type }}
                    </td>
                    <td>
                    ₹ {{ number_format($job->min_price) }}
                    </td>
                        <td>
                            {{ $job->likes->count() }}
                        </td>
                        <td>
                            {{ $job->comments->count() }}
                        </td>
                        <td>
                        {{ number_format($job->view) }}
                        </td>
                    <td>
                        @if ($job->is_active)
                            <label class="badge badge-success">Open</label>
                        @else
                            <label class="badge badge-danger">Close</label>
                        @endif

                     </td>

                    <td>

                        <div class="dropdown">
                                <a type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>

                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                {{-- <a class="dropdown-item" href="{{ route('job.edit',[$job->id]) }}">Edit</a> --}}
                                    <form action="{{ route('job.change_status',[$job->id]) }}" method="post" id="job_statuschange{{ $job->id }}">
                                        @csrf
                                        @method('put')
                                    </form>
                                     <a class="dropdown-item" href="javascript:void(0)" onclick="$('#job_statuschange{{ $job->id }}').submit()">{{ $job->is_active?'Job Close':'Job Open' }}</a>

                                <div class="dropdown-divider"></div>
                                <form action="{{ route('job.destroy',[$job->id]) }}" method="post" id="job_delete{{ $job->id }}">
                                    @csrf
                                    @method('delete')
                                    </form>
                                <a class="dropdown-item" onclick="delete_record('job_delete',{{ $job->id }})" href="javascript:void(0)">Delete</a>
                            </div>

                        </div>

                    </td>
                  </tr>
                  @endforeach


              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
        <!---------------page Content end----------------->


@endsection


