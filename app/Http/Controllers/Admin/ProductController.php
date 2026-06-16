<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Đây là trang danh sách sản phẩm (Admin)";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Đây là form thêm mới sản phẩm";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "Đang lưu thông tin sản phẩm mới";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Đang xem chi tiết sản phẩm có ID là: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Đây là form chỉnh sửa sản phẩm có ID là: " . $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Đang cập nhật sản phẩm có ID là: " . $id;
    }

    public function test1()
    {
        return redirect()->route('admin.home');
    }

    public function test2()
    {
        return redirect('/admin/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "Đang xóa sản phẩm có ID là: " . $id;
    }
}
