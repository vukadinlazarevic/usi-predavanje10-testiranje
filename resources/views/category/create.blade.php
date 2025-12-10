@extends('layouts.app')

@section('title', 'Nova kategorija')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-plus-lg"></i> Nova kategorija</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Naziv kategorije <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Unesite naziv kategorije" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Nazad
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i> Sačuvaj
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
