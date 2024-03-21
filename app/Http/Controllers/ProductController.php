<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;
use App\Models\Product;
use App\Imports\ProductImport;
use Excel;
use App\Exports\ProductsExport; 
use PDF;

class ProductController extends Controller
{
    // Metode untuk mengimpor data produk dari file Excel
    public function import(Request $request)
    {
        // Memvalidasi apakah file yang diunggah adalah file Excel
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        // Mengimpor data dari file Excel menggunakan kelas ProductImport
        Excel::import(new ProductImport, $request->file('file'));

        // Mengembalikan respons dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }

    // Metode untuk menampilkan halaman daftar produk
    public function index()
    {
        $data['product'] = Product::with(['jenis'])->get();
        $data['jenis'] = Jenis::orderBy('created_at', 'DESC')->get();

        return view('products.index')->with($data);
    }

    // Metode untuk menyimpan data produk baru
    public function store(Request $request)
    {
        // Proses penyimpanan data produk baru
        $imgName = time().'.'.explode('/',$request->file('img')->getMimeType())[1];
        $request->file('img')->move(public_path('img'), $imgName);
        $data = $request->all();
        $data['img'] = $imgName;
        Product::create($data);
        return redirect('products')->with('success', 'Produk tersimpan sukses');
    }

    
        
        public function show(string $id)
        {
            $product = Product::with('jenis')->findOrFail($id);

            return view('products.show', compact('product'));
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
        public function update(Request $request, string $id)
        {
            $product = Product::findOrFail($id);
            
            $product->update($request->all());
            $request->validate([
                'img' => 'image|mimes:png,jpg,jpeg,svg', // Tidak perlu required jika tidak ingin memaksa ada gambar yang diunggah
            ]);
            
            // Hapus gambar sebelumnya jika ada
            if ($request->hasFile('img')) {
                $previousImagePath = public_path('img/' . $product->img);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            
            if ($request->hasFile('img')) {
                $imageName = time() . '.' . $request->img->extension();
                $request->img->move(public_path('img'), $imageName);
                $product->img = $imageName;
            }
        
            $product->save();
        
            return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
        }
        
        /**
         * Remove the specified resource from storage.
         */

            public function destroy(string $id)
            {
                $product = Product::findOrFail($id);
                
                // Hapus gambar terkait jika ada
                if ($product->img) {
                    $imagePath = public_path('img/' . $product->img);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                
                // Hapus produk
                $product->delete();
                
                return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
            }
            
            public function exportPDF()
            {
                $productData = Product::all(); // Replace Product with your model
                $pdf = PDF::loadView('products.pdf', compact('productData'));
                return $pdf->download('produk_.pdf');
            }
        






        
        
        
    };