@extends('layouts.backend.app')
@section('title', 'Dashboard')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add New Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add New Page</li>
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
                            <h4 class="card-title float-left">Add New Page</h4>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <form method="POST" autocomplete="off">
                                            @csrf
                                            <input type="hidden" value="{{ Auth::user()->id }}" id="user_id">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" id="title">
                                            </div>
                                            <div class="form-group">
                                                <label>URL</label>
                                                <input type="text" class="form-control" id="url">
                                            </div>
                                            <div class="form-group">
                                                <label>Content</label>
                                                <textarea class="form-control" id="content" rows="5"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-sm">Publish</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

        $('form').on('submit', function(e) {
            e.preventDefault();
            var title = $('#title').val();
            var url = $('#url').val();
            var content = $('#content').val();
            var user_id = $('#user_id').val();
            $.ajax({
                url: "{{ url('admin/page') }}",
                type: "POST",
                data: {
                    title: title,
                    url: url,
                    content: content,
                    user_id: user_id
                },
                success: function(data) {
                    console.log(data)
                    $('form')[0].reset();
                    swal.fire({
                        title: 'Success!',
                        text: "Data has been inserted!",
                        type: "success",
                        timer: '1500'
                    })
                },
                error: function(data) {
                    console.log(data)
                    swal.fire({
                        title: 'Oops...',
                        text: "Something went wrong!",
                        type: "error",
                        timer: '1500'
                    })
                }
            });
        });
    </script>
@endsection