<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiRequest $request)
    {
        try {
            DB::beginTransaction();
             // Menghitung nomor transaksi baru
             $last_id = Transaksi::whereDate('tanggal', date('y-m-d'))->orderBy('created_at','desc')->select('id')->first();
            
            $notrans = $last_id == null ? date('Ymd').'0001' : date('Ymd').sprintf('504d', substr($last_id->id,8,4)+1);
 

            // Membuat transaksi baru
            $insertTransaksi = Transaksi::create([
                'id' => $notrans,
                'tanggal' => date('Y-m-d'),
                'total_harga' => $request->total,
                'metode_pembayaran' => 'cash', // Metode pembayaran default, bisa disesuaikan
                'keterangan' => '-' // Keterangan default, bisa disesuaikan
            ]);

            // Menghitung nomor transaksi baru
            // $last_id_number = $transaksi ? $transaksi->id : 0;
            // $notrans = today()->format('Ymd') . str_pad($last_id_number, 4, '0', STR_PAD_LEFT);

            // Update ID transaksi dengan nomor transaksi yang baru dihasilkan
            // $transaksi->update(['id' => $notrans]);

            // Membuat detail transaksi
            foreach ($request->orderedList as $detail) {
                $insertTransaksi = DetailTransaksi::create([
                    'transaksi_id' => $notrans,
                    'products_id' => $detail['products_id'],
                    'jumlah' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty']
                ]);
            }

            DB::commit();

            return response()->json(['status' => true, 'message' => 'Pemesanan Berhasil!' , 'notrans' => $notrans]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal!'()]);
            DB::rollBack();
            // dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
    public function faktur($noFaktur) {
        try {
            $data['transaksi'] = Transaksi::where('id', $noFaktur)->with(['detailTransaksi'=> function($query){
                $query->with('products');
            }])->first();
            return view('faktur', $data);
        } catch (Exception $e) {
            return response()->json(['status'=>false, 'message'=> 'Pemesanan Gagal']);
        }
    }
}    