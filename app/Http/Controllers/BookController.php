<?php

namespace App\Http\Controllers;

use App\Jobs\BookJob;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    public function index()
    {
        $books = Cache::remember('books-page-' . request('page', 1), 60 * 60, function(){
            return Book::paginate(10)->withQueryString();
        });

        $data = [
            'books' => $books
        ];

        // dd(98/10);
        
        return view('index', $data);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'category' => 'required'
        ]);

        try {
            BookJob::dispatch($validatedData);
            return redirect('/books')->with('success', 'New book has been dispatched!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Book failed to dispatch!');
        }
    }
}
