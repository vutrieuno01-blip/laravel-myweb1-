<form
action="{{ route('admin.categories.store') }}"
method="POST">

@csrf

<div>

<label>Tên</label>

<input
type="text"
name="catename">

</div>

<div>

<label>Slug</label>

<input
type="text"
name="slug">

</div>

<button>

Lưu

</button>

</form>