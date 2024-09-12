@extends('layout_value.main')
@section('title')
    Penilaian Mini Garden
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

        .form-modern .form-label {
            font-size: 1.2rem;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 0.5rem;
        }

        .form-modern .form-control {
            padding: 10px 15px;
            border-radius: 10px;
            border: 1px solid #ced4da;
        }

        .form-modern .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 10px rgba(37, 117, 252, 0.2);
        }

        .form-modern .btn-primary {
            background-color: #2575fc;
            border: none;
            transition: background-color 0.3s ease;
        }

        .form-modern .btn-primary:hover {
            background-color: #6a11cb;
        }

        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
            font-weight: bold;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <div class="container mt-5">
        <!-- Tombol Back ke halaman daftar kavling -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Tombol Back di kiri -->
                    <a href="{{ route('kavling_data', ['id' => $direksi->id]) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <!-- Judul Form Penjurian -->
                    <h3 class="stylish-text">Form Penjurian Kavling</h3>
                </div>
            </div>
        </div>
        <!-- Card Info Direksi dan Kavling -->
        <div class="row justify-content-center mb-2">
            <div class="col-md-8 text-center">
                <div class="card border-0 shadow-lg p-4 mb-5 bg-body-tertiary rounded">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $direksi->photo) }}" class="img-fluid rounded-start"
                                alt="Foto {{ $direksi->name }}" style="border-radius: 15px; width: 120px">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title stylish-text"
                                    style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); -webkit-background-clip: text; color: transparent;">
                                    <b>{{ $direksi->name }}</b>
                                </h3>
                                <p class="card-text text-muted">Posisi: {{ $direksi->position }}</p>
                                <p class="card-text text-muted">Menilai Kavling: <b>{{ $kavling->name_kavling }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Penilaian -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <form action="{{ route('store_value', ['dir_id' => $direksi->id]) }}" method="POST" class="form-modern">
                    @csrf
                    <input type="hidden" name="kavling_id" value="{{ $kavling->id }}">
                    <input type="hidden" name="direksi_id" value="{{ $direksi->id }}">

                    <!-- Menampilkan parameter penilaian -->
                    @foreach ($parameters as $parameter)
                        <div class="mb-4">
                            <label for="parameter_{{ $parameter->id }}"
                                class="form-label stylish-text">{{ $parameter->name_parameter }}</label>

                            <!-- Menambahkan deskripsi di bawah label berdasarkan nama parameter -->
                            @if (str_contains(strtolower($parameter->name_parameter), '3r'))
                                <p class="text-muted">3R (Reduce, Reuse, Recycle): Mengurangi penggunaan, menggunakan
                                    kembali, dan mendaur ulang material.</p>
                            @elseif (str_contains(strtolower($parameter->name_parameter), 'sustainable'))
                                <p class="text-muted">Sustainable: Mendorong praktik yang berkelanjutan untuk menjaga
                                    kelestarian lingkungan.</p>
                            @elseif (str_contains(strtolower($parameter->name_parameter), 'estetika'))
                                <p class="text-muted">Estetika: Menilai keindahan, desain, dan keselarasan visual dari
                                    lingkungan atau objek.</p>
                            @endif

                            <!-- Dropdown nilai penilaian -->
                            <select class="form-control @error('values.' . $parameter->id) is-invalid @enderror"
                                id="parameter_{{ $parameter->id }}" name="values[{{ $parameter->id }}]">
                                <option value="" disabled
                                    {{ old('values.' . $parameter->id) === null ? 'selected' : '' }}>Pilih nilai</option>
                                <option value="70" {{ old('values.' . $parameter->id) == 70 ? 'selected' : '' }}>70
                                </option>
                                <option value="80" {{ old('values.' . $parameter->id) == 80 ? 'selected' : '' }}>80
                                </option>
                                <option value="90" {{ old('values.' . $parameter->id) == 90 ? 'selected' : '' }}>90
                                </option>
                                <option value="100" {{ old('values.' . $parameter->id) == 100 ? 'selected' : '' }}>100
                                </option>
                            </select>

                            @error('values.' . $parameter->id)
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach

                    <!-- Tombol Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan Penilaian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        @if ($errors->any())
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += '{{ $error }}<br>';
            @endforeach
            Swal.fire({
                title: 'Error!',
                html: errorMessages, // Tampilkan pesan error dalam format HTML
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection
