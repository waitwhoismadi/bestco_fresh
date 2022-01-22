@extends('admin.layouts.app')
@section('content')


        <!-- Page Title Header Starts-->
        <div class="row page-title-header">
          <div class="col-12">
            <div class="page-header">
              <h4 class="page-title">Companies</h4>
              <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">

                <ul class="quick-links ml-auto">
                  <li><a href="{{ route('admin.company.create') }}"><button class="btn btn-primary">Add Company</button></a></li>
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
            <h4 class="card-title">All Companies</h4>

            <table class="table table-striped" id="datatable">
              <thead>
                <tr>
                  <th> # </th>
                  <th>Company Name </th>
                  <th>Company Email </th>
                  <th>Contact No. </th>
                  <th> Industry </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                  @foreach($companies as $key => $company)
                  <tr>
                    <td class="py-1">
                    {{ $key+1 }}
                    </td>
                    <td>
                    {{ $company->company_name }}
                    </td>
                    <td>
                    {{ $company->email }}
                    </td>
                    <td>
                    {{ $company->contact_no }}
                    </td>
                    <td>
                    {{ $company->industry_detail->industry_name }}
                    </td>
                    <td>
                        <form action="{{ route('admin.company.delete',[$company->id]) }}" method="post" id="company_delete{{ $company->id }}">
                        @csrf
                        @method('delete')
                        </form>
                        <a href="{{ route('admin.company.edit',[$company->id]) }}"><button class="btn btn-icons btn-rounded btn-success"><i class="fa fa-pencil"></i></button></a>
                        <button class="btn btn-icons btn-rounded btn-danger" onclick="delete_record('company_delete',{{ $company->id }})"><i class="fa fa-trash-o"></i></button>
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


