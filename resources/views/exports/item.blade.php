<table>
    <thead>
    <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Jumlah Barang</th>
        <th>Deskripsi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->code }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->item_in_sum_quantity }}</td>
            <td>{{ $item->description }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
