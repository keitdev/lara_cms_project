@extends('layouts.backend.app')
@section('title', 'Dashboard')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title float-left">List Pages</h4>
                            <button type="button" data-toggle="modal" id="addcatmodal" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> Add New</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="page_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>URL</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#page_table').DataTable({
            responsive: true,
            autoWidth: false,
            ajax: {
				url: "{{ route('admin.page.index') }}",
				type: 'GET',
			},
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'title', name: 'title'},
                {data: 'url', name: 'url'},
                {data: 'content', name: 'content'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        });
    </script>
@endsection