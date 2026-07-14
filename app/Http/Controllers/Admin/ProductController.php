<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brands;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ProductImage;

class ProductController extends Controller
{

    public function index($limit = 10)
    {
        $list = Product::with([
            'category:cateid,catename',
            'brand:id,brandname'
        ])
            ->select('id', 'productname', 'price', 'image', 'status', 'cateid', 'brandid')
            ->orderBy('productname')
            ->paginate($limit);

        return view('admin.products.index', compact('list'));
    }

    public function create()
    {
        $categories = Category::select('cateid', 'catename')->orderBy('catename')->get();
        $brands = Brands::select('id', 'brandname')->orderBy('brandname')->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        try {
            if (empty($request->cateid)) {
                return back()->withInput()->with('error', 'Vui lòng chọn loại sản phẩm');
            }

            $imageName = null;

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $imageName = Str::slug($request->productname) . '-' . time() . '.' . $file->extension();
                $file->storeAs('products', $imageName, 'public');
            }

            $product = Product::create([
                'productname'   => $request->productname,
                'slug'          => $request->slug,
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount ?? 0,
                'description'   => $request->description,
                'status'        => $request->status,
                'image'         => $imageName,
            ]);
            //
            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time();
                foreach ($request->file('imgs') as $file) {
                    $imgFileName = $product->id . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $imgFileName, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $imgFileName,
                    ]);
                    $i++;
                }
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(string $id) {}

    public function edit(string $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brands::select('id', 'brandname')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(ProductRequest $request, string $id)
    {
        try {
            if (empty($request->cateid)) {
                return back()->withInput()->with('error', 'Vui lòng chọn loại sản phẩm');
            }

            $product = Product::find($id);

            if (!$product) {
                return redirect()->route('admin.products.index')
                    ->with('error', 'Sản phẩm không tồn tại');
            }

            $fileName = $product->image;

            if ($request->hasFile('img')) {
                if ($fileName) {
                    Storage::disk('public')->delete('products/' . $fileName);
                }

                $file = $request->file('img');
                $fileName = Str::slug($request->productname)
                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('products', $fileName, 'public');
            }

            $product->update([
                'productname'   => $request->productname,
                'slug'          => $request->slug,
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount,
                'status'        => $request->status,
                'description'   => $request->description,
                'image'         => $fileName,
            ]);

            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time();
                foreach ($request->file('imgs') as $file) {
                    $imgFileName = $product->id . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $imgFileName, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $imgFileName,
                    ]);
                    $i++;
                }
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            // delete main image
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }
            // delete product images
            ProductImage::where('product_id', $product->id)->delete();
            $product->delete();
        }

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công');
    }
}
