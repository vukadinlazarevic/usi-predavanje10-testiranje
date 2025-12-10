@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="bi bi-tag"></i> {{ $category->name }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">ID:</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Naziv:</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>Kreirano:</th>
                            <td>{{ $category->created_at?->format('d.m.Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Izmenjeno:</th>
                            <td>{{ $category->updated_at?->format('d.m.Y H:i') }}</td>
                        </tr>
                    </table>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Nazad na listu
                        </a>
                        <div>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Izmeni
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovu kategoriju?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Obriši
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
