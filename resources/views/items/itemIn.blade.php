@extends('template.admin')
@section('title', 'UD Ilham')

@section('breadcrumb-title', 'Barang Masuk')
@section('breadcrumb-item', 'Barang Masuk')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <h3>Keterangan Barang Masuk</h3>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <button class="btn btn-primary" id="add-data" data-toggle="modal" data-target="#modal-form">
                        <i class="fa fa-plus"></i> Tambah Barang Masuk
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
                                <h5 class="modal-title" id="modal-title">Barang Masuk</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span id="form-body"></span>
                                @csrf
                                <!-- <ul class="nav nav-tabs mb-3 justify-content-around" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link tab active" id="item-new-tab" data-toggle="tab" href="#item-new" role="tab" aria-controls="" aria-selected="true">Barang Baru</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tab" id="item-old-tab" data-toggle="tab" href="#item-old" role="tab" aria-controls="" aria-selected="false">Barang Lama</a>
                                    </li>

                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="item-new" role="tabpanel" aria-labelledby="item-new-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="code" id="item-code" class="form-control" placeholder="Kode Barang">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="name" id="item-name" class="form-control" placeholder="Nama Barang">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-6">
                                                <div class="form-group">
                                                    <select name="supplier_id" id="supplier-name" class="form-control">
                                                        <option value="">Supplier</option>
                                                        @foreach($suppliers as $supplier)
                                                        <option value="{{ $supplier->id}}">{{ $supplier->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="place" id="item-place" class="form-control" placeholder="Tempat Penyimpanan">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <input type="number" name="quantity" id="item-quantity" class="form-control" placeholder="Jumlah Barang">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <input type="number" name="weight" id="item-weight" class="form-control" placeholder="Berat Barang">
                                                            <div class="input-group-append">
                                                                <select name="quantity_unit" class="custom-select" id="item-quantity_unit">
                                                                    <option value="KG">Kg</option>
                                                                    <option value="PAX">Pax</option>
                                                                </select>
                                                            </div>
                                                        </div>
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
                                            </div>
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
                                                        <textarea name="description" id="item-description" class="form-control" placeholder="Keterangan"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="tab-pane fade" id="item-old" role="tabpanel" aria-labelledby="item-old-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="place" id="item-place" class="form-control" placeholder="Tempat Penyimpanan">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-6">
                                                <div class="form-group">
                                                    <select name="item_id" class="form-control" id="">
                                                        <option value="">Nama Barang</option>
                                                        @foreach($items as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-6">
                                                <div class="form-group">

                                                    <div class="input-group">
                                                        <input type="number" name="quantity" id="item-quantity" class="form-control" placeholder="Jumlah Barang">
                                                        <div class="input-group-append">
                                                            <select name="quantity_unit" id="item-quantity-unit" class="custom-select" id="">
                                                                <option value="KG">Kg</option>
                                                                <option value="PAX">Pax</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-6">
                                                <div class="form-group">
                                                    <select name="supplier_id" su id="supplier-name" class="form-control">
                                                        <option value="">Supplier</option>
                                                        @foreach($suppliers as $supplier)
                                                        <option value="{{ $supplier->id}}">{{ $supplier->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="">Tanggal Masuk</label>
                                                        <input type="date" name="date_in" id="date-in"  class="form-control" placeholder="">
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
                                </div> -->
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
                                            <input type="number" name="no_in" id="no-in" class="form-control" placeholder="Nomor Masuk">

                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="place" id="place" class="form-control" placeholder="Tempat Penyimpanan">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <select name="supplier_id" id="supplier-id" class="form-control">
                                                <option value="">Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                <option value="{{ $supplier->id}}">{{ $supplier->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label for="" class="input-group-text">Kg</label>
                                                    <input type="hidden" name="quantity_unit" value="KG" id="quantity-unit">
                                                </div>
                                                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Jumlah Barang">
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
                                                    <input type="number" name="cost_price" id="cost-price" class="form-control" placeholder="Harga Pokok">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label for="" class="input-group-text">Rp</label>
                                                    </div>
                                                    <input type="number" name="sell_price" id="sell-price" class="form-control" placeholder="Harga Jual">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Status</option>
                                                <option value="Fresh">Fresh</option>
                                                <option value="Frozen">Frozen</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="">Tanggal Masuk</label>
                                                <input type="date" name="date_in" id="date-in"  class="form-control" placeholder="">
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
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="submit" id="action-btn" name="action-btn" class="btn btn-primary">Simpan</button>
                                    <button type="button" id="cancel-btn" name="cancel-btn" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                </div>
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
                                <span>Apakah anda yakin menghapus data barang masuk ini?</span>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" id="delete-btn" name="delete_btn" class="btn btn-primary">Hapus</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs nav-justified mb-3" id="tabs-tab" role="tablist">
                @foreach($types as $type)
                <li class="nav-item">
                    <a href="{{ route('itemIn',['type' => $type->name ? : '']) }}" id="{{ $type->name }}" role="tab" aria-controls="tabs-{{ $type->name }}" aria-selected="true"  class="nav-link">{{ $type->name }}</a>
                </li>
                @endforeach
            </ul>
            <div class="tab-content" id="tabs-tabContent">
                @foreach($types as $type)
                <div class="tab-pane {{ $typeTab == $type->name ? 'active' : '' }}" id="tabs-{{ $type->name }}"">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tempat Penyimpanan</th>
                                    <th>Nomor Masuk</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Supplier</th>
                                    <th>Jumlah Barang</th>
                                    <th>Satuan Barang</th>
                                    <th>Status</th>
                                    <th>Harga Pokok</th>
                                    <th>Harga Jual</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Kadaluwarsa</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                        </table>

                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

</div>

@endsection

@section('script')
<script>
$(function(){
    $.urlParam = function(type){
    var results = new RegExp('[\?&]' + type + '=([^&#]*)').exec(window.location.href);
        if (results==null) {
        return null;
        }
        return decodeURI(results[1]) || 0;
    }
    var type = $.urlParam('type');
    if(type == null){
        // console.log('a')
        type = 'asdasd'
    }

    var table = $('.dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/barangMasuk?type=" + type,
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'place', name: 'place'},
            {data: 'no_in', name: 'no_in'},
            {data: 'items.code', name: 'items.code'},
            {data: 'items.name', name: 'items.name'},
            {data: 'supplier.name', name: 'supplier.name'},
            {data: 'quantity', name: 'quantity'},
            {data: 'quantity_unit', name: 'quantity_unit'},
            {data: 'status', name: 'status'},
            {data: 'cost_price', name: 'cost_price'},
            {data: 'sell_price', name: 'sell_price'},
            {data: 'date_in', name: 'date_in'},
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
        $('.modal-title').text('Barang Masuk');
        $('#action').val('Add');
        $('#action-btn').text('Tambah');
        $('#form_body').html('');
        $('#form')[0].reset();
        $('#preview-image-bg').hide();
        $('#modal-form').modal('show');
    });

    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function(e){
        var x = $(e.target).text();
        console.log(x);
    })
    $('#form').on('submit', function(event){
        event.preventDefault();
        var a = $('.shown.bs-tab').text();
        console.log(a);
        var action_url = '';
        if($('#action').val()=='edit'){
            action_url = "{{ route('itemIn.update') }}";
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
                $('#itemIn-table').DataTable().ajax.reload();
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

            url :"/barangMasuk/edit/"+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            contentType: false,
            processData: false,
            success:function(data)
            {
                $('#item-id').val(data.result.item_id);
                $('#no-in').val(data.result.no_in);
                $('#supplier-id').val(data.result.supplier_id);
                $('#quantity').val(data.result.quantity);
                $('#date-in').val(data.result.date_in);
                $('#date-expired').val(data.result.date_expired);
                $('#place').val(data.result.place);
                $('#cost-price').val(data.result.cost_price);
                $('#sell-price').val(data.result.sell_price);
                $('#status').val(data.result.status);

                $('#id').val(id);
                $('.modal-title').text('Edit Barang Masuk');
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
        $('.modal-title').text('Konfirmasi Hapus Barang Masuk');
    });

    $('#delete-btn').click(function(){
        $.ajax({
            url:"barangMasuk/destroy/"+id,
            beforeSend:function(){
                $('#delete-btn').text('Sedang Menghapus...');
            },
            success:function(data)
            {
                setTimeout(function(){
                $('#modal-confirm').modal('hide');
                $('#itemIn-table').DataTable().ajax.reload();
                $('#delete-btn').text('Hapus');

                }, 2000);
            }
        })
    });
    // var activeTab = $('.nav-tabs .active');

    // var activeTabUrl = activeTab.attr('data-url');

    // $.get(activeTabUrl, function(data) {
    //   $('#' + activeTab.attr('href').slice(1)).html(data);
    // });

    // $('.nav-tabs a').on('click', function(event) {
    //   event.preventDefault();

    //   var tabUrl = $(this).attr('data-url');

    //   $.get(tabUrl, function(data) {
    //     $('#' + $(event.target).attr('href').slice(1)).html(data);

    //     // Activate the selected tab
    //     $('.nav-tabs a').removeClass('active');
    //     $(event.target).addClass('active');
    //   });
    // });

</script>
@endsection
