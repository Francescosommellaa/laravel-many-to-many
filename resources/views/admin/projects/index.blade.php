@extends('layouts.app')

@section('content')
    <div class="container my-admin-main mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card my-card">
                    <div
                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center sticky-header">
                        <h1 class="mb-0">Lista Progetti</h1>
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-light">
                            <i class="fas fa-plus"></i> Aggiungi Nuovo
                        </a>
                    </div>
                    <div class="card-body my-body-card">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrizione</th>
                                    <th>Linguaggio:</th>
                                    <th>Tecnologia:</th>
                                    <th>Slug</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ Str::limit($project->description, 50) }}</td>
                                        <td>{{ $project->programming_language->name ?? 'Nessun linguaggio' }}</td>
                                        <td>
                                            @if ($project->technologies->isNotEmpty())
                                                @foreach ($project->technologies as $technology)
                                                    {{ $technology->name }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            @else
                                                Nessuna tecnologia
                                            @endif
                                        </td>
                                        <td>{{ $project->slug }}</td>
                                        <td>
                                            <a href="{{ route('admin.projects.show', $project->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.projects.edit', $project->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.projects.destroy', $project->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Sei sicuro di voler eliminare questo progetto?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
