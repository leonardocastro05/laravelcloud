@extends('layouts.master')

@section('title', 'Editar Llibre')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-4">Editar Llibre</h2>
        <form method="POST" action="{{ route('bookshelf.update', ['id' => $book->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Títol</label>
                <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $book->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Autor</label>
                <input id="author" type="text" class="form-control" name="author" value="{{ old('author', $book->author) }}" required>
            </div>

            <div class="mb-3">
                <label for="synopsis" class="form-label">Synopsis</label>
                <textarea id="synopsis" class="form-control" name="synopsis" rows="4" required>{{ old('synopsis', $book->synopsis) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="published_date" class="form-label">Data de publicació</label>
                <input id="published_date" type="date" class="form-control" name="published_date" value="{{ old('published_date', $book->published_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Preu (€)</label>
                <input id="price" type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $book->price) }}" required>
            </div>

            <div class="mb-3">
                <label for="age_rating" class="form-label">Edad Recomenada</label>
                <input id="age_rating" type="number" class="form-control" name="age_rating" value="{{ old('age_rating', $book->age_rating) }}" required>
            </div>

            <div class="mb-3">
                <label for="categorie_id" class="form-label">Categoria</label>
                <select id="categorie_id" name="categorie_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('categorie_id', $book->categorie_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="book_cover" class="form-label">Portada</label>
                <input id="book_cover" type="file" class="form-control" name="book_cover">
                @if($book->book_cover)
                    <div class="mt-2">
                        <img src="{{ $book->book_cover }}" alt="Current cover" style="max-width: 120px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary purpol-hover">Guardar canvis</button>
            <a href="{{ route('bookshelf.show', ['id' => $book->id]) }}" class="btn btn-secondary">Cancelar canvis</a>
        </form>
        <div class="mb-5"></div>
    </div>
</div>
@endsection