@extends('template.admin')
@section('title', 'UD Ilham')

@section('breadcrumb-title', 'Barang Keluar')
@section('breadcrumb-item', 'Barang Keluar')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <h3>Keterangan Barang Keluar</h3>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <button class="btn btn-primary" id="add-data" data-toggle="modal" data-target="#modal-form">
                        <i class="fa fa-plus"></i> Tambah Barang Keluar
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="form" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Barang Keluar</h5>
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
                                            <select name="item_id" class="form-control" id="item-id">
                                                <option value="">Nama Barang</option>
                                                @foreach($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="place" id="item-place" class="form-control" placeholder="Tempat Penyimpanan">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label for="" class="input-group-text">Kg</label>
                                                    <input type="hidden" name="quantity_unit" value="KG" id="quantity-unit">
                                                </div>
                                                <input type="number" name="quantity" id="item-quantity" class="form-control" placeholder="Jumlah Barang">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
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
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="">Tanggal Keluar</label>
                                                <input type="date" name="date_out" id="date-out"  class="form-control" placeholder="">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Masa Kadaluwarsa</label>
                                                <input type="date" name="date_expired" id="date-expired" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="action" id="action" value="add" />
                                    <input type="hidden" name="id" id="id" />
                                </div>
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
                                <h5 class="modal-title" id="modal-title">Konfirmasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span>Apakah anda yakin menghapus data ini?</span>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" id="delete-btn" name="delete_btn" class="btn btn-primary">Hapus</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="itemOut-table" class="table table-bordered table-striped dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tempat Penyimpanan</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Satuan Barang</th>
                            <th>Tanggal Keluar</th>
                            <th>Tanggal Kadaluwarsa</th>
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
        ajax: "{{ route('itemOut') }}",
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'place', name: 'place'},
            {data: 'items.code', name: 'items.code'},
            {data: 'items.name', name: 'items.name'},
            {data: 'quantity', name: 'quantity'},
            {data: 'quantity_unit', name: 'quantity_unit'},
            {data: 'date_out', name: 'date_out'},
            {data: 'date_expired', name: 'date_expired'},
            {data: 'items.image', name: 'items.image',
                render: function( data, type, full, meta ) {
                        return "<img src=\"/images/" + data + "\" height=\"50\"/>";
                    }
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    $('#add-data').click(function(){
        $('.modal-title').text('Barang Keluar');
        $('#action').val('Add');
        $('#action-btn').text('Tambah');
        $('#form_body').html('');
        $('#form')[0].reset();
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
        preview.style.display = 'block';
        previewBg.style.display = 'block';
    });
    $('#form').on('submit', function(event){
        event.preventDefault();
        var action_url = '';
        if($('#action').val()=='add'){
            action_url = "{{ route('itemOut.store') }}";
        }
        if($('#action').val()=='edit'){
            action_url = "{{ route('itemOut.update') }}";
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
                $('#itemOut-table').DataTable().ajax.reload();
                $('#form-body').html(html);
                $('#modal-form').modal('hide');
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        });
    });

    $(document).on('click', '.btn-edit', function(event){
        event.preventDefault();
        var id = $(this).attr('id');
        $('#form-body').html('');
        $('#action').val('edit');


        $.ajax({

            url :"/barangKeluar/edit/"+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            contentType: false,
            processData: false,
            success:function(data)
            {
                $('#item-name').val(data.result.name);
                $('#item-code').val(data.result.code);
                $('#item-quantity').val(data.result.quantity);
                $('#item-quantity-unit').val(data.result.quantity_unit);
                $('#date-out').val(data.result.date_out);
                $('#date-expired').val(data.result.date_expired);
                $('#item-place').val(data.result.place);
                $('#preview-image').attr('src',"images/"+ data.result.image);
                preview = document.getElementById('preview-image-bg');
                previewBg = document.getElementById('preview-image');
                preview.style.display = 'block';
                previewBg.style.display = 'block';
                $('#id').val(id);
                $('.modal-title').text('Edit Barang Keluar');
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
    });

    $('#delete-btn').click(function(){
        $.ajax({
            url:"barangKeluar/destroy/"+id,
            beforeSend:function(){
                $('#delete-btn').text('Sedang Menghapus...');
            },
            success:function(data)
            {
                setTimeout(function(){
                $('#modal-confirm').modal('hide');
                $('#itemOut-table').DataTable().ajax.reload();
                $('#delete-btn').text('Hapus');

                }, 2000);
            }
        })
    });
</script>
@endsection
