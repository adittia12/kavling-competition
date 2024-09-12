@extends('layouts.app')

@section('title')
    Master Direksi
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Data Direksi</h4>
                            </div>
                            {{-- <div class="col">
                                <a href="{{ route('director.create') }}" class="btn btn-success">Add Data</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="w-full flex justify-end mb-3">
                            <form action="{{ route('director.index') }}" method="get">
                                <input type="text" class="form-control" placeholder="Pencarian (Nama Direksi)"
                                    name="q" value="{{ request('q') }}" autofocus>
                            </form>
                        </div>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Direksi</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Photo</th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($direksiData as $index => $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $direksiData->perPage() * ($direksiData->currentPage() - 1) + $index + 1 }}
                                        </th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->position }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}"
                                                class="img-fluid" style="max-width: 100px; height: auto;">
                                        </td>
                                        {{-- <td>
                                            <form action="{{ route('director.destroy', Crypt::encrypt($item->id)) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('director.edit', Crypt::encrypt($item->id)) }}"
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
                        {{ $direksiData->links('pagination::bootstrap-5') }}
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
                                "{{ route('director.destroy', '') }}" + '/' + id);
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
