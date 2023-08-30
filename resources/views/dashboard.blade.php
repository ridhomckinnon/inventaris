@extends('template.admin')

@section('title', 'Dashboard')
@section('breadcrumb-title', 'Dashboard')
@section('breadcrumb-item', 'Dashboard')

@section('content')
<div class="col-lg-3 col-6">
    <div class="small-box bg-light">
        <div class="inner">
        <h3>{{ $item }}</h3>

        <p>Barang</p>
        </div>
        <div class="icon">
        <i class="fa fa-box"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-6">
<!-- small box -->
    <div class="small-box bg-light">
        <div class="inner">
            <h3>{{ $itemIn }}</h3>

            <p>Barang Masuk</p>
            </div>
            <div class="icon">
            <i class="fa fa-dolly"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-6">
<!-- small box -->
    <div class="small-box bg-light">
        <div class="inner">
            <h3>{{ $itemOut }}</h3>

            <p>Barang Keluar</p>
            </div>
            <div class="icon">
            <i class="fa fa-box-open"></i>
        </div>
    </div>
</div>
@role('admin')
<div class="col-lg-3 col-6">
    <div class="small-box bg-light">
        <div class="inner">
        <h3>{{ $operator }}</h3>

        <p>Operator</p>
        </div>
        <div class="icon">
        <i class="fa fa-user"></i>
        </div>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
    <div class="small-box bg-light">
        <div class="inner">
        <h3>{{ $supplier }}</h3>

        <p>Supplier</p>
        </div>
        <div class="icon">
        <i class="fa fa-truck"></i>
        </div>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
<!-- small box -->
    <div class="small-box bg-light">
        <div class="inner">
            <h3>{{ $itemIn + $itemOut}}</h3>

            <p>Transaksi</p>
            </div>
            <div class="icon">
            <i class="fa fa-chart-line"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-6">
<!-- small box -->
    <div class="small-box bg-light">
        <div class="inner">
            <h3>{{ $customer }}</h3>

            <p>Pelanggan</p>
            </div>
            <div class="icon">
            <i class="fa fa-users"></i>
        </div>
    </div>
</div>

<div class="col-lg-3 col-6">
<!-- small box -->
    <div class="small-box bg-light">
        <div class="inner">
            <h3>{{ $report }}</h3>

            <p>Laporan</p>
            </div>
            <div class="icon">
            <i class="fa fa-file"></i>
        </div>
    </div>
</div>
@endrole
@endsection
