@extends('template.admin')
@section('title', 'UD Ilham')

@section('breadcrumb-title', 'FIFO')
@section('breadcrumb-item', 'FIFO')

@section('content')


<div class="col-md-12">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1>Hasil First In First Out</h1>
        </div>
        <div>
            <a href="{{ route('fifo.export') }}" target="_blank" class="btn btn-success">Export</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
        <div class="table-responsive">
                <table id="item-table" class="table table-bordered table-striped  dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Kadaluwarsa</th>
                            <th>Nomor Masuk</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Supplier</th>
                            <th>Jumlah Barang</th>
                            <th>Satuan Barang</th>
                            <th>Harga Pokok</th>
                            <th>Harga Jual</th>
                            <th>Tempat Pemyimpanan</th>
                            <th>Kualitas Barang</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
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
        ajax: "{{ route('fifo') }}",
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'date_expired', name: 'date_expired'},
            {data: 'no_in', name: 'no_in'},
            {data: 'items.code', name: 'items.code'},
            {data: 'items.name', name: 'items.name'},
            {data: 'supplier.name', name: 'supplier.name'},
            {data: 'quantity', name: 'quantity'},
            {data: 'quantity_unit', name: 'quantity_unit'},
            {data: 'cost_price', name: 'cost_price'},
            {data: 'sell_price', name: 'sell_price'},
            {data: 'place', name: 'place'},
            {data: 'status', name: 'status'},
            {data: 'items.description', name: 'items.description'},
            {data: 'image', name: 'image',
                render: function( data, type, full, meta ) {
                        return "<img src=\"/images/" + data + "\" height=\"50\"/>";
                    }
            },
            ]
        });
    });


</script>
@endsection
