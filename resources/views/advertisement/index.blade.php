@extends('layouts.app')

@section('title', 'Svi oglasi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-megaphone"></i> Oglasi</h1>
        <a href="{{ route('advertisements.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novi oglas
        </a>
    </div>

    @if($advertisements->isEmpty())
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> Nema oglasa. <a href="{{ route('advertisements.create') }}">Dodaj prvi oglas!</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Naslov</th>
                        <th>Kategorija</th>
                        <th>Cena</th>
                        <th>Datum početka</th>
                        <th>Datum završetka</th>
                        <th class="text-end">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($advertisements as $advertisement)
                        <tr>
                            <td>{{ $advertisement->id }}</td>
                            <td>
                                <a href="{{ route('advertisements.show', $advertisement) }}" class="text-decoration-none">
                                    {{ $advertisement->title }}
                                </a>
                            </td>
                            <td>
                                @if($advertisement->category)
                                    <span class="badge bg-secondary">{{ $advertisement->category->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ number_format($advertisement->price, 2) }} RSD</td>
                            <td>{{ $advertisement->start_date?->format('d.m.Y') }}</td>
                            <td>{{ $advertisement->end_date?->format('d.m.Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('advertisements.show', $advertisement) }}" class="btn btn-sm btn-outline-info" title="Prikaži">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('advertisements.edit', $advertisement) }}" class="btn btn-sm btn-outline-warning" title="Izmeni">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('advertisements.destroy', $advertisement) }}" method="POST" class="d-inline" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovaj oglas?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Obriši">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
