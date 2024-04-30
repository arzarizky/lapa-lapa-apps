<table>
    <thead>
        <tr>
            <th>KOTA</th>
            @foreach ($data as $item)
                @foreach ($item->pemilik as $item)
                    @foreach ($item->tabelharga->reverse() as $item)
                        <th>{{ $item->tanggal }}</th>
                    @endforeach
                @endforeach
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>Semua Kota</td>
                @foreach (array_reverse($item->semuakota['rekapharga']) as $items)
                    <td>@currency($items['harga'])</td>
                @endforeach
            </tr>
            <tr>
                @foreach ($item->pemilik as $item)
                    <td>{{ $item->kota->nama }}</td>
                    @foreach ($item->tabelharga->reverse() as $item)
                        <td>@currency($item->harga)</td>
                    @endforeach
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
