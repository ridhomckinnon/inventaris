@extends('template.admin')
@section('title', 'UD Ilham')

@section('breadcrumb-title', 'Pelanggan')
@section('breadcrumb-item', 'Pelanggan')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <h3>Pelanggan</h3>
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                    <button id="add-data" class="btn btn-primary" data-toggle="modal" data-target="#modal-form">
                        <i class="fa fa-plus"></i> Tambah Pelanggan
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
                                <h5 class="modal-title" id="modal-title">Pelanggan</h5>
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
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Nomor Telepon">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                            <div class="form-group">
                                                <textarea name="address" id="address" class="form-control" id="" placeholder="Alamat"></textarea>
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
                                <span>Apakah anda yakin menghapus data pelanggan ini?</span>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" id="delete-btn" name="delete_btn" class="btn btn-primary">Hapus</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <table id="customer-table" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
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
        ajax: "{{ route('customer') }}",
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    $('#add-data').click(function(){
        $('.modal-title').text('Pelanggan');
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
            action_url = "{{ route('customer.store') }}";
        }
        if($('#action').val()=='edit'){
            action_url = "{{ route('customer.update') }}";
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

                $('#customer-table').DataTable().ajax.reload();
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

            url :"/pelanggan/edit/"+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            contentType: false,
            processData: false,
            success:function(data)
            {
                $('#email').val(data.result.email);
                $('#name').val(data.result.name);
                $('#phone').val(data.result.phone);
                $('#address').val(data.result.address);
                $('#id').val(id);
                $('.modal-title').text('Edit Pelanggan');
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
        $('.modal-title').text('Konfirmasi Hapus Pelanggan');
    });

    $('#delete-btn').click(function(){
        $.ajax({
            url:"pelanggan/destroy/"+id,
            beforeSend:function(){
                $('#delete-btn').text('Sedang Menghapus...');
            },
            success:function(data)
            {
                setTimeout(function(){
                $('#modal-confirm').modal('hide');
                $('#customer-table').DataTable().ajax.reload();
                $('#delete-btn').text('Hapus');

                }, 2000);
            }
        })
    });
</script>
@endsection
