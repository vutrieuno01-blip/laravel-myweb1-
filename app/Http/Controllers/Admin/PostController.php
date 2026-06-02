<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Đây là trang danh sách bài viết (Admin)";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Đây là form thêm mới bài viết";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "Đang lưu thông tin bài viết mới";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Đang xem chi tiết bài viết có ID là: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Đây là form chỉnh sửa bài viết có ID là: " . $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Đang cập nhật bài viết có ID là: " . $id; 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "Đang xóa bài viết có ID là: " . $id;
    }
}
