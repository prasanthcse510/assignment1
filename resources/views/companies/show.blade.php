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
                  <a class="btn btn-success" href="{{ route('companies.index') }}">Back</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-5">
                    <img src="{{ asset('/images/'.$company->logo) }}" height="150px">
                  </div>
                  <div class="col-md-7">
                    <div class="row">
                      <div class="col-md-4"><strong>Name</strong></div>
                      <div class="col-md-8">{{ $company->name }}</div>
                    </div>

                    <div class="row">
                      <div class="col-md-4"><strong>Email</strong></div>
                      <div class="col-md-8">{{ $company->email }}</div>
                    </div>
                    <div class="row">
                      <div class="col-md-4"><strong>Website</strong></div>
                      <div class="col-md-8">{{ $company->website }}</div>
                    </div>
                  </div>
                </div>
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