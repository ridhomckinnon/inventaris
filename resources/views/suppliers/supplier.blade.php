@extends('template.admin')
@section('title', 'UD Ilham')

@section('breadcrumb-title', 'Supplier')
@section('breadcrumb-item', 'Supplier')

@section('content')

<div class="col-md-12">
<!-- general form elements disabled -->
    <div class="card">
        <div class="card-header">

            <div class="row justify-content-between">
                <div class="col-md-4">
                    <h3>Supplier</h3>
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-end">
                        <div class="col-md-3">
                            <a href="{{ route('supplier.export') }}" target="_blank" class="btn btn-success w-100"><i class="fa fa-file-export"></i> Export</a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-info w-100" id="import-data" data-toggle="modal" data-target="#modal-import">
                                <i class="fa fa-file-import"></i> Import
                            </button>
                        </div>
                        <div class="col-md-4">
                            <button id="add-data" class="btn btn-primary w-100" data-toggle="modal" data-target="#modal-form">
                                <i class="fa fa-plus"></i> Tambah Supplier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="form" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Supplier</h5>
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
                                                <input type="text" name="code"  id="code" class="form-control" placeholder="Kode">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Supplier">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="number" name="phone" id="phone" class="form-control" placeholder="Nomor Telepon">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6">
                                            <div class="form-group">
                                                <textarea name="address" id="address" class="form-control" id="" placeholder="Alamat"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6">
                                            <div id="preview-image-bg" class="bg-light p-2 mb-2" style="display:none;position: relative;width:100px; height:100px">
                                                <img id="preview-image" src="#" style="display:none;width:100%">
                                            </div>
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="logo" name="logo">
                                                <button class="btn btn-sm btn-danger position-absolute" id="clear-preview" style="display:none;right:0;bottom: 15px;">&times;</button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="action" id="action" value="add" />
                                    <input type="hidden" name="id" id="id" />
                                </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" name="action-btn" id="action-btn" class="btn btn-primary"></button>

                                <button type="button" id="cancel-btn" name="cancel-btn" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-confirm" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span>Apakah anda yakin menghapus data supplier ini?</span>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" id="delete-btn" name="delete_btn" class="btn btn-primary">Hapus</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="modal-import" aria-hidden="true">
                <div class="modal-dialog" role="import">
                    <div class="modal-content">
                        <form action="{{ route('supplier.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-import-title">Import Supplier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="file" name="file" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" id="import-btn" class="btn btn-primary">Import</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="table-supplier" class="table table-bordered table-striped dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Supplier</th>
                            <th>Nama Supplier</th>
                            <th>Alamat Supplier</th>
                            <th>Nomor Telepon</th>
                            <th>Logo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
        ajax: "{{ route('supplier') }}",
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'address', name: 'address'},
            {data: 'phone', name: 'phone'},
            {data: 'logo', name: 'logo',
                render: function( data, type, full, meta ) {
                        return "<img src=\"/images/" + data + "\" height=\"50\"/>";
                    }
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    $('#add-data').click(function(){
        $('.modal-title').text('Supplier');
        $('#action').val('add');
        $('#action-btn').text('Tambah');
        $('#form_body').html('');
        $('#form')[0].reset();
        $('#clear-preview').hide();
        $('#preview-image').attr('src', '');
        $('#preview-image-bg').hide();
        $('#modal-form').modal('show');
    });
    $('#logo').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        preview = document.getElementById('preview-image');
        previewBg = document.getElementById('preview-image-bg');
        clearPreview = document.getElementById('clear-preview');
        preview.style.display = 'block';
        previewBg.style.display = 'block';
        clearPreview.style.display = 'block';
    });

    $('#clear-preview').click(function(){
        $('#preview-image-bg').hide();
        $('#preview-image').attr('src', '');
        $('#logo').val('');

    })

    $('#form').on('submit', function(event){
        event.preventDefault();
        var action_url = '';
        if($('#action').val()=='add'){
            action_url = "{{ route('supplier.store') }}";
        }
        if($('#action').val()=='edit'){
            action_url = "{{ route('supplier.update') }}";
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

                $('#form')[0].reset();
                $('#table-supplier').DataTable().ajax.reload();
                $('#form-body').html(html);
                $('#modal-form').modal('hide');
                Swal.fire({
                icon: 'success',
                position: 'top-end',
                showCloseButton: false,
                showConfirmButton: false,
                text: 'Berhasil Tambah Data',
                timer: 1500,

                })

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

            url :"/supplier/edit/"+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            contentType: false,
            processData: false,
            success:function(data)
            {
                console.log(data)
                $('#name').val(data.result.name);
                $('#code').val(data.result.code);
                $('#address').val(data.result.address);
                $('#phone').val(data.result.phone);
                $('#preview-image').attr('src',"images/"+ data.result.logo);
                preview = document.getElementById('preview-image');
                previewBg = document.getElementById('preview-image-bg');
                preview.style.display = 'block';
                previewBg.style.display = 'block';
                $('#id').val(id);
                $('.modal-title').text('Edit Supplier');
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
        $('.modal-title').text('Konfirmasi Hapus Supplier');
    });

    $('#delete-btn').click(function(){
        $.ajax({
            url:"supplier/destroy/"+id,
            beforeSend:function(){
                $('#delete-btn').text('Sedang Menghapus...');
            },
            success:function(data)
            {
                setTimeout(function(){
                $('#modal-confirm').modal('hide');
                $('#table-supplier').DataTable().ajax.reload();
                $('#delete-btn').text('Hapus');

                }, 2000);
                Swal.fire({
                    icon: 'success',
                    text: 'Berhasil Hapus Data',
                    position: 'top-end',
                    showCloseButton: true,
                    showConfirmButton: false,
                    timer: 1500,


                })
            }
        })
    });
</script>
@endsection
