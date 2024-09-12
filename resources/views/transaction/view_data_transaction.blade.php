@extends('layouts.app')

@section('title')
    Master Transaksi
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Data Transaksi</h4>
                            </div>
                            <div class="col">
                                <a href="{{ route('transaction.create') }}" class="btn btn-success">Tambah Nilai Vidio</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="w-full flex justify-end mb-3">
                            <form action="{{ route('transaction_datavalue') }}" method="get">
                                <input type="text" class="form-control" placeholder="Pencarian" name="q"
                                    value="{{ request('q') }}" autofocus>
                            </form>
                        </div>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kavling</th>
                                    <th scope="col">Direksi</th>
                                    <th scope="col">Parameter</th>
                                    <th scope="col">Value</th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTransaction as $index => $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $dataTransaction->perPage() * ($dataTransaction->currentPage() - 1) + $index + 1 }}
                                        </th>
                                        <td>{{ $item->name_kavling }}</td>
                                        <td>{{ $item->name_director }}</td>
                                        <td>{{ $item->name_parameter }}</td>
                                        <td>{{ $item->value }}</td>
                                        <td>
                                            <form action="{{ route('transaction.destroy', $item->id_transaction) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                {{-- <a href="{{ route('director.edit', Crypt::encrypt($item->id)) }}"
                                                    class="btn btn-primary btn-sm">Edit</a> --}}
                                                <button type="button" class="btn btn-danger btn-sm delete-button"
                                                    data-id-group="{{ $item->id_transaction }}"><i class="bi bi-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $dataTransaction->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        // Tambahkan event listener untuk tombol "Delete"
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach((button) => {
                button.addEventListener('click', function() {
                    const id = button.getAttribute('data-id-group');
                    Swal.fire({
                        title: 'Delete Confirmation',
                        text: 'Do you want to delete this transaction data?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika pengguna mengonfirmasi, kirimkan permintaan penghapusan
                            const form = document.createElement('form');
                            form.setAttribute('action',
                                "{{ route('transaction.destroy', '') }}" + '/' + id);
                            form.setAttribute('method', 'POST');
                            form.innerHTML = `
                            @csrf
                            @method('DELETE')
                        `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
@endsection
