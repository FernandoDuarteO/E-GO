<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Requests\ProductRequest;
use App\Models\Entrepreneurship;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager-load la imagen de portada (firstImage) para evitar N+1 y garantizar thumbnail
        $products = Product::with(['firstImage', 'category', 'entrepreneurship'])
            ->paginate(5);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = new Product();
        $entrepreneurships = Entrepreneurship::all();
        $categories = Category::all();
        return view('products.create', compact('products', 'entrepreneurships', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            // Crear producto sin campos de imágenes
            $productData = collect($data)->except(['media_file', 'media_files', 'delete_images', 'delete_legacy_media'])->toArray();
            $product = Product::create($productData);

            // Legacy single media_file fallback (opcional)
            if ($request->hasFile('media_file')) {
                $file = $request->file('media_file');
                $path = $file->store('products', 'public');
                $product->media_file = $path;
                $product->save();
            }

            // Procesar nuevos archivos desde los inputs name="media_files[]"
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');

                // Guardar cada archivo y asignar order incremental empezando en 0
                foreach (array_values($files) as $index => $file) {
                    if (!$file->isValid()) {
                        continue;
                    }
                    $path = $file->store('products', 'public');

                    $product->images()->create([
                        'file_path' => $path,
                        'order' => $index,
                        'alt' => null,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Error al crear producto: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $products = Product::with([
            'images' => function ($q) {
                $q->orderBy('order');
            },
            'reviews.user',
            'category',
            'entrepreneurship'
        ])->findOrFail($id);

        $entrepreneurships = Entrepreneurship::all();
        $categories = Category::all();
        return view('products.show', compact('products', 'entrepreneurships', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $products = Product::with([
            'images' => function ($q) {
                $q->orderBy('order');
            }
        ])->findOrFail($id);

        $entrepreneurships = Entrepreneurship::all();
        $categories = Category::all();
        return view('products.edit', compact('products', 'entrepreneurships', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, int $id)
    {
        $products = Product::with('images')->findOrFail($id);
        $data = $request->validated();

        DB::beginTransaction();
        try {
            // Actualizar campos del producto (excluyendo inputs de imágenes)
            $productData = collect($data)->except(['media_file', 'media_files', 'replace_image', 'delete_images', 'delete_legacy_media'])->toArray();

            // Si se envió legacy media_file (campo único), lo guardamos opcionalmente
            if ($request->hasFile('media_file')) {
                $file = $request->file('media_file');
                $path = $file->store('products', 'public');

                // borrar anterior legacy si existe
                if ($products->media_file && Storage::disk('public')->exists($products->media_file)) {
                    Storage::disk('public')->delete($products->media_file);
                }

                $productData['media_file'] = $path;
            }

            $products->update($productData);

            // 1) Procesar replace_image[ID] => reemplazar archivo y actualizar fila
            if ($request->hasFile('replace_image')) {
                $replaceFiles = $request->file('replace_image'); // array keyed by image id
                foreach ($replaceFiles as $imageId => $file) {
                    if (!$file || !$file->isValid()) {
                        continue;
                    }
                    // Asegurar que la imagen pertenece al producto
                    $pImage = ProductImage::where('id', $imageId)->where('product_id', $products->id)->first();
                    if (!$pImage) {
                        continue;
                    }

                    // Borrar archivo anterior
                    if ($pImage->file_path && Storage::disk('public')->exists($pImage->file_path)) {
                        Storage::disk('public')->delete($pImage->file_path);
                    }

                    // Guardar nuevo archivo y actualizar registro
                    $newPath = $file->store('products', 'public');
                    $pImage->update([
                        'file_path' => $newPath,
                    ]);
                }
            }

            // 2) Procesar delete_images[] => borrar filas y archivos
            $deleteIds = $request->input('delete_images', []);
            if (is_array($deleteIds) && count($deleteIds) > 0) {
                foreach ($deleteIds as $imgId) {
                    $pImage = ProductImage::where('id', $imgId)->where('product_id', $products->id)->first();
                    if (!$pImage) continue;
                    if ($pImage->file_path && Storage::disk('public')->exists($pImage->file_path)) {
                        Storage::disk('public')->delete($pImage->file_path);
                    }
                    $pImage->delete();
                }

                // Reordenar las restantes para que order sea consecutivo desde 0
                $remaining = $products->images()->orderBy('order')->get();
                $i = 0;
                foreach ($remaining as $r) {
                    $r->order = $i++;
                    $r->save();
                }
            }

            // 3) Procesar delete_legacy_media checkbox
            if ($request->has('delete_legacy_media') && $request->input('delete_legacy_media')) {
                if ($products->media_file && Storage::disk('public')->exists($products->media_file)) {
                    Storage::disk('public')->delete($products->media_file);
                }
                $products->media_file = null;
                $products->save();
            }

            // 4) Procesar nuevos archivos media_files[] (añadir al final)
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                // obtener último order actual
                $lastOrder = $products->images()->max('order');
                $startOrder = is_null($lastOrder) ? 0 : ($lastOrder + 1);
                foreach (array_values($files) as $idx => $file) {
                    if (!$file->isValid()) continue;
                    $path = $file->store('products', 'public');
                    $products->images()->create([
                        'file_path' => $path,
                        'order' => $startOrder + $idx,
                        'alt' => null,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('products.index')->with('updated', 'Producto actualizado con éxito.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar producto: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $products = Product::with('images')->findOrFail($id);

        DB::beginTransaction();
        try {
            // Borrar imágenes relacionadas y archivos
            foreach ($products->images as $img) {
                if ($img->file_path && Storage::disk('public')->exists($img->file_path)) {
                    Storage::disk('public')->delete($img->file_path);
                }
                $img->delete();
            }

            // Borrar archivo legacy si existe
            if ($products->media_file && Storage::disk('public')->exists($products->media_file)) {
                Storage::disk('public')->delete($products->media_file);
            }

            $products->delete();

            DB::commit();

            return redirect()->route('products.index')->with('deleted', 'Producto eliminado con éxito.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al eliminar producto: ' . $e->getMessage()]);
        }
    }
}