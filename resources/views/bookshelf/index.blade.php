@extends('layouts.master')

@section('title', 'Afegir Llibre')

@section('content')

<div class="row g-4">

    @if(Auth::check() && Auth::user()->email === 'admin@admin.es')

    <a href="{{ route('bookshelf.create') }}" class="w-100 h-100 text-decoration-none">
        <div class="add-book-card rounded-3 d-flex flex-column justify-content-center align-items-center">
            <span style="font-size:24px; color: brown">Afegir Llibre</span>
        </div>
    </a>

    @endif

    @foreach($books as $book)
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
        <div class="card shadow-sm border-0 w-100 h-100 book-card">
            <a href="{{ url('/bookshelf/show/' . $book->id ) }}" class="text-decoration-none text-dark">
                <div style="width:100%; aspect-ratio:3/4; display:flex; align-items:center; justify-content:center;">
                    <img src="{{ $book->book_cover }}"
                        class="card-img-top rounded-top img-fluid"
                        alt="book_cover"
                        style="max-width:100%; max-height:100%; object-fit:contain; background:#f7f4ff;">
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <h4 class="card-title mb-2" style="min-height:45px; color:brown;">{{ $book->title }}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $book->author }}</h6>
                    <div class="mb-2" style="font-size:0.95em;">
                        <span class="badge" style="background:brown; color:white;">
                            @php
                            $avg = $book->reviews()->avg('rating');
                            @endphp
                            {{ $avg ? number_format($avg, 2) : 'Sense Valoracions' }}
                        </span>
                    </div>
                    <div class="text-muted" style="font-size:0.9em;">
                        <span><strong>Categoria:</strong> {{ $book->categorie->name ?? 'Sense categoria' }}</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
    <div class="mt-4 w-100 d-flex justify-content-end">
        {{ $books->links() }}
    </div>
</div>
<div class="mb-5"></div>
@endsection