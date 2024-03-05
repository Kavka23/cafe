<?php
 
use Illuminate\Support\Facades\Route;
use Dompdf\Dompdf;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransaksiController;






 
Route::get('home', function () {
    return view('welcome');
});
 
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
  
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
  
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('layout.dashboard');
    })->name('dashboard');
 
    // Route::controller(ProductController::class)->prefix('products')->group(function () {
    //     Route::get('', 'index')->name('products');
    //     Route::get('create', 'create')->name('products.create');
    //     Route::post('store', 'store')->name('products.store');
    //     Route::get('show/{id}', 'show')->name('products.show');
    //     Route::get('edit/{id}', 'edit')->name('products.edit');
    //     Route::put('edit/{id}', 'update')->name('products.update');
    //     Route::delete('destroy/{id}', 'destroy')->name('products.destroy');
    // });

    Route::resource('products', ProductController::class);
    Route::resource('stok', StokController::class);


    Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
        Route::get('', 'index')->name('kategori');
        Route::get('create', 'create')->name('kategori.create');
        Route::post('store', 'store')->name('kategori.store');
        Route::get('show/{id}', 'show')->name('kategori.show');
        Route::get('edit/{id}', 'edit')->name('kategori.edit');
        Route::put('edit/{id}', 'update')->name('Kategori.update');
        Route::delete('destroy/{id}', 'destroy')->name('kategori.destroy');
    });

    Route::controller(JenisController::class)->prefix('jenis')->group(function () {
        Route::get('', 'index')->name('jenis');
        Route::get('create', 'create')->name('jenis.create');
        Route::post('store', 'store')->name('jenis.store');
        Route::get('show/{id}', 'show')->name('jenis.show');
        Route::get('edit/{id}', 'edit')->name('jenis.edit');
        Route::put('edit/{id}', 'update')->name('jenis.update');
        Route::delete('destroy/{id}', 'destroy')->name('jenis.destroy');
    });
 
    Route::controller(StokController::class)->prefix('stok')->group(function () {
        Route::get('', 'index')->name('stok');
        Route::get('create', 'create')->name('stok.create');
        Route::post('store', 'store')->name('stok.store');
        Route::get('show/{id}', 'show')->name('stok.show');
        Route::get('edit/{id}', 'edit')->name('stok.edit');
        Route::put('edit/{id}', 'update')->name('stok.update');
        Route::delete('destroy/{id}', 'destroy')->name('stok.destroy');
    });

    Route::controller(PelangganController::class)->prefix('pelanggan')->group(function () {
        Route::get('', 'index')->name('pelanggan');
        Route::get('create', 'create')->name('pelanggan.create');
        Route::post('store', 'store')->name('pelanggan.store');
        Route::get('show/{id}', 'show')->name('pelanggan.show');
        Route::get('edit/{id}', 'edit')->name('pelanggan.edit');
        Route::put('edit/{id}', 'update')->name('pelanggan.update');
        Route::delete('destroy/{id}', 'destroy')->name('pelanggan.destroy');
    });
 

    Route::controller(PemesananController::class)->prefix('pemesanan')->group(function () {
        Route::get('', 'index')->name('pemesanan');

        
    
    });
    Route::post('/process-payment', [PaymentController::class, 'processPaymentAndGenerateReceipt'])->name('process.payment');

    

    
    Route::resource('transaksi', TransaksiController::class);
    // Route::resource('transaksi', [TransaksiController::class, 'faktur']);
// routes/web.php



Route::post('/process-payment', function (Illuminate\Http\Request $request) {
    // Mendapatkan data dari form pembayaran
    $namaPelanggan = $request->input('nama_pelanggan');
    $tanggalBeli = $request->input('tanggal_beli');
    $orderList = $request->input('order_list');
    $subtotal = $request->input('subtotal');
    $bayar = $request->input('bayar');
    $kembalian = $request->input('kembalian');

    // Membuat isi PDF berdasarkan data yang didapatkan
    $html = "<h1>Struk</h1>";
    $html .= "<p>Nama Pelanggan: $namaPelanggan</p>";
    $html .= "<p>Tanggal Pembelian: $tanggalBeli</p>";
    // Tambahkan data lainnya sesuai kebutuhan
    $html .= "<p>Order List: $orderList</p>";
    $html .= "<p>Subtotal: $subtotal</p>";
    $html .= "<p>Bayar: $bayar</p>";
    $html .= "<p>Kembalian: $kembalian</p>";

    // Buat objek Dompdf
    $dompdf = new Dompdf();

    // Load HTML ke Dompdf
    $dompdf->loadHtml($html);

    // Render PDF
    $dompdf->render();

    // Keluarkan ke browser (atau simpan ke file)
    $dompdf->stream("form_pembayaran.pdf");
});


});