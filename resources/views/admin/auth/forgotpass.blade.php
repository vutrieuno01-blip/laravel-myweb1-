<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quên mật khẩu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<div class="container mt-4">

<form
action="{{ route('admin.forgotpass.post') }}"
method="POST"
class="mx-auto shadow p-4 bg-light"
style="width:500px">

@csrf

<h2>Quên mật khẩu</h2>

<x-admin.alert/>

<div class="mb-3">

<label>Email</label>

<input
type="text"
name="email"
class="form-control"
value="{{ old('email') }}">

</div>

<button class="btn btn-primary">
Gửi
</button>

<a href="{{ route('admin.login') }}"
class="btn btn-warning">

Đăng nhập

</a>

</form>

</div>

</body>

</html>