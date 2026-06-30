<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Hiển thị danh sách
    public function index()
    {
        $list = Category::where(
            'status',
            1
        )

        ->orderBy(
            'catename'
        )

        ->paginate(10);

        return view(
            'admin.categories.index',
            compact('list')
        );
    }

    // Hiển thị form thêm
    public function create()
    {
        return view(
            'admin.categories.create'
        );
    }

    // Lưu dữ liệu
    public function store(Request $request)
    {
        Category::create([

            'catename'
            =>
            $request->catename,

            'slug'
            =>
            $request->slug,

            'status'
            =>
            1

        ]);

        return redirect()
        ->route(
            'admin.categories.index'
        );
    }

    // Xóa
    public function destroy($id)
    {
        Category::find($id)
        ?->delete();

        return redirect()
        ->route(
            'admin.categories.index'
        );
    }
}