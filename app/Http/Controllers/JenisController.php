<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Jenis;
use App\Http\Requests\StoreJenisRequest;
use App\Http\Requests\UpdateJenisRequest;
use App\Exports\JenisExport; 
use PDF;
use App\Imports\JenisImport;
use Excel;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis= Jenis::orderBy('created_at', 'DESC')->get();
  
        return view('jenis.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis.create');
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJenisRequest $request)
    {
        Jenis::create($request->all());
 
        return redirect()->route('jenis')->with('success', 'Jenis tersimpan sukses');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jenis = Jenis::findOrFail($id);
  
        return view('jenis.show', compact('jenis'));    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenis = Jenis::findOrFail($id);
  
        return view('jenis.edit', compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisRequest $request, string $id)
    {
        $jenis = Jenis::findOrFail($id);
  
        $jenis->update($request->all());
  
        return redirect()->route('jenis')->with('success', 'Jenis diupdate sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis= Jenis::findOrFail($id);
  
        $jenis->delete();
  
        return redirect()->route('jenis')->with('success', 'Jenis dihapus sukses');
    }
    
    public function exportPDF()
    {
        $jenisData = Jenis::all(); // Replace Product with your model
        $pdf = PDF::loadView('jenis.pdf', compact('jenisData'));
        return $pdf->download('jenis_.pdf');
    }
    // Metode untuk mengimpor data produk dari file Excel
    public function import(Request $request)
    {
        // Memvalidasi apakah file yang diunggah adalah file Excel
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        // Mengimpor data dari file Excel menggunakan kelas ProductImport
        Excel::import(new JenisImport, $request->file('file'));

        // Mengembalikan respons dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }
}
