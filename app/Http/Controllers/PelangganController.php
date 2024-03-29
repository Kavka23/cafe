<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Exports\PelangganExport; 
use PDF;


class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan= Pelanggan   ::orderBy('created_at', 'DESC')->get();
  
        return view('pelanggan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create');
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePelangganRequest $request)
    {
        Pelanggan::create($request->all());
 
        return redirect()->route('pelanggan')->with('success', 'pelanggan tersimpan sukses');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
  
        return view('pelanggan.show', compact('pelanggan'));    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
  
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelangganRequest $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
  
        $pelanggan->update($request->all());
  
        return redirect()->route('pelanggan')->with('success', 'pelanggan diupdate sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
  
        $pelanggan->delete();
  
        return redirect()->route('pelanggan')->with('success', 'pelanggan dihapus sukses');
    }
    public function exportPDF()
    {
        $pelangganData = Pelanggan::all(); // Replace Product with your model
        $pdf = PDF::loadView('pelanggan.pdf', compact('pelangganData'));
        return $pdf->download('pelanggan_.pdf');
    }
}
