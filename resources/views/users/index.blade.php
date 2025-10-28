@extends('layouts.master')

@section('title', 'Usuaris')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4" style="color:brown;">Usuaris</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Correu electrònic</th>
                <th>Data de naixement</th>
                <th style="text-align:center;">Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->birth_date }}</td>
                    <td style="text-align:center;">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary" title="Editar">Editar</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Segur que vols esborrar aquest usuari?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Esborrar">Esborrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection