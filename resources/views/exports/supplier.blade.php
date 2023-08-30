<table>
    <thead>
    <tr>
        <th>Kode</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Alamat</th>
    </tr>
    </thead>
    <tbody>
    @foreach($suppliers as $supplier)
        <tr>
            <td>{{ $supplier->code }}</td>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->phone }}</td>
            <td>{{ $supplier->address }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
