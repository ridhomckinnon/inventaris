<table>
    <thead>
    <tr>
        <th>Tanggal Kadaluwarsa</th>
        <th>Nomor Masuk</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
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
    @foreach($fefo as $fefoItem)
        <tr>
            <td>{{ $fefoItem->date_expired }}</td>
            <td>{{ $fefoItem->no_in }}</td>
            <td>{{ $fefoItem->items->code }}</td>
            <td>{{ $fefoItem->items->name }}</td>
            <td>{{ $fefoItem->quantity }}</td>
            <td>{{ $fefoItem->quantity_unit }}</td>
            <td>{{ $fefoItem->cost_price }}</td>
            <td>{{ $fefoItem->sell_price }}</td>
            <td>{{ $fefoItem->place }}</td>
            <td>{{ $fefoItem->status }}</td>
            <td>{{ $fefoItem->date_in }}</td>
            <td>{{ $fefoItem->date_expired }}</td>
            <td>{{ $fefoItem->items->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
