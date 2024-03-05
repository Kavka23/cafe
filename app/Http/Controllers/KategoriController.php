<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Jenis;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::orderBy('created_at', 'DESC')->get();
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis = Jenis::orderBy('created_at', 'DESC')->get();
        return view('kategori.create', compact('jenis'));
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriRequest $request)
    {
        Kategori::create($request->all());
 
        return redirect()->route('kategori')->with('success', 'Kategori tersimpan sukses');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::with('jenis')->findOrFail($id);
  
        return view('kategori.show', compact('kategori'));    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenis = Jenis::orderBy('created_at', 'DESC')->get();
        $kategori = Kategori::findOrFail($id);
  
        return view('kategori.edit', compact(['kategori','jenis']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);
  
        $kategori->update($request->all());
  
        return redirect()->route('kategori')->with('success', 'kategori diupdate sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
  
        $kategori->delete();
  
        return redirect()->route('kategori')->with('success', 'kategori dihapus sukses');
    }
}
