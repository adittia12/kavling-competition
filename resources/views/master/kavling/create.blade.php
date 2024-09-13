@extends('layouts.app')

@section('title')
    Tambah Kavling
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Tambah Kavling</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kavling.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name_kavling" class="form-label">Nama Kavling</label>
                                <input type="text" class="form-control @error('name_kavling') is-invalid @enderror"
                                    id="name_kavling" name="name_kavling" value="{{ old('name_kavling') }}"
                                    placeholder="Nama Kavling">
                                @if ($errors->has('name_kavling'))
                                    <span class="text-danger text-sm">{{ $errors->first('name_kavling') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
