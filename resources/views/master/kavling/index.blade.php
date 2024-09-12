@extends('layouts.app')

@section('title')
    Master Kavling
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Data Kavling</h4>
                            </div>
                            {{-- <div class="col">
                                <a href="{{ route('kavling.create') }}" class="btn btn-success">Add Data</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="w-full flex justify-end mb-3">
                            <form action="{{ route('kavling.index') }}" method="get">
                                <input type="text" class="form-control" placeholder="Pencarian (Nama Kavling)"
                                    name="q" value="{{ request('q') }}" autofocus>
                            </form>
                        </div>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Kavling</th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kavlingData as $index => $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $kavlingData->perPage() * ($kavlingData->currentPage() - 1) + $index + 1 }}
                                        </th>
                                        <td>{{ $item->name_kavling }}</td>
                                        {{-- <td>
                                            <form action="{{ route('kavling.destroy', Crypt::encrypt($item->id)) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('kavling.edit', Crypt::encrypt($item->id)) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                <button type="button" class="btn btn-danger btn-sm delete-button"
                                                    data-id-group="{{ Crypt::encrypt($item->id) }}"><i
                                                        class="bi bi-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $kavlingData->links('pagination::bootstrap-5') }}
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
                        text: 'Do you want to delete this group?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika pengguna mengonfirmasi, kirimkan permintaan penghapusan
                            const form = document.createElement('form');
                            form.setAttribute('action',
                                "{{ route('kavling.destroy', '') }}" + '/' + id);
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
