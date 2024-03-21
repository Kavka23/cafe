<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use App\Models\Jenis;
use App\Models\Product;
use App\Models\Pemesanan;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;


class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenis'] = Jenis::with(['product'])->get();   
        $data['pemesanans'] = Pemesanan::orderBy('created_at', 'DESC')->get();
        $data['product'] = Product::orderBy('created_at', 'DESC')->get();
        $jenis = Jenis::all();
        return view('pemesanan.index')->with($data);
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
    public function store(StorePemesananRequest $request)
    {
        $data['pemesanan'] = Pemesanan::orderBy('created_at', 'DESC')->get();
        $jenis = Jenis::all();
        return view('pemesanan.index', compact('data', 'jenis'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemesananRequest $request, Pemesanan $pemesanan)
    {
        $pemesanan->update($request->all());

        return redirect('pemesanan')->with('success', 'Update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();
        return redirect('pemesanan')->with('success', 'Data pemesanan berhasil dihapus!');
    }
    public function showPaymentForm()
{
    return view('payment_form');
}

}
