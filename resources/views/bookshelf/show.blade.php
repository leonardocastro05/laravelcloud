@extends('layouts.master')

@section('title', 'Mostra informació del llibre')

@section('content')

<div class="row justify-content-center mt-4">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0">
            <div style="width:100%; aspect-ratio:3/4; background:#f7f4ff; display:flex; align-items:center; justify-content:center;">
                <img src="{{ $book->book_cover }}"
                    class="card-img-top rounded-top img-fluid"
                    alt="portada_llibre"
                    style="max-width:100%; max-height:100%; object-fit:contain; background:#f7f4ff;">
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:brown;">{{ $book->title }}</h2>
                <h5 class="mb-3 text-muted">{{ $book->author }}</h5>
                <p class="mb-3"><span class="fw-bold">Sinopsi:</span> {{ $book->synopsis }}</p>
                <div class="row mb-2">
                    <div class="col-6"><strong>Data de publicació:</strong> {{ $book->published_date }}</div>
                    <div class="col-6"><strong>Preu:</strong> {{ $book->price }} €</div>
                </div>
                <div class="row mb-2">
                    <div class="col-6"><strong>Edat recomanada:</strong> {{ $book->age_rating }}+</div>
                    <div class="col-6"><strong>Categoria:</strong> {{ $book->categorie->name ?? 'Sense categoria' }}</div>
                </div>
                <div class="mb-3">
                    <strong>Valoració mitjana:</strong>
                    <span class="badge" style="background:brown; color:white;">
                        {{ $averageRating ? number_format($averageRating, 2) : 'Sense valoracions' }} / 10.00
                    </span>
                </div>
                <div class="d-flex gap-2">
                    @if (Auth::user() && Auth::user()->email === 'admin@admin.es')
                    <a href="{{ route('bookshelf.edit', ['id' => $book->id]) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('bookshelf.destroy', ['id' => $book->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Segur que vols esborrar aquest llibre? Aquesta acció posarà les valoracions a null.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Esborrar</button>
                    </form>
                    @endif
                    <a href="{{ route('bookshelf.index') }}" class="btn btn-outline-secondary purpol-hover">Tornar a la biblioteca</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <h5 class="mb-3" style="color:brown;">Valoracions</h5>
        @forelse($reviews as $review)
        <div class="mb-3">
            <span class="fw-bold" style="color:brown;">{{ $review->user->name }}</span>
            <span style="color:brown;">{{ $review->rating }}/10</span>
            <p>{{ $review->review }}</p>
        </div>
        @empty
        <p>Encara no hi ha valoracions.</p>
        @endforelse

        @if(Auth::check())
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h5 class="mb-3" style="color:brown;">Deixa la teva valoració</h5>
                <form method="POST" action="{{ route('bookshelf.review', $book->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="rating" class="form-label">Puntuació:</label>
                        <input type="range" name="rating" id="rating" min="0" max="10" step="1"
                            value="{{ old('rating', $userReview->rating ?? 5) }}" class="form-range">
                        <div id="ratingValue" style="text-align: center; color: brown; font-weight: bold;">
                            {{ old('rating', $userReview->rating ?? 5) }}/10
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Comentari:</label>
                        <textarea name="review" id="review" rows="3" required class="form-control">{{ old('review', $userReview->review ?? '') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        {{ $userReview ? 'Actualitzar valoració' : 'Enviar valoració' }}
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection