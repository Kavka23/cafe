<title>Cafe Invoice</title>

<body>
    <h2>C A F E</h2>
    <h5>Jl. Arciko N0. 75 Cianjur</h5>
    <hr>
        <h5>No. Faktur : {{ $transaksi->id }} </h5>
        <h5> {{ $transaksi->tanggal }} </h5>

        <table border="0">
            <thead>
                <tr>
                    <td>Qty</td>
                    <td>Item</td>
                    <td>Harga</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->detailTransaksi as $item)
                    <tr>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->product->nama_produk}}</td>
                        <td>{{ number_format($item->product->harga, 0, ',', '.') }}</td>
                        <td>{{ number_format($item->subtotal, 0, ',', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
</body>
