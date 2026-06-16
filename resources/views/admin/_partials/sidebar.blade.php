<div class="admin-sidebar bg-dark text-white p-3 vh-100">

<h4>
<i class="bi bi-speedometer2"></i>
Admin
</h4>

<ul class="nav flex-column">

<li>
<a class="nav-link text-white"
href="{{ route('admin.home') }}">
Dashboard
</a>
</li>

<li>

<a
class="nav-link text-white"
data-bs-toggle="collapse"
href="#category">

Danh mục

</a>

<div
class="collapse"
id="category">

<ul>

<li>

<a
class="nav-link text-white"
href="{{ route('admin.home') }}">

Loại SP

</a>

</li>

</ul>

</div>

</li>

</ul>

</div>