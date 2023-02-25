@extends('layouts.master', ['activePage' => 'companies'])
@section('title', 'Admin-Panel')
@section('page-styles')
@endsection
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if (session('success'))
      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="material-icons">close</i>
            </button>
            <span>{{ session('success') }}</span>
          </div>
        </div>
      </div>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Companies</h3>
                <div class="text-right">
                  <a class="btn btn-success" href="{{ route('companies.create') }}">Create</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="companies" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($companies as $company)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $company->name ?? ''}}</td>
                    <td>{{ $company->email ?? ''}}</td>
                    <td>
                      <img src="{{ asset('/storage/'.$company->logo) }}" height="50">
                    </td>
                    <td>{{ $company->website ?? ''}}</td>
                    <td>
                      <form action="{{ route('companies.destroy',$company->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('companies.show',$company->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
       
                        @csrf
                        @method('DELETE')
          
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                  </tr>
                  @endforeach
                  </tfoot>
                </table>
                {!! $companies->links() !!}
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('page-script')
<script>
  $(function () {
    $("#companies").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container();
  });
</script>
@endsection