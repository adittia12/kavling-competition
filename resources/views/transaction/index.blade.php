@extends('layouts.app')
@section('title', 'Kavling Ranking')

@section('style')
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Roboto', sans-serif;
        }

        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .card-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 20px;
        }

        .ranking-title {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            margin: 0;
        }

        .card-body {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 0 0 12px 12px;
        }

        .table {
            margin-bottom: 0;
            width: 100%;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            padding: 12px;
            font-size: 1rem;
        }

        .table thead th {
            background-color: #6a11cb;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table td {
            font-weight: 500;
            color: #555555;
        }

        /* Custom ranking styles */
        .rank-1-3 {
            background-color: #FFD700;
            /* Emas untuk rank 1-3 */
            color: #1f1f7a;
            font-weight: bold;
        }

        .rank-4-5 {
            background-color: #C0C0C0;
            /* Perak untuk rank 4-5 */
            color: #1f1f7a;
            font-weight: bold;
        }

        .rank-6-10 {
            background-color: #CD7F32;
            /* Perunggu untuk rank 6-10 */
            color: #1f1f7a;
            font-weight: bold;
        }

        .table td.total-column {
            font-weight: bold;
            background-color: #f9fafb;
        }

        /* Button styling */
        .btn-custom {
            background-color: #6a11cb;
            border-color: #6a11cb;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #2575fc;
            border-color: #2575fc;
        }
    </style>
@endsection

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="ranking-title">Peringkat Mini Garden</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Kavling</th>
                                        @foreach ($directors as $director)
                                            <th>{{ $director->name }}</th>
                                        @endforeach
                                        <th>Total Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rankingData as $rank => $data)
                                        <tr
                                            class="
                                            {{ $rank < 3 ? 'rank-1-3' : '' }}
                                            {{ $rank >= 3 && $rank < 5 ? 'rank-4-5' : '' }}
                                            {{ $rank >= 5 && $rank < 10 ? 'rank-6-10' : '' }}
                                        ">
                                            <td>{{ $rank + 1 }}</td>
                                            <td>{{ $data['kavling'] }}</td>

                                            <!-- Menampilkan total nilai dari setiap direksi -->
                                            @foreach ($directors as $director)
                                                <td>
                                                    {{ number_format(array_sum($data['nilai_per_direksi'][$director->name] ?? []), 0) }}
                                                </td>
                                            @endforeach

                                            <!-- Total nilai keseluruhan untuk kavling -->
                                            <td class="total-column">{{ number_format($data['total_nilai'], 0) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ 3 + $directors->count() }}" class="text-center empty-row">Belum
                                                ada data nilai.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
