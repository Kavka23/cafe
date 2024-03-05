<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Product;
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateStokRequest;

Class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['products'] = Product::orderBy('created_at', 'DESC')->get();
        $data['stok'] = Stok::with(['products'])->orderBy('created_at', 'DESC')->get();

  
        return view('stok.index')->with($data);
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
    public function store(StoreStokRequest $request)
{
    try {
        $products_id = $request->input('products_id');
        $stok = $request->input('stok');
        
        // Cek apakah stok untuk menu tersebut sudah ada
        $existingStok = Stok::where('products_id', $products_id)->first();

        if ($existingStok) {
            // Jika sudah ada, update stok stok
            $existingStok->update(['stok' => $existingStok->stok + $stok]);
        } else {
            // Jika belum ada, buat entri stok baru
            Stok::create(['products_id' => $products_id, 'stok' => $stok]);
        }

        return redirect('stok')->with('success', 'Data stok berhasil ditambahkan!');
    } catch (QueryException | ModelNotFoundException | \Exception $error) {
        return 'haha error' . $error->getMessage() . $error->getCode();
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStokRequest $request, string $id)
    {
        $stok = Stok::findOrFail($id);
  
        $stok->update($request->all());
  
        return redirect()->route('stok')->with('success', 'Stok diupdate sukses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $stok= Stok::findOrFail($id);
  
        Stok::find($id)->delete();
  
        return redirect()->route('stok')->with('success', 'Stok dihapus sukses');
    }
}
