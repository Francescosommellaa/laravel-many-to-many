@extends('layouts.app')

@section('content')
    <div class="d-flex">
        <!-- Sidebar - Assumiamo che sia già definita nel layout principale -->

        <div class="flex-grow-1">
            <!-- Header fisso -->
            <header class="sticky-top bg-white shadow-sm">
                <div class="container-fluid px-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0">I tuoi progetti</h1>
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Aggiungi Nuovo
                        </a>
                    </div>
                </div>
            </header>

            <!-- Area di scorrimento per la tabella -->
            <div class="container-fluid px-4 py-4" style="height: calc(100vh - 60px); overflow-y: auto;">
                <!-- Success message -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Projects table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrizione</th>
                                <th>Linguaggio</th>
                                <th>Tecnologie</th>
                                <th class="text-center">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ Str::limit($project->description, 50) }}</td>
                                    <td>
                                        @if ($project->programming_language)
                                            <span class="badge bg-primary">{{ $project->programming_language->name }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($project->technologies as $technology)
                                            <span class="badge bg-secondary">{{ $technology->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.projects.show', $project->id) }}"
                                                class="btn btn-sm btn-outline-info" title="Visualizza">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.projects.edit', $project->id) }}"
                                                class="btn btn-sm btn-outline-warning" title="Modifica">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.projects.destroy', $project->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Elimina"
                                                    onclick="return confirm('Sei sicuro di voler eliminare questo progetto?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4 my-margin">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
