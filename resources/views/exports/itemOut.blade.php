<table>
    <thead>
    <tr>
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
    <tbody>
    @foreach($itemOut as $item)
        <tr>
            <td>{{ $item->place }}</td>
            <td>{{ $item->code }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->quantity_unit }}</td>
            <td>{{ $item->date_in }}</td>
            <td>{{ $item->date_out }}</td>
            <td>{{ $item->image }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
