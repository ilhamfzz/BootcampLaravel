@extends('layouts.master')
@section('title')
    Books
@endsection

@section('content')
    @auth
        <button class="btn btn-primary" onclick="window.location.href='{{ route('books.create') }}'">Create Book</button>
        <br><br>
    @endauth
    <div class="row">
        @forelse ($books as $book)
            <div class="col-3">
                <div class="card" style="width: 20rem;">
                    <img src="{{ asset('uploads/books/'.$book->image) }}" class="card-img-top" alt="..." style="height: 210px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">{{ Str::limit($book->title, 20, '...') }}</h5>
                            <span class="badge badge-info">{{ $book->category->name }}</span>
                        </div>
                        <p class="card-text">{{ Str::limit($book->summary, 50, '...') }}</p>
                        <a href="{{ route('books.show', ['book' => $book->id]) }}" class="btn btn-primary btn-block">Detail</a>
                        @auth
                        <div style="height: 8px"></div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('books.edit', ['book' => $book->id]) }}" class="btn btn-warning btn-block">Edit</a>
                            <div style="width: 10px"></div>
                            <form action="{{ route('books.destroy', ['book' => $book->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-block">Delete</button>
                            </form>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p>No books</p>
        @endforelse
    </div>
@endsection