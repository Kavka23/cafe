<!-- resources/views/payment_form.blade.php -->

@extends('layout.app')

@section('title', 'Form Pembayaran')

@section('contents')
<div class="card" style="width: 300px; margin-bottom: 20px;">
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
            <button type="button" class="btn btn-primary" id="btn-print">Print</button>
        </form>
    </div>
</div>
@endsection
