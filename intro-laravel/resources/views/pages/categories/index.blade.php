@extends('layouts.master')

@section('title')
    Categories
@endsection

@section('content')
    {{-- Buat tombol (bukan link) untuk create category --}}
    @auth
        <button class="btn btn-primary" onclick="window.location.href='{{ route('categories.create') }}'">Create Category</button>
    @endauth
    <table class="table">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                @auth
                    <th>Created At</th>
                    <th>Updated At</th>
                @endauth
                    <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    {{-- <th>{{ $category->id }}</th> --}}
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $category->name }}</td>
                    @auth
                        <td>{{ Str::limit($category->description, 50, '...') }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                    @endauth
                    @guest
                        <td>{{ Str::limit($category->description, 100, '...') }}</td>
                    @endguest
                    <td>
                        @auth
                            <div class="d-flex justify-content-center align-items-start">
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <div style="width: 10px"></div>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <div style="width: 10px"></div>
                                <form style="display:inline-block" method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        @endauth
                        @guest
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-block btn-info">Detail</a>
                        @endguest
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection