<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Jenis;
use App\Models\Product;
 
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['product'] = Product::with(['jenis'])->get();
        $data['jenis'] = Jenis::orderBy('created_at', 'DESC')->get();

  
        return view('products.index')->with($data);
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
    public function store(Request $request)
    {
        $imgName = time().'.'.explode('/',$request->file('img')->getMimeType())[1];
        $request->file('img')->move(public_path('img'), $imgName);
        $data = $request->all();
        $data['img'] = $imgName;
        Product::create($data);
        return redirect('products')->with('success', 'Produk tersimpan sukses');
        
    }
  
    /** 
     * Display the specified resource.
     */
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
    $request->validate([
        'img' => 'required|image|mimes:png,jpg,jpeg,svg',
    ]);

    // Hapus gambar sebelumnya jika ada
    if ($product->img) {
        $previousImagePath = public_path('img/' . $product->img);
        if (file_exists($previousImagePath)) {
            unlink($previousImagePath);
        }
    }

    $imageName = time() . '.' . $request->img->extension();
    $request->img->move(public_path('img'), $imageName);
    $data = $request->all();
    $data['img'] = $imageName;
    $product->update($data);
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
            Product::find($id)->delete();
        
            return redirect()->route('products')->with('success', 'Produk berhasil dihapus');
        }
    
    }
    
};