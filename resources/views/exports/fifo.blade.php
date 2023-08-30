<table>
    <thead>
    <tr>
        <th>Tanggal Kadaluwarsa</th>
        <th>Nomor Masuk</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Nama Supplier</th>
        <th>Jumlah Barang</th>
        <th>Satuan Barang</th>
        <th>Harga Pokok</th>
        <th>Harga Jual</th>
        <th>Tempat Penyimpanan</th>
        <th>Status Barang</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Kadaluwarsa</th>
        <th>Deskripsi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($fifo as $fifoItem)
        <tr>
            <td>{{ $fifoItem->date_expired }}</td>
            <td>{{ $fifoItem->no_in }}</td>
            <td>{{ $fifoItem->items->code }}</td>
            <td>{{ $fifoItem->items->name }}</td>
            <td>{{ $fifoItem->supplier->name }}</td>
            <td>{{ $fifoItem->quantity }}</td>
            <td>{{ $fifoItem->quantity_unit }}</td>
            <td>{{ $fifoItem->cost_price }}</td>
            <td>{{ $fifoItem->sell_price }}</td>
            <td>{{ $fifoItem->place }}</td>
            <td>{{ $fifoItem->status }}</td>
            <td>{{ $fifoItem->date_in }}</td>
            <td>{{ $fifoItem->date_expired }}</td>
            <td>{{ $fifoItem->items->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
