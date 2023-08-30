@extends('template.admin')
@section('title', 'UD Ilham')

@section('breadcrumb-title', 'Operator')
@section('breadcrumb-item', 'Operator')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <h3>Operator</h3>
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                    <button id="add-data" class="btn btn-primary" data-toggle="modal" data-target="#modal-form">
                        <i class="fa fa-plus"></i> Tambah Operator
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="form"  method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Operator</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span id="form-body"></span>
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Nomor Telepon">
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="action" id="action" value="add" />
                                <input type="hidden" name="id" id="id" />
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" id="action-btn" name="action-btn" class="btn btn-primary">Simpan</button>
                                <button type="button" id="cancel-btn" name="cancel-btn" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-confirm" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span>Apakah anda yakin menghapus data operator ini?</span>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" id="delete-btn" name="delete_btn" class="btn btn-primary">Hapus</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <table id="operator-table" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nama Lengkap</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$(function () {
    var table = $('.dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('operator') }}",
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'name', name: 'name'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    $('#add-data').click(function(){
        $('.modal-title').text('Operator');
        $('#action').val('add');
        $('#action-btn').text('Tambah');
        $('#form_body').html('');
        $('#form')[0].reset();
        $('#modal-form').modal('show');
    });
    $('#form').on('submit', function(event){
        event.preventDefault();
        var action_url = '';
        if($('#action').val()=='add'){
            action_url = "{{ route('operator.store') }}";
        }
        if($('#action').val()=='edit'){
            action_url = "{{ route('operator.update') }}";
        }
        var formData = new FormData(this);

        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },
            url: action_url,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function(data) {

                var html = '';

                $('#operator-table').DataTable().ajax.reload();
                $('#form')[0].reset();

                $('#form-body').html(html);
                $('#modal-form').modal('hide');

            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        });
    })
    $(document).on('click', '.btn-edit', function(event){
        event.preventDefault();
        var id = $(this).attr('id');
        $('#form-body').html('');
        $('#action').val('edit');
        $.ajax({

            url :"/operator/edit/"+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            contentType: false,
            processData: false,
            success:function(data)
            {
                $('#username').val(data.result.username);
                $('#email').val(data.result.email);
                $('#name').val(data.result.name);
                $('#phone').val(data.result.phone);
                $('#password').val(data.result.password);
                $('#id').val(id);
                $('.modal-title').text('Edit Operator');
                $('#action-btn').text('Update');
                $('#modal-form').modal('show');
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }

        });

    })
    $(document).on('click', '.btn-delete', function(){
        id = $(this).attr('id');
        $('#modal-confirm').modal('show');
        $('.modal-title').text('Konfirmasi Hapus Operator');
    });

    $('#delete-btn').click(function(){
        $.ajax({
            url:"operator/destroy/"+id,
            beforeSend:function(){
                $('#delete-btn').text('Sedang Menghapus...');
            },
            success:function(data)
            {
                setTimeout(function(){
                $('#modal-confirm').modal('hide');
                $('#operator-table').DataTable().ajax.reload();
                $('#delete-btn').text('Hapus');

                }, 2000);
            }
        })
    });
</script>
@endsection
