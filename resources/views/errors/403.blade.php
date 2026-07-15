<!DOCTYPE html>
<html>

<head>
    <title>403 Forbidden</title>

    <style>

        body{
            background:#f5f5f5;
            font-family:Arial;
            text-align:center;
            margin-top:150px;
        }

        h1{
            color:red;
            font-size:80px;
        }

        p{
            font-size:28px;
        }

        a{

            text-decoration:none;
            padding:10px 20px;
            background:#0d6efd;
            color:white;
            border-radius:6px;

        }

    </style>

</head>

<body>

<h1>403</h1>

<p>Bạn không có quyền truy cập.</p>

<a href="{{ url('/') }}">
Quay về Trang chủ
</a>

</body>

</html>