@extends('layout.app')

@section('title')
@endsection



@section('contents')    
<div class="">
    <div class="row">
        <div class="col">
            @foreach ($jenis as $j)
            <div class="item-content">
                <h3 class="mb-3">{{ $j->nama_jenis }}</h3>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach ($j->product as $product)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ asset('img') }}/{{ $product->img }}" class="card-img-top product-img" alt="{{ $product->nama_produk }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->nama_produk }}</h5>
                                <p class="card-text">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                                <!-- Tombol Add to Cart -->
                                <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}" data-harga="{{ $product->harga }}">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="col">
            <div class="card" style="width: 300px; margin-bottom: 20px;">
                <div class="card-body">
                    <h5 class="card-title">Order</h5>
                    <ul class="ordered-list">
                        <!-- Daftar pesanan akan ditampilkan di sini -->
                    </ul>
                    <p class="card-text">Total Bayar : <span id="total">0</span></p>
                    <!-- Tombol Bayar -->
<button id="btn-bayar" class="btn btn-primary">Bayar</button>
                </div>
            </div>

            <div class="card" style="width: 300px; margin-bottom: 20px; display: none;" id="payment-form">
                <div class="card-body">
                    <h5 class="card-title">Form Pembayaran</h5>
                    <form action="/process-payment" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan:</label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_beli" class="form-label">Tanggal Pembelian:</label>
                            <input type="date" id="tanggal_beli" name="tanggal_beli" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="order_list" class="form-label">Order List:</label>
                            <ul id="order_list" class="list-group mb-3">
                                <!-- Isi dari order list akan ditambahkan menggunakan JavaScript -->
                            </ul>
                        </div>
                        <div class="mb-3">
                            <label for="subtotal" class="form-label">Subtotal:</label>
                            <input type="text" id="subtotal" name="subtotal" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="bayar" class="form-label">Bayar:</label>
                            <input type="text" id="bayar" name="bayar" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="kembalian" class="form-label">Kembalian:</label>
                            <input type="text" id="kembalian" name="kembalian" class="form-control" readonly>
                        </div>
                        <button type="submit" class="btn btn-success">Proses Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        const orderedList = [];

        // Menambahkan produk ke daftar pesanan saat tombol Add to Cart diklik
        $(".add-to-cart").click(function () {
            const id = $(this).data('id');
            const product = $(this).closest('.card-body').find('.card-title').text();
            const harga = parseFloat($(this).data('harga'));

            // Mengecek apakah produk sudah ada dalam daftar pesanan
            const index = orderedList.findIndex(item => item.id === id);
            if (index !== -1) {
                // Jika produk sudah ada, tambahkan jumlah pesanan (qty)
                orderedList[index].qty++;
            } else {
                // Jika produk belum ada, tambahkan produk baru ke daftar pesanan
                orderedList.push({ id: id, product: product, harga: harga, qty: 1 });
            }

            // Menghitung total bayar dan memperbarui daftar pesanan
            updateOrderList();
        });

        // Event untuk menambah jumlah pesanan (qty)
        $(document).on('click', '.btn-increase', function () {
            const index = $(this).data('index');
            orderedList[index].qty++;
            updateOrderList();
        });

        // Event untuk mengurangi jumlah pesanan (qty)
        $(document).on('click', '.btn-decrease', function () {
            const index = $(this).data('index');
            if (orderedList[index].qty > 1) {
                orderedList[index].qty--;
                updateOrderList();
            }
        });

        // Event untuk menghapus pesanan dari daftar
        $(document).on('click', '.btn-cancel', function () {
            const index = $(this).data('index');
            orderedList.splice(index, 1);
            updateOrderList();
        });

        // Fungsi untuk memperbarui daftar pesanan dan total bayar
        function updateOrderList() {
            let total = 0;
            $('.ordered-list li').remove();
            orderedList.forEach(function (data, index) {
                $('.ordered-list').append('<li>' +
                    data.product + ' <br> Rp. ' + data.harga + '      <br> ' +
                    '<button class="btn btn-danger btn-sm btn-decrease" data-index="' + index + '">-</button> ' +
                    '<span class="qty">' + data.qty + '</span> ' +
                    '<button class="btn btn-success btn-sm btn-increase" data-index="' + index + '">+</button> <br> <br>' +
                    '<button class="btn btn-warning btn-sm btn-cancel" data-index="' + index + '">Cancel</button> <br>' +
                    '= ' + data.harga * data.qty + '</li>');
                total += data.harga * data.qty;
            });
            $('#total').text(total);
        }

        // Tombol Bayar
        $('#btn-bayar').click(function () {
            // Menampilkan formulir pembayaran
            $('#payment-form').show();

            // Isi data pesanan ke dalam formulir pembayaran
    let orderListHtml = '';
    orderedList.forEach(function (data, index) {
        orderListHtml += '<li>' +
            data.product + ' x ' + data.qty + ' = ' + data.harga * data.qty + '</li>';
    });
    $('#order_list').html(orderListHtml);
            // Menghitung total bayar
            let total = 0;
            orderedList.forEach(function (data) {
                total += data.harga * data.qty;
            });
            $('#subtotal').val(total);
        });

        // Menghitung kembalian
        $('#bayar').on('input', function () {
            const bayar = parseFloat($(this).val());
            const subtotal = parseFloat($('#subtotal').val());
            const kembalian = bayar - subtotal;
            $('#kembalian').val(kembalian);
        });
    });
</script>
@endpush

@push('style')
<style>
    .product-container {
        list-style-type: none;
    }

    .product-container li {
        margin-bottom: 20px;
    }

    .product-container li h3 {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 18px;
        background-color: aliceblue;
        padding: 5px 15px;
    }

    .product-item {
        list-style-type: none;
        display: flex;
        gap: lem;
        margin: 10px 20px;
    }

    .product-item li {
        background-color: beige;
        padding: 10px 20px;
    }

    .c {
        width: 700px;
        display: flex;
        flex-direction: column;
        margin: auto;
    }

    .container {
        border: 1px solid pink;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 20px;
        padding: 0px;
    }

    .item-content {
        width: 400px;
    }

    .product-img {
        width: 100%;
        height: 100px; /* Ubah sesuai dengan kebutuhan Anda */
        object-fit: cover;
    }
</style>
@endpush
