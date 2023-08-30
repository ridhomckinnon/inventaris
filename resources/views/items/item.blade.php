@extends('template.admin')
@section('title', 'UD Ilham')

@section('breadcrumb-title', 'Barang')
@section('breadcrumb-item', 'Barang')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">

            <div class="row justify-content-between">
                <div class="col-md-4">

                    <h3>Jumlah Barang Keseluruhan</h3>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-5">
                            <button class="btn btn-success w-100" id="import-data" data-toggle="modal" data-target="#modal-import">
                                <i class="fa fa-file-import"></i> Import
                            </button>
                        </div>
                        <div class="col-md-7">
                            <button class="btn btn-primary w-100" id="add-data" data-toggle="modal" data-target="#modal-form">
                                <i class="fa fa-plus"></i> Tambah Barang
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
                                <h5 class="modal-title" id="modal-title">Barang</h5>
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
                                                <input type="text" name="code" id="code" class="form-control" placeholder="Kode Barang">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Barang">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="type" id="type" class="form-control" placeholder="Jenis Barang">
                                            </div>
                                        </div>


                                        <!-- <div class="col-md-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="place" id="item-place" class="form-control" placeholder="Tempat Penyimpanan">
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label for="" class="input-group-text">Kg</label>
                                                    </div>
                                                    <input type="number" name="quantity" id="item-quantity" class="form-control" placeholder="Jumlah Barang">

                                                </div>

                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-12 col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <label for="" class="input-group-text">Rp</label>
                                                        </div>
                                                        <input type="number" name="cost_price" id="item-cost-price" class="form-control" placeholder="Harga Pokok">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <label for="" class="input-group-text">Rp</label>
                                                        </div>
                                                        <input type="number" name="sell_price" id="item-sell-price" class="form-control" placeholder="Harga Jual">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-md-12 col-sm-6">
                                            <div class="form-group">
                                                <select name="status" id="item-status" class="form-control">
                                                    <option value="">Status</option>
                                                    <option value="Fresh">Fresh</option>
                                                    <option value="Frozen">Frozen</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Masa Kadaluwarsa</label>
                                                <input type="date" name="date_expired" id="date-expired" class="form-control">
                                            </div>
                                        </div> -->
                                        <div class="col-md-12 col-sm-6 ">
                                            <div id="preview-image-bg" class="bg-light p-2 mb-2" style="display:none;position: relative;width:100px; height:100px">
                                                <img id="preview-image" src="#" style="display:none;width:100%">
                                            </div>
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="item-image" name="image">
                                                <button class="btn btn-sm btn-danger position-absolute" id="clear-preview" style="display:none;right:0;bottom: 15px;">&times;</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6">
                                            <div class="form-group">
                                                <textarea name="description" id="description" class="form-control" placeholder="Keterangan"></textarea>
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
                        <form action="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span>Apakah anda yakin menghapus data barang ini?</span>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" id="delete-btn" class="btn btn-primary">Hapus</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="modal-detail" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="GET">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Lihat Detail</h5>
                                <button id="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span id="detail-body"></span>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div id="img-detail">

                                        </div>
                                    </div>
                                    <div class="col-md-7">

                                        <p > Kode Barang : <span id="code-detail"></span></p>
                                        <p > Nama Barang : <span id="name-detail"></span></p>
                                        <p > Deskripsi : <span id="description-detail"></span></p>

                                        <!-- <p > Tanggal Expired :  <ul id="date-expired-detail"></ul></p> -->
                                    </div>
                                </div>
                                <div class="table-responsive">

                                    <table class="table table-bordered" id="table-detail">
                                        <thead>
                                            <tr>
                                                <th >Nomor Masuk</th>
                                                <th >Tempat</th>
                                                <th >Status</th>
                                                <th >Harga Pokok</th>
                                                <th >Harga Jual</th>
                                                <th >Tanggal Kadaluwarsa</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-detail">
                                            <tr>
                                                <td id="no-in-detail"></td>
                                                <td id="place-detail"></td>
                                                <td id="status-detail"></td>
                                                <td id="cost-price-detail"></td>
                                                <td id="sell-price-detail"></td>
                                                <td id="date-expired-detail"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="modal-import" aria-hidden="true">
                <div class="modal-dialog" role="import">
                    <div class="modal-content">
                        <form action="{{ route('item.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-import-title">Import Barang</h5>
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
                <table id="item-table" class="table table-bordered table-striped  dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Total Barang</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
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
$(function(){
    var table = $('.dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('item') }}",
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'type', name: 'type'},
            {data: 'quantity', name: 'quantity'},
            {data: 'description', name: 'description'},
            {data: 'image', name: 'image',
                render: function( data, type, full, meta ) {
                        return "<img src=\"/images/" + data + "\" height=\"50\"/>";
                    }
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    $('#add-data').click(function(){
        $('.modal-title').text('Barang');
        $('#action').val('Add');
        $('#action-btn').text('Tambah');
        $('#form_body').html('');
        $('#form')[0].reset();
        $('#clear-preview').hide();
        $('#preview-image').attr('src', '');
        $('#preview-image-bg').hide();
        $('#modal-form').modal('show');
    });
    $('#item-image').change(function() {
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
        $('#item-image').val('');

    })
    $('#form').on('submit', function(event){
        event.preventDefault();
        var action_url = '';
        if($('#action').val()=='add'){
            action_url = "{{ route('item.store') }}";
        }
        if($('#action').val()=='edit'){
            action_url = "{{ route('item.update') }}";
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
                console.log('success: '+data);
                var html = '';
                // if(data.errors)
                // {
                //     html = '<div class="alert alert-danger">';
                //     for(var count = 0; count < data.errors.length; count++)
                //     {
                //         html += '<p>' + data.errors[count] + '</p>';
                //     }
                //     html += '</div>';
                // }
                // if(data.success)
                // {
                //     html = '<div class="alert alert-success">' + data.success + '</div>';
                // }
                $('#form')[0].reset();
                $('table').DataTable().ajax.reload();
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
    });
    $(document).on('click', '.close', function(event){
        $('#name-detail').text('');
        $('#code-detail').text('');
        $('#description-detail').text('');
        $("#no-in-detail").text('');
        $("#place-detail").text('');
        $("#status-detail").text('');
        $("#cost-price-detail").text('');
        $("#sell-price-detail").text('');
        $("#date-expired-detail").text('');
        $('#img-detail .img-fluid').attr('src', '');
    })
    $(document).on('click', '.btn-detail', function(event){
        event.preventDefault();
        var id = $(this).attr('id');
        $('#detail-body').html('');
        $.ajax({
            url :"/barang/detail/"+ id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            contentType: false,
            processData: false,
            success:function(data)
            {
                console.log(data);
                $('#name-detail').text(data.result.name);
                $('#code-detail').text(data.result.code);
                $('#description-detail').text(data.result.description);
                $('#img-detail').append("<img class=\"img-fluid\" src=\"/images/" + data.result.image + "\" width=\"180\"/>")


                table = []
                data.result.item_in.forEach(el => {
                    table.push(el);
                })
                $.each(table, function(index, value){
                    $("#no-in-detail").append(value.no_in + '<br>');
                    $("#place-detail").append(value.place + '<br>');
                    $("#status-detail").append(value.status + '<br>');
                    $("#cost-price-detail").append(value.cost_price + '<br>');
                    $("#sell-price-detail").append(value.sell_price + '<br>');
                    $("#date-expired-detail").append(value.date_expired + '<br>');
                });


                $('#id').val(id);
                $('#modal-detail').modal('show');

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

            url :"/barang/edit/"+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            contentType: false,
            processData: false,
            success:function(data)
            {
                console.log(data);
                $('#name').val(data.result.name);
                $('#code').val(data.result.code);
                $('#type').val(data.result.type);
                $('#description').val(data.result.description);
                $('#preview-image').attr('src',"images/"+ data.result.image);
                preview = document.getElementById('preview-image-bg');
                previewBg = document.getElementById('preview-image');
                preview.style.display = 'block';
                previewBg.style.display = 'block';
                $('#id').val(id);
                $('.modal-title').text('Edit Barang');
                $('#action-btn').text('Update');
                $('#modal-form').modal('show');
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }

        });

    });

    var id;

    $(document).on('click', '.btn-delete', function(){
        id = $(this).attr('id');
        $('#modal-confirm').modal('show');
        $('.modal-title').text('Konfirmasi Hapus Barang');
    });

    $('#delete-btn').click(function(){
        $.ajax({
            url:"barang/destroy/"+id,
            beforeSend:function(){
                $('#delete-btn').text('Sedang Menghapus...');
            },
            success:function(data)
            {
                setTimeout(function(){
                $('#modal-confirm').modal('hide');

                $('table').DataTable().ajax.reload();
                $('#delete-btn').text('Hapus');

                }, 2000);
            }
        })
    });
</script>
@endsection
