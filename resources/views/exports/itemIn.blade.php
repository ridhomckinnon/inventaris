<table>
    <thead>
    <tr>
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
    <tbody>
    @foreach($itemIn as $item)
        <tr>
            <td>{{ $item->place }}</td>
            <td>{{ $item->no_in }}</td>
            <td>{{ $item->items->code }}</td>
            <td>{{ $item->items->name }}</td>
            <td>{{ $item->supplier->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->quantity_unit }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->cost_price }}</td>
            <td>{{ $item->sell }}</td>
            <td>{{ $item->date_in }}</td>
            <td>{{ $item->date_expired }}</td>
            <td>{{ $item->image }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
