@extends('layouts.app')

@section('title')
    Nilai Vidio Kavling
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Nilai Vidio</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaction.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kavling</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kavlingList as $key => $kavling)
                                            <tr>
                                                <td>
                                                    <!-- Menyimpan ID kavling dalam input hidden -->
                                                    <input type="hidden" name="kavling_id[{{ $key }}]"
                                                        value="{{ $kavling->id }}">

                                                    <!-- Menampilkan nama kavling hanya sebagai readonly -->
                                                    <input type="text" class="form-control"
                                                        value="{{ $kavling->name_kavling }}" readonly>
                                                </td>
                                                <td>
                                                    <!-- Input nilai untuk setiap kavling -->
                                                    <input type="number" inputmode="numeric"
                                                        class="form-control @error('value.' . $key) is-invalid @enderror"
                                                        name="value[{{ $key }}]" placeholder="Berikan Nilai"
                                                        value="{{ old('value.' . $key) }}">
                                                    @error('value.' . $key)
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
