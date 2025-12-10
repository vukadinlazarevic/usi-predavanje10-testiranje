@extends('layouts.app')

@section('title', 'Sve kategorije')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-tags"></i> Kategorije</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nova kategorija
        </a>
    </div>

    @if($categories->isEmpty())
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> Nema kategorija. <a href="{{ route('categories.create') }}">Dodaj prvu kategoriju!</a>
        </div>
    @else
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-tag"></i> {{ $category->name }}
                            </h5>
                            <p class="card-text text-muted">
                                ID: {{ $category->id }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-outline-info">
                                    <i class="bi bi-eye"></i> Prikaži
                                </a>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-warning">
                                    <i class="bi bi-pencil"></i> Izmeni
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu kategoriju?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-trash"></i> Obriši
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
