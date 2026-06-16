<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Admin</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
rel="stylesheet">

</head>

<body>

<div class="container-fluid">

<div class="row min-vh-100">

<div class="col-md-2">

@include('admin._partials.sidebar')

</div>

<div class="col-md-10">

@include('admin._partials.header')

<main class="p-3">

@yield('content')

</main>

@include('admin._partials.footer')

</div>

</div>

</div>

</body>

</html>