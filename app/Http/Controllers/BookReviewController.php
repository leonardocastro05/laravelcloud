<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookUserCreate;

class BookReviewController extends Controller
{
    public function store(Request $request, $bookId)
    {
        $validated = $request->validate([
            'rating' => 'required|numeric|min:0|max:10',
            'review' => 'required|string|max:1000',
        ]);
        BookUserCreate::updateOrCreate(
            ['user_id' => Auth::id(), 'book_id' => $bookId],
            ['rating' => $validated['rating'], 'review' => $validated['review']]
        );
        return redirect()->route('bookshelf.show', $bookId);
    }
}
