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
            flex-wrap: nowrap;
            /* Agar tidak wrap secara default */
        }

        .logo-card img {
            height: auto;
            width: 100%;
            /* Agar gambar menyesuaikan lebar container */
            max-width: 100%;
            object-fit: contain;
            /* Menjaga keseluruhan gambar terlihat tanpa terpotong */
        }

        .logo-card {
            padding: 10px;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            overflow: hidden;
            /* Pastikan gambar tidak keluar dari batas */
        }

        /* Media Query untuk Tablet */
        @media (max-width: 1024px) {
            .header {
                justify-content: center;
                /* Atur agar logo dan teks tetap di tengah */
                flex-wrap: wrap;
                /* Izinkan wrap jika layar terlalu kecil */
            }

            .logo-card img {
                height: 40px;
                /* Kurangi ukuran logo untuk tablet */
            }

            .header h3 {
                font-size: 20px;
                margin: 10px 0;
                /* Beri jarak vertikal pada teks */
            }
        }

        /* Media Query untuk Mobile */
        @media (max-width: 768px) {
            .header {
                justify-content: center;
                /* Atur semua konten ke tengah */
                flex-direction: column;
                /* Susun logo dan teks secara vertikal */
            }

            .logo-card {
                margin-bottom: 15px;
                /* Beri jarak lebih antara logo */
            }

            .logo-card img {
                height: 35px;
                /* Sesuaikan ukuran logo untuk mobile */
            }

            .header h3 {
                font-size: 18px;
                /* Sesuaikan ukuran teks */
            }
        }

        @media (max-width: 1024px) {
            .logo-card img {
                max-width: 80%;
                /* Sesuaikan ukuran logo di tablet */
                height: auto;
            }
        }

        @media (max-width: 768px) {
            .logo-card img {
                max-width: 70%;
                /* Sesuaikan ukuran logo di mobile */
                height: auto;
            }
        }

        .logo-card {
            padding: 10px 20px;
            /* Berikan ruang lebih untuk logo */
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

        /* Footer Styles */
        footer {
            background-color: #0c206b;
            /* Dark blue background */
            color: #ffffff;
            /* White text */
            padding: 20px 0;
            /* Top and bottom padding */
            border-top: 4px solid #4b0082;
            /* Top border in indigo color */
            text-align: center;
            /* Center the text */
            font-size: 16px;
            /* Adjust font size */
            position: relative;
            /* To position elements inside */
        }

        footer p {
            margin: 0;
            /* Remove default margin */
        }

        footer a {
            color: #ffffff;
            /* Make links white */
            text-decoration: underline;
            /* Underline the links */
        }

        footer a:hover {
            color: #ffcc00;
            /* Change color on hover */
            text-decoration: none;
            /* Remove underline on hover */
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
                    <h3 class="mx-3">Judging of Sustainable Garden Competition</h3>
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

    <!-- Footer -->
    <footer class="text-center mt-4">
        <p>Developed by <a href="https://adittia12.github.io/my-portfolio/" target="_blank">AA_12</a></p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @vite('resources/js/app.js')
    @yield('script')
</body>

</html>
