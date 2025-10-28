@extends('layouts.master')

@section('title', 'Editar Usuari')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4" style="color:brown;">Editar Usuari</h2>
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correu electrònic</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Data de naixement</label>
            <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" required>
        </div>
        <button type="submit" class="btn btn-primary purpol-hover">Modificar</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
@endsection