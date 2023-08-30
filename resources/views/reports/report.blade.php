@extends('template.admin')
@section('title', 'UD Ilham')

@section('breadcrumb-title', 'Barang')
@section('breadcrumb-item', 'Barang')

@section('content')

<div class="col-md-12">
    <ul class="nav nav-tabs nav-justified mb-3" id="tabs-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tabs-item-tab" data-toggle="pill" href="#tabs-item" role="tab" aria-controls="tabs-item" aria-selected="true">Barang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tabs-itemIn-tab" data-toggle="pill" href="#tabs-itemIn" role="tab" aria-controls="tabs-itemIn" aria-selected="false">Barang Masuk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tabs-itemOut-tab" data-toggle="pill" href="#tabs-itemOut" role="tab" aria-controls="tabs-itemOut" aria-selected="false">Barang Keluar</a>
        </li>
    </ul>
    <div class="tab-content" id="tabs-tabContent">
    <div class="tab-pane fade show active" id="tabs-item" role="tabpanel" aria-labelledby="tabs-item-tab">

        <div class="card">
            <div class="card-header">

                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <h3>Jumlah Barang Keseluruhan</h3>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <a href="{{ route('item.export') }}" target="_blank" class="btn btn-success"><i class="fa fa-file-export"></i> Export</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="item-table" class="table table-bordered table-striped  dataTable-item">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Total Barang</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>

                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="tabs-itemIn" role="tabpanel" aria-labelledby="tabs-itemIn-tab">
        <div class="card">
                <div class="card-header">

                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <h3>Jumlah Barang Masuk</h3>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end">
                            <a href="{{ route('itemIn.export') }}" target="_blank" class="btn btn-success"><i class="fa fa-file-export"></i> Export</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="itemIn-table" class="table table-bordered table-striped dataTable-itemIn">
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
                                </tr>
                            </thead>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    <div class="tab-pane fade" id="tabs-itemOut" role="tabpanel" aria-labelledby="tabs-itemOut-tab">
        <div class="card">
            <div class="card-header">

                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <h3>Jumlah Barang Keluar</h3>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <a href="{{ route('itemOut.export') }}" target="_blank" class="btn btn-success"><i class="fa fa-file-export"></i> Export</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="itemOut-table" class="table table-bordered table-striped dataTable-itemOut">
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
                            </tr>
                        </thead>

                    </table>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
@section('script')
<script>
$(function(){
    var table = $('.dataTable-item').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('item') }}",
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'quantity', name: 'quantity'},
            {data: 'image', name: 'image',
                render: function( data, type, full, meta ) {
                        return "<img src=\"/images/" + data + "\" height=\"50\"/>";
                    }
            },
            ]
    });
    var table2 = $('.dataTable-itemIn').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('itemIn') }}",
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
            ]
    });
    var table3 = $('.dataTable-itemOut').DataTable({
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
            ]
    });



});


</script>
@endsection
