@extends('layouts.master')

@section('title', 'Gestionar Categories')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4" style="color:brown;">Afegeix una categoria</h2>

    <!-- Formulari per crear una nova categoria -->
    <div class="card shadow bg-white mb-4" style="border-radius: 12px;">
        <div class="card-body">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label" style="font-weight: 600;">Nom de la categoria</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Introdueix el nom de la categoria" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
    </div>

    <!-- Llista de categories existents -->
    <h3 class="mb-3" style="color:brown;">Elimina una categoria</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th style="text-align:center;">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td style="text-align:center;">
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Segur que vols esborrar aquesta categoria?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Esborrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection