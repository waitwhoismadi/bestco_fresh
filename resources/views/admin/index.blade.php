@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title">projects</h4>
              <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">

                {{-- <ul class="quick-links ml-auto">
                  <li><a href="{{ route('project.create') }}"><button class="btn btn-primary">Add New project</button></a></li>
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
            <h4 class="card-title">All projects</h4>

            <table class="table table-striped" id="datatable">
              <thead>
                <tr>
                  <th> # </th>
                  <th>project Title </th>
                  <th>Category </th>
                  <th>Budget </th>
                  <th>Avg Bid </th>
                  <th>Total Likes </th>
                  <th>Total Comments</th>
                  <th>Total Views</th>
                  <th>project Status </th>
                 <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($projects as $key => $project)
                  <tr>
                    <td class="py-1">
                    {{ $key+1 }}
                    </td>
                    <td>
                    <a href="{{ route('project_detail',[$project->slug]) }}" target="_blank">{{ Str::limit($project->title,20,'..') }}</a>
                    </td>
                    <td>
                    {{ $project->category_detail->category_name }}
                    </td>

                    <td>
                    $ {{ number_format($project->min_price) }} {{ $project->payment_type=='hr'?'/ hr':'' }}
                    </td>
                    <td>
                    $ {{ number_format($project->bids()->avg_bid($project->id)) }}
                    </td>
                        <td>
                            {{ $project->likes->count() }}
                        </td>
                        <td>
                            {{ $project->comments->count() }}
                        </td>
                        <td>
                        {{ number_format($project->view) }}
                        </td>
                    <td>
                        @if ($project->is_active)
                            <label class="badge badge-success">Open</label>
                        @else
                            <label class="badge badge-danger">Unbid</label>
                        @endif

                     </td>

                    <td>

                        <div class="dropdown">
                                <a type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>

                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                {{-- <a class="dropdown-item" href="{{ route('project.edit',[$project->id]) }}">Edit</a> --}}

                                {{--------------status Change Project -------------}}
                                    <form action="{{ route('project.change_status',[$project->id]) }}" method="post" id="project_statuschange{{ $project->id }}">
                                        @csrf
                                        @method('put')
                                    </form>
                                     <a class="dropdown-item" href="javascript:void(0)" onclick="$('#project_statuschange{{ $project->id }}').submit()">{{ $project->is_active?'Unbid':'Reopen Bid' }}</a>

                                <div class="dropdown-divider"></div>

                                {{--------------Delete Project -------------}}
                                <form action="{{ route('project.destroy',[$project->id]) }}" method="post" id="project_delete{{ $project->id }}">
                                    @csrf
                                    @method('delete')
                                    </form>
                                <a class="dropdown-item" onclick="delete_record('project_delete',{{ $project->id }})" href="javascript:void(0)">Delete</a>
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


