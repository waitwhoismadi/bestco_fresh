@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title w-100">CMS Pages</h4>
              <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">

                <ul class="quick-links ml-auto">
                  <li><a href="{{ route('cms.create') }}"><button class="btn btn-primary">Create Page</button></a></li>
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
            <h4 class="card-title">All Pages</h4>

            <table class="table table-striped" id="datatable">
              <thead>
                <tr>
                  <th> # </th>
                  <th>Page title </th>
                  <th>Page Content </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                  @foreach($pages as $key => $page)
                  <tr>
                    <td class="py-1">
                    {{ $key+1 }}
                    </td>
                    <td>
                    {{ $page->page_title }}
                    </td>

                    <td>
                        {{ Str::limit($page->page_description,50,'..') }}
                    </td>
                    <td>
                        <form action="{{ route('cms.destroy',[$page->id]) }}" method="post" id="page_delete{{ $page->id }}">
                        @csrf
                        @method('delete')
                        </form>
                        <a href="{{ route('cms.edit',[$page->id]) }}"><button class="btn btn-icons btn-rounded btn-success"><i class="fa fa-pencil"></i></button></a>
                        @if ($page->page_type == 'other')
                        <button class="btn btn-icons btn-rounded btn-danger" onclick="delete_record('page_delete',{{ $page->id }})"><i class="fa fa-trash-o"></i></button>
                        @endif

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


