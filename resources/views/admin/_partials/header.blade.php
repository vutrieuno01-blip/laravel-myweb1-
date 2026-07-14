<nav class="navbar navbar-light bg-light admin-header">
    <div class="container-fluid">
        <span class="navbar-brand">Admin Panel</span>
        <div class="d-flex align-items-center gap-3">
            @auth
            <span>Xin chào <strong>{{ Auth::user()?->fullname ?? 'Quản trị viên' }}</strong></span>

            @if (Route::has('admin.changepass'))
            <a href="{{ route('admin.changepass') }}" class="text-decoration-none">Đổi mật khẩu</a>
            @endif

            @if (Route::has('admin.logout'))
            <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-link p-0 text-decoration-none">Đăng xuất</button>
            </form>
            @endif
            @else
            <span>Xin chào <strong>Khách</strong></span>
            @endauth
        </div>
    </div>
</nav>