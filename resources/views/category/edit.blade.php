@extends('layouts.app')

@section('title', 'Izmeni kategoriju')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning">
                    <h4 class="mb-0"><i class="bi bi-pencil"></i> Izmeni kategoriju</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Naziv kategorije <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Unesite naziv kategorije" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Nazad
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-lg"></i> Sačuvaj izmene
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
