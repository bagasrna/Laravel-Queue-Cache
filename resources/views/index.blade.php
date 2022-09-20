@extends('layouts.main')

@section('container')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">My Books</h1>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  
  <div class="table-responsive col-lg-8">
    <a href="/books/create" class="btn btn-primary mb-3">Create new book</a>
    <table class="table table-striped table-sm">
      @if(count($books) == 0)
          <h3>Buku Kosong! Silahkan Menambahkan Buku Dahulu Dengan Menggunakan Seed</h3>
      @else
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Title</th>
          <th scope="col">Author</th>
          <th scope="col">Category</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($books as $book)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $book->title }}</td>
          <td>{{ $book->author }}</td>
          <td>{{ $book->category }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
  <div class="d-flex justify-content-center">
    {{ $books->links() }}
  </div>
</main>
@endsection