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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Image preview for inputs with class 'img-input'
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.img-input').forEach(function(input) {
                input.addEventListener('change', function() {
                    // find nearest preview container
                    var preview = input.closest('.img-group')?.querySelector('.img-preview') || input.parentNode.querySelector('.img-preview');
                    if (!preview) return;
                    preview.innerHTML = '';

                    var files = Array.from(input.files || []);
                    files.forEach(function(file) {
                        if (!file.type.startsWith('image/')) return;
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail me-2 mb-2';
                            img.style.width = '80px';
                            preview.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            });
        });
    </script>

</body>

</html>