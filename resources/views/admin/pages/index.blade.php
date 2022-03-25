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
                    <x-card href="{{ route('admin.page.create') }}" class="btn btn-primary btn-sm float-right">
                        <x-slot:header>
                            List Pages
                        </x-slot>
                        <x-slot:link>
                            Add New
                        </x-slot>
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
                    </x-card>
                </div>
            </div>
        </div>
    </section>

    <x-modal id="edit_page">
        <x-slot:title>
            Edit Page
        </x-slot>
        <form method="POST" autocomplete="off">
            @csrf
            <input type="hidden" class="form-control" id="id">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" id="edit_title">
            </div>
            <div class="mb-3">
                <label class="form-label">URL</label>
                <input type="text" class="form-control" id="edit_url">
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea class="form-control" id="edit_content" rows="5"></textarea>
            </div>
        </form>
        <x-slot:text>
            Update Page
        </x-slot>
    </x-modal>

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

        function editForm(id) {
			$('#edit_page form')[0].reset();
			$.ajax({
				url:"{{ url('admin/page') }}" + '/' + id + "/edit",
				type: "GET",
				dataType:"json",
				success:function(data){
					$('#edit_page').modal('show');
					$('#id').val(data.id);
					$('#edit_title').val(data.title);
					$('#edit_url').val(data.url);
					$('#edit_content').val(data.content);
				}
			})
        }

        $('#btnedit').on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                $.ajax({
                    url: "{{ url('admin/page') }}" + '/' + id,
                    type: "POST",
                    data: $('#edit_page form').serialize(),
                        success: function(data) {
                            console.log(data)
                        $('#edit_page').modal('hide');
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            text: 'Data has been add!',
                            timer: 1500
                        });
                    }
                });
            }
            return false;
        });

        function deleteData(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					$.ajax({
                        url: "{{ url('admin/page') }}" + '/' + id,
                        type: "POST",
                        data: {'_method' : 'DELETE', '_token' : csrf_token},
                        success: function(data) {
                            table.ajax.reload();
                            swal.fire({
                                title: 'Success!',
                                text: "Data has been deleted!",
                                icon: "success",
                                timer: '1500'
                            })
                        },
                        error: function() {
                            swal.fire({
                                title: 'Oops...',
                                text: "Something went wrong!",
                                icon: "error",
                                timer: '1500'
                            })
                        }
                    })
				}
			})
        }
    </script>
@endsection