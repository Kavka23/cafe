@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('contents')
    <div class="row mt-4 p-3">
        <div class="container col-md-8">
            <div class="card item product">
                <h5 class="card-header">Product</h5>
                {{-- product --}}
                <div class="p-4">
                    @foreach ($jenis as $j)
                        <h3>{{ $j->nama_jenis }}</h3>
                        <ul class="product-item">
                            @foreach ($j->product as $product)
                                <li class="btn bg-gradient-warning" data-harga="{{ $product->harga }}"
                                    data-id="{{ $product->id }}">
                                    <img src="{{ asset('img/'.$product->img) }}" style="max-width: 100px;">
                                    {{ $product->nama_produk }}
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container col-md-4">
            <div class="card item content">
                <h5 class="card-header">Order</h5>
                <div class="p-4">
                    <ul class="ordered-list">

                    </ul>
                    <div>
                        Total Bayar : <h2 id="total">0</h2>
                    </div>
                    <div>
                        <button id="btn-bayar" type="submit" class="btn bg-gradient-info">Bayar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

{{-- @include('type.form') --}}

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
   $(function() {
       // Inisialisasi
       const orderedList = []
       let total = 0

       const sum = () => {
           return orderedList.reduce((accumulator, object) => {
               return accumulator + (object.harga * object.qty);
           }, 0)
       };

       const changeQty = (el, inc) => {
           // Ubah di array
           const id = $(el).closest('li').data('id');
           const index = orderedList.findIndex(list => list.product_id == id)
           orderedList[index].qty += orderedList[index].qty == 1 && inc == -1 ? 0 : inc

           // Ubah qty dan ubah subtotal
           const txt_subtotal = $(el).closest('li').find('.subtotal');
           const txt_qty = $(el).closest('li').find('.qty-item')
           txt_qty.val(parseInt(txt_qty.val()) == 1 && inc == -1 ? 1 : parseInt(txt_qty.val()) + inc)
           txt_subtotal.text(orderedList[index].harga * orderedList[index].qty);

           // Ubah jumlah total
           $('#total').html(sum());
       };


       $('.product-item li').click(function() {
   // mengambil data
   const product_clicked = $(this).text();
   const data = $(this).data();
   const harga = parseFloat(data.harga);
   const id = parseInt(data.id);

   // Cek apakah produk sudah ada dalam daftar pesanan
   const existingItem = orderedList.find(item => item.product_id === id);
   if (existingItem) {
       // Jika sudah ada, tambahkan satu ke jumlah pesanan dan perbarui subtotal
       existingItem.qty++;
       const itemElement = $(`.ordered-list li[data-id="${id}"]`);
       const qtyElement = itemElement.find('.qty-item');
       const subtotalElement = itemElement.find('.subtotal');
       qtyElement.val(existingItem.qty);
       subtotalElement.text(existingItem.qty * existingItem.harga);
   } else {
       // Jika belum ada, tambahkan produk ke daftar pesanan
       let newItem = {
           'product_id': id,
           'product': product_clicked,
           'harga': harga,
           'qty': 1
       };
       orderedList.push(newItem);

       // Tambahkan elemen baru ke daftar pesanan
       let listOrder = `<li data-id="${id}"><h3>${product_clicked}</h3>`;
       listOrder += `Rp. ${harga} <br>`;
       listOrder += `<button class="px-2 py-1 rounded text-white bg-gradient-danger remove-item" style="font-size: 12px; outline: none; border: none"><i class="fas fa-trash"></i></button>`;
       listOrder += `<button class="px-2 py-1 rounded text-white bg-danger btn-dec" style="font-size: 12px; outline: none; border: none"><i class="fas fa-minus"></i></button>`;
       listOrder += `<input class="qty-item" type="number" value="1" style="width:30px; font-size: 14px; outline: none; border: none;" readonly>`;
       listOrder += `<button class="px-2 py-1 rounded text-white bg-success btn-inc" style="font-size: 12px; outline: none; border: none"><i class="fas fa-plus"></i></button> <br>`;
       listOrder += `<span class="subtotal">${harga}</span>`;
       listOrder += `</li>`;
       $('.ordered-list').append(listOrder);
   }

   // Perbarui jumlah total pembayaran
   $('#total').html(sum());
});



       // Event untuk mengubah quantity dan subtotal
       $('.ordered-list').on('click', '.btn-dec', function() {
           changeQty(this, -1)
       });

       $('.ordered-list').on('click', '.btn-inc', function() {
           changeQty(this, 1)
       });

       $('.ordered-list').on('click', '.remove-item', function() {
           const item = $(this).closest('li');
           let index = orderedList.findIndex(list => list.id == parseInt(item.data('id')))
           orderedList.splice(index, 1)
           item.remove();
           $('#total').html(sum());
       });

       // Event untuk melakukan pembayaran
       $('#btn-bayar').on('click', function() {
           $.ajax({
               url: "{{ route('transaksi.store') }}",
               method: "POST",
               data: {
                   "_token": "{{ csrf_token() }}",
                   orderedList: orderedList,
                   total: sum()
               },
               success: function(data) {
                   console.log(data)
                   Swal.fire({
                       title: 'Sudah benar semua',
                       showDenyButton: true,
                       confirmButtonText: "Cetak Nota",
                       denyButtonText: 'Okay',
                        //

                         // Posisi SweetAlert di tengah layar
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open("{{ url('faktur') }}/"+data.notrans);
                            location.reload();
                        } else if (result.isDenied) {
                            location.reload();
                        }
                    });
                },
                error: function(request, status, error) {
    console.log(request.responseText);
    Swal.fire('Pemesanan gagal. Terjadi kesalahan: ' + error);
}

            });
        });
    });
</script>
@endpush
