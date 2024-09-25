@extends('layouts.app')

@section('content')
    <div class="container my-admin-main mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1>{{ $project->name }}</h1>
                <div>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left"></i> Torna Indietro
                    </a>
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifica
                    </a>
                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Sei sicuro di voler eliminare questo progetto?')">
                            <i class="fas fa-trash-alt"></i> Elimina
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <p>{{ $project->description }}</p>
                <span>{{ $project->programming_language->name ?? 'Nessun linguaggio' }}</span>
                @if ($project->img)
                    <img src="{{ $project->img }}" alt="{{ $project->name }}" class="img-fluid">
                @endif
                @if ($project->thumbnail_img)
                    <img src="{{ $project->thumbnail_img }}" alt="{{ $project->name }}" class="img-thumbnail mt-3">
                @endif
                @if ($project->website_url)
                    <p><a href="{{ $project->website_url }}" target="_blank">Visita il sito web</a></p>
                @endif
            </div>
        </div>
    </div>
@endsection
