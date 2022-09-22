<?php

namespace App\Http\Controllers;

use App\Jobs\BookJob;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $count = ceil(Book::count() / 10);

        if(request('page') > $count){
            return redirect('/books')->with('error', 'Page tidak ditemukan!');
        }

        $books = Cache::remember('books-page-' . request('page', 1), 60 * 60, function(){
            return Book::paginate(10)->withQueryString();
        });

        $data = [
            'books' => $books
        ];
        
        return view('index', $data);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255|unique:App\Models\Book,title',
            'author' => 'required|starts_with:M|regex:(.)',
            'category' => 'required|not_regex:(.)'
        ];

        $validatedData = $request->validate($rules);

        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails())
        // return redirect()->back()->with('error', 'Field not match!');

        // $data = [
        //     'title' => $request->title,
        //     'author' => $request->author,
        //     'category' => $request->category
        // ];

        try {
            BookJob::dispatch($validatedData);
            return redirect('/books')->with('success', 'New book has been dispatched!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Book failed to dispatch!');
        }
    }
}
