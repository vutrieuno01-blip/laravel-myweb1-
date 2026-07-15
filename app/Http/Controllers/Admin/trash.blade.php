<h2>DANH SÁCH LOẠI SẢN PHẨM - THÙNG RÁC</h2>

<a href="{{ route('admin.categories.index') }}"
   class="btn btn-primary mb-3">
    Quay lại
</a>

<form
    action="{{ route('admin.categories.restore', $item->cateid) }}"
    method="POST"
    class="d-inline">

    @csrf
    @method('PATCH')

    <button class="btn btn-success btn-sm">
        Khôi phục
    </button>
</form>

<form
    action="{{ route('admin.categories.forceDelete', $item->cateid) }}"
    method="POST"
    class="d-inline">

    @csrf
    @method('DELETE')

    <button
        onclick="return confirm('Xóa vĩnh viễn?')"
        class="btn btn-danger btn-sm">
        Xóa
    </button>
</form>
