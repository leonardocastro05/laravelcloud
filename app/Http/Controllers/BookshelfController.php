<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class BookshelfController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // Filtra per categoria
        if ($request->has('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }

        // Filtra per age_rating
        if (Auth::check() && Auth::user()->birth_date) {
            $userBirthDate = Auth::user()->birth_date;
            $userAge = Carbon::parse($userBirthDate)->age;
            $query->where('age_rating', '<=', $userAge);
        }

        // Paginació
        $perPage = (Auth::check() && Auth::user()->email === 'admin@admin.es') ? 4 : 4;
        $books = $query->orderBy('title', 'asc')->paginate($perPage);

        return view('bookshelf.index', ['books' => $books]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('categorie')->findOrFail($id);

        // Comprova l'edat de l'usuari
        if (Auth::check() && Auth::user()->birth_date) {
            $userAge = Carbon::parse(Auth::user()->birth_date)->age;
            if ($book->age_rating > $userAge) {
                abort(403, 'No tens edat suficient per aquest llibre');
            }
        }

        $reviews = $book->reviews()->with('user')->get();
        $averageRating = $book->reviews()->avg('rating');
        $userReview = null;
        if (Auth::check()) {
            $userReview = $book->reviews()->where('user_id', Auth::id())->first();
        }
        return view('bookshelf.show', compact('book', 'reviews', 'averageRating', 'userReview'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('bookshelf.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'published_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'age_rating' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'book_cover' => 'nullable|image|max:2048',
        ]);

        // Gestió de la pujada de la portada - SENSE /storage/
        if ($request->hasFile('book_cover')) {
            $validated['book_cover'] = $request->file('book_cover')->store('book_covers', 'public');
        }

        Book::create($validated);

        return redirect()->route('bookshelf.index')->with('success', 'Llibre creat !.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Categorie::all();
        return view('bookshelf.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'published_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'age_rating' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'book_cover' => 'nullable|image|max:2048',
        ]);

        $book = Book::findOrFail($id);

        // Handle book cover upload if a new file is provided
        if ($request->hasFile('book_cover')) {
            // Eliminar imatge anterior si existeix
            if ($book->book_cover && Storage::disk('public')->exists($book->book_cover)) {
                Storage::disk('public')->delete($book->book_cover);
            }
            // Guardar nova imatge - SENSE /storage/
            $validated['book_cover'] = $request->file('book_cover')->store('book_covers', 'public');
        } else {
            // Keep the old cover if no new file is uploaded
            unset($validated['book_cover']);
        }

        $book->update($validated);

        return redirect()->route('bookshelf.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        // Eliminar la imatge si existeix
        if ($book->book_cover && Storage::disk('public')->exists($book->book_cover)) {
            Storage::disk('public')->delete($book->book_cover);
        }

        $book->delete();
        return redirect()->route('bookshelf.index')->with('success', 'Llibre esborrat i valoracions eliminades.');
    }
}
