<?php

namespace App\Http\Controllers;

use App\Models\ProdukTitipan;
use App\Http\Requests\StoreProdukTitipanRequest;
use App\Http\Requests\UpdateProdukTitipanRequest;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProdukTitipanImport;
use Illuminate\Support\Facades\View;






class ProdukTitipanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produkTitipan = ProdukTitipan::all();
        return view('produk_titipan.index', compact('produkTitipan'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdukTitipanRequest $request)
    {
        ProdukTitipan::create($request->all());
        return redirect('produk_titipan')->with('success', 'Produk tersimpan sukses');


    }

    /**
     * Display the specified resource.
     */
    public function show(ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukTitipanRequest $request, ProdukTitipan $id)
{
    // Memperbarui data produk titipan dengan data yang diterima dari request
    $id->update($request->all());

    // Redirect ke halaman produk titipan dengan pesan sukses
    return redirect()->route('produk_titipan')->with('success', 'Produk titipan berhasil diperbarui');
}

public function destroy(ProdukTitipan $id)
{
    $id = ProdukTitipan::findOrFail($id);
  
    ProdukTitipan::find($id)->delete();
    return redirect()->route('produk_titipan')->with('success', 'pelanggan dihapus sukses');
}
public function exportPDF()
{
    $produkTitipan = ProdukTitipan::all();

    // Render view Blade sebagai HTML
    $html = View::make('produk_titipan.pdf', compact('produkTitipan'))->render();

    // Buat objek Dompdf
    $pdf = new Dompdf();

    // Load HTML ke Dompdf
    $pdf->loadHtml($html);

    // Render PDF
    $pdf->render();

    // Kembalikan PDF ke browser
    return $pdf->stream('produk_titipan.pdf');
}
public function importExcel(Request $request)
{
    Excel::import(new ProdukTitipanImport, $request->file('file'));

    return redirect()->route('produk_titipan')->with('success', 'Data produk titipan berhasil diimpor.');
}

}