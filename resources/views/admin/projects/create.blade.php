@extends('layouts.app')

@section('content')
    <div class="container my-admin-main mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1>Crea Nuovo Progetto</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.projects.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Progetto: <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                            placeholder="Inserisci il nome del progetto" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione: <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="5" placeholder="Descrivi il progetto" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="programming_language_id" class="form-label">Linguaggi Utilizzati: <span
                                class="text-danger">*</span></label>
                        <select class="form-control" name="programming_language_id" id="programming_language_id" required>
                            @foreach ($programming_languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Immagine:</label>
                        <input type="url" name="img" class="form-control"
                            placeholder="Inserisci l'URL dell'immagine">
                    </div>
                    <div class="mb-3">
                        <label for="thumbnail_img" class="form-label">Miniatura:</label>
                        <input type="url" name="thumbnail_img" class="form-control"
                            placeholder="Inserisci l'URL della miniatura">
                    </div>
                    <div class="mb-3">
                        <label for="website_url" class="form-label">Sito Web: <span class="text-danger">*</span></label>
                        <input type="url" name="website_url" class="form-control"
                            placeholder="Inserisci l'URL del sito web" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Crea Progetto</button>
                </form>
            </div>
        </div>
    </div>
@endsection
