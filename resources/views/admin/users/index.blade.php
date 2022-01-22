@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title">Users</h4>
              <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">

                <ul class="quick-links ml-auto">
                  <li><a href="{{ route('admin.user.create') }}"><button class="btn btn-primary">Add User</button></a></li>
                </ul>
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
            <h4 class="card-title">All Users</h4>

            <table class="table table-striped" id="datatable">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Name </th>
                  <th> Email </th>
                  <th> Phone </th>
                  <th> Category </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                  @foreach($users as $key => $user)
                  <tr>
                    <td class="py-1">
                    {{ $key+1 }}
                    </td>
                    <td>
                    {{ $user->name }}
                    </td>
                    <td>
                    {{ $user->email }}
                    </td>
                    <td>
                    {{ $user->phone }}
                    </td>
                    <td>
                    {{ $user->category_detail->category_name }}
                    </td>
                    <td>
                        <form action="{{ route('admin.user.delete',[$user->id]) }}" method="post" id="user_delete{{ $user->id }}">
                        @csrf
                        @method('delete')
                        </form>
                        <a href="{{ route('admin.user.edit',[$user->id]) }}"><button class="btn btn-icons btn-rounded btn-success"><i class="fa fa-pencil"></i></button></a>
                        <button class="btn btn-icons btn-rounded btn-danger" onclick="delete_record('user_delete',{{ $user->id }})"><i class="fa fa-trash-o"></i></button>
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


