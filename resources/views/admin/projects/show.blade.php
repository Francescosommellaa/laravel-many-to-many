@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="h3 mb-0">{{ $project->name }}</h1>
                            <div>
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-light btn-sm me-2"
                                    title="Torna Indietro">
                                    <i class="fas fa-arrow-left"></i> Indietro
                                </a>
                                <a href="{{ route('admin.projects.edit', $project->id) }}"
                                    class="btn btn-warning btn-sm me-2" title="Modifica Progetto">
                                    <i class="fas fa-edit"></i> Modifica
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Elimina Progetto"
                                        onclick="return confirm('Sei sicuro di voler eliminare questo progetto?')">
                                        <i class="fas fa-trash-alt"></i> Elimina
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title mb-3">Descrizione</h5>
                                <p class="card-text">{{ $project->description }}</p>

                                <h5 class="card-title mb-3 mt-4">Dettagli Tecnici</h5>
                                <p class="mb-2">
                                    <strong>Linguaggio:</strong>
                                    <span
                                        class="badge bg-primary">{{ $project->programming_language->name ?? 'Nessun linguaggio' }}</span>
                                </p>
                                <p class="mb-2">
                                    <strong>Tecnologie:</strong>
                                    @forelse($project->technologies as $technology)
                                        <span class="badge bg-secondary">{{ $technology->name }}</span>
                                    @empty
                                        <span class="text-muted">Nessuna tecnologia specificata</span>
                                    @endforelse
                                </p>

                                @if ($project->website_url)
                                    <a href="{{ $project->website_url }}" target="_blank"
                                        class="btn btn-outline-primary mt-3">
                                        <i class="fas fa-external-link-alt"></i> Visita il sito web
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if ($project->img)
                                    <img src="{{ $project->img }}" alt="{{ $project->name }}"
                                        class="img-fluid rounded mb-3">
                                @endif
                                @if ($project->thumbnail_img)
                                    <img src="{{ $project->thumbnail_img }}" alt="Thumbnail di {{ $project->name }}"
                                        class="img-thumbnail mt-3">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
