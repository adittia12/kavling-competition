@extends('layout_value.main')
@section('title')
    Kavling
@endsection
@section('style')
    <style>
        /* Global stylish font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .stylish-text {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .stylish-card-title {
            font-size: 1.4rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            /* Putih */
        }

        .stylish-card-text {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.85);
            /* Warna semitransparan putih */
            letter-spacing: 0.5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-light {
            background-color: #fff !important;
            color: #2575fc !important;
        }

        .btn-light:hover {
            background-color: #2575fc !important;
            color: #fff !important;
        }

        .btn {
            font-size: 0.9rem;
            letter-spacing: 0.8px;
        }

        .stylish-text {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #343a40;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Tombol Back di kiri -->
                    <a href="{{ route('display_values') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <!-- Judul Form Penjurian -->
                    <h3 class="stylish-text">Data Kavling</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <!-- Card dengan foto direksi -->
                <div class="card border-0 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-4">
                            <!-- Foto direksi -->
                            <img src="{{ asset('storage/' . $dataDireksi->photo) }}" class="img-fluid rounded-start"
                                alt="Foto {{ $dataDireksi->name }}" style="border-radius: 20px; width: 120px">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title stylish-text"
                                    style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); -webkit-background-clip: text; color: transparent;">
                                    <b>{{ $dataDireksi->name }}</b>
                                </h3>
                                <p class="card-text text-muted">Juri Mini Garden</p>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="direksi_id" value="{{ $dataDireksi->id }}">
            </div>
        </div>

        <div class="row g-4 mb-5">
            @foreach ($dataKavling as $item)
                <div class="col-md-4">
                    <div class="card h-100 text-white"
                        style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border: none; border-radius: 15px;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="text-center mb-4">
                                <h5 class="card-title text-white fw-bold">{{ $item->name_kavling }}</h5>
                                <p class="card-text text-white-50">Data Kavling</p>

                                @if ($nilaiPerKavling[$item->id]['dinilai'])
                                    <!-- Jika sudah dinilai, tampilkan total nilai -->
                                    <p class="card-text text-white fw-bold">Total Poin:
                                        {{ $nilaiPerKavling[$item->id]['total_nilai'] }}</p>
                                @else
                                    <!-- Jika belum dinilai sepenuhnya, tampilkan informasi -->
                                    <p class="card-text text-warning">Belum semua parameter dinilai</p>
                                @endif
                            </div>
                            <div class="d-grid">
                                <!-- Tombol Penjurian jika belum dinilai sepenuhnya -->
                                @if (!$nilaiPerKavling[$item->id]['dinilai'])
                                    <a href="{{ route('penilaian_garden', ['id_kavling' => $item->id, 'id_direksi' => $dataDireksi->id]) }}"
                                        class="btn btn-light fw-bold">
                                        Penjurian
                                    </a>
                                @else
                                    <!-- Jika sudah dinilai, tidak perlu tombol -->
                                    <a href="#" class="btn btn-secondary fw-bold disabled">Sudah Dinilai</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
