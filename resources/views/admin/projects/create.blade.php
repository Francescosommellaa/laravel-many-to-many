@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4 text-center">Crea Nuovo Progetto</h1>

                <form action="{{ route('admin.projects.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Nome Progetto</label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg"
                            placeholder="Inserisci il nome del progetto" required>
                        <div class="invalid-feedback">Inserisci il nome del progetto.</div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">Descrizione</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Descrivi il progetto"
                            required></textarea>
                        <div class="invalid-feedback">Inserisci una descrizione per il progetto.</div>
                    </div>

                    <div class="mb-4">
                        <label for="programming_language_id" class="form-label fw-bold">Linguaggi Utilizzati</label>
                        <select class="form-select" name="programming_language_id" id="programming_language_id" required>
                            <option value="">Seleziona un linguaggio</option>
                            @foreach ($programming_languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Seleziona un linguaggio di programmazione.</div>
                    </div>

                    <div class="mb-4">
                        <label for="technologies" class="form-label fw-bold">Tecnologie</label>
                        <select class="form-select" name="technologies[]" id="technologies" required>
                            @foreach ($technologies as $technology)
                                <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Seleziona almeno una tecnologia.</div>
                    </div>

                    <div class="mb-4">
                        <label for="img" class="form-label fw-bold">Immagine (URL)</label>
                        <input type="url" name="img" id="img" class="form-control"
                            placeholder="Inserisci l'URL dell'immagine">
                    </div>

                    <div class="mb-4">
                        <label for="thumbnail_img" class="form-label fw-bold">Miniatura (URL)</label>
                        <input type="url" name="thumbnail_img" id="thumbnail_img" class="form-control"
                            placeholder="Inserisci l'URL della miniatura">
                    </div>

                    <div class="mb-4">
                        <label for="website_url" class="form-label fw-bold">Sito Web</label>
                        <input type="url" name="website_url" id="website_url" class="form-control"
                            placeholder="Inserisci l'URL del sito web" required>
                        <div class="invalid-feedback">Inserisci un URL valido per il sito del progetto.</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Crea Progetto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
