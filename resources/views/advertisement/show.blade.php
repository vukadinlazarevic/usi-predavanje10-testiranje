@extends('layouts.app')

@section('title', $advertisement->title)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-megaphone"></i> {{ $advertisement->title }}</h4>
                    @if($advertisement->category)
                        <span class="badge bg-light text-dark">{{ $advertisement->category->name }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-muted">Opis</h5>
                        <p class="lead">{{ $advertisement->content }}</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="text-muted mb-1">Cena</h6>
                                    <h4 class="text-success mb-0">{{ number_format($advertisement->price, 2) }} RSD</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="text-muted mb-1">Datum početka</h6>
                                    <h5 class="mb-0">{{ $advertisement->start_date?->format('d.m.Y') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h6 class="text-muted mb-1">Datum završetka</h6>
                                    <h5 class="mb-0">{{ $advertisement->end_date?->format('d.m.Y') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('advertisements.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Nazad na listu
                        </a>
                        <div>
                            <a href="{{ route('advertisements.edit', $advertisement) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Izmeni
                            </a>
                            <form action="{{ route('advertisements.destroy', $advertisement) }}" method="POST" class="d-inline" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovaj oglas?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Obriši
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <small>
                        <i class="bi bi-clock"></i> Kreirano: {{ $advertisement->created_at?->format('d.m.Y H:i') }}
                        @if($advertisement->updated_at && $advertisement->updated_at != $advertisement->created_at)
                            | Izmenjeno: {{ $advertisement->updated_at->format('d.m.Y H:i') }}
                        @endif
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
