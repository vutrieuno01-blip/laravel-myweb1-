@extends('admin.layouts.admin')

@section('content')

<h2>Danh sách loại sản phẩm</h2>

<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
    + Thêm mới
</a>

<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên</th>
            <th>Slug</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->catename }}</td>
                <td>{{ $item->slug }}</td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection