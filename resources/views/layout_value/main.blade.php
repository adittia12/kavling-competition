<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.2.6/dist/cdn.min.js" defer></script>
    @vite('resources/sass/app.scss')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .header {
            background-color: #0c206b;
            color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo-card {
            background-color: rgb(255, 255, 255);
            border-radius: 12px;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .logo-card img {
            height: 50px;
        }

        .game-card {
            margin: 20px 0;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-title {
            color: #0c206b;
        }

        .btn-primary {
            background-color: #0c206b;
            border-color: #0c206b;
        }

        .btn-primary:hover {
            background-color: #4b0082;
            border-color: #4b0082;
        }

        .text-primary-custom {
            color: #4b0082;
        }
    </style>
    @yield('style')
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header text-center">
                    <div class="logo-card d-none d-md-flex">
                        <img src="{{ asset('assets/img/logo-bumn.png') }}" alt="BUMN Logo">
                    </div>
                    <h1 class="mx-3">Penjurian Mini Garden</h1>
                    <div class="logo-card d-none d-md-flex">
                        <!-- Logo Peruri -->
                        <img src="{{ asset('assets/img/logo-dark.png') }}" alt="Peruri Logo">
                        <!-- Logo HUT Peruri 53 -->
                        <img src="{{ asset('assets/img/logo_hut_53.png') }}" alt="HUT Peruri 53"
                            style="margin-left: 10px;">
                    </div>
                </div>
            </div>
        </div>

        <section class="mb-3">
            @include('sweetalert::alert')
            @yield('content')
        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @vite('resources/js/app.js')
    @yield('script')
</body>

</html>
