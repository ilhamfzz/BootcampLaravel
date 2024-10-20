@extends('layouts.master')
@section('title')
    Category Detail
@endsection

@section('content')
{{-- Buat tand icon back dan nama category allignment start, kemudian tombol edit dan delete berada pada alignment end--}}
    @auth
        <br>
        <div class="d-flex justify-content-between align-items-start">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
            <h1>{{ $category->name }}</h1>
            <div>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                <form style="display:inline-block" method="POST" action="{{ route('categories.destroy', $category->id) }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    @endauth
    @guest
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        <h1 class="text-center">{{ $category->name }}</h1>
    @endguest
    <br>
    @auth
        <table class="table">    
                <tr>
                    <th>Description</th>
                    <td>{{ $category->description }}</td>
                </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $category->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $category->updated_at }}</td>
                    </tr>
        </table>
    @endauth

    @guest
        <p>{{ $category->description }}</p>
    @endguest

    <h3>List of Books</h3>
    <div class="row">
        @forelse ($category->listBooks as $item)
            <div class="col-3">
                <div class="card" style="width: 20rem;">
                    <img src="{{ asset('uploads/books/'.$item->image) }}" class="card-img-top" alt="..." style="height: 210px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{  Str::limit($item->title, 20, '...') }}</h5>
                        <p class="card-text">{{ Str::limit($item->summary, 50, '...') }}</p>
                        <a href="{{ route('books.show', ['book' => $item->id]) }}" class="btn btn-primary btn-block">Detail</a>
                        @auth
                        <div style="height: 8px"></div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('books.edit', ['book' => $item->id]) }}" class="btn btn-warning btn-block">Edit</a>
                            <div style="width: 10px"></div>
                            <form action="{{ route('books.destroy', ['book' => $item->id]) }}" method="POST">
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
            <p>No books in this category</p>    

        @endforelse 
    </div>
@endsection
