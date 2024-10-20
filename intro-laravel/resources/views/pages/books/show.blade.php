@extends('layouts.master')
@section('title')
    Detail Book
@endsection

@section('content')
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
    <img src="{{asset ('uploads/books/'.$book->image)}}" alt="image" style="width:25%; display:block; margin:auto;">
    <h1>{{ $book->title }}</h1>
    <h5 class="text-secondary">{{ $book->category->name }}</h5>
    <p>{{ $book->summary }}</p>
    <p> Stock: {{ $book->stock }}</p>
@endsection