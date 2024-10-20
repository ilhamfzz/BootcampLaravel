@extends('layouts.master')
@section('title')
    Edit Category
@endsection

@section('content')
    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        {{-- Validation errors will be displayed here --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- CSRF Token --}}
        @csrf
        <input type="hidden" name="_method" value="PUT">
        {{-- Input field for name and description --}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" cols="30" rows="10">{{ $category->description }}</textarea>
        </div>
        {{-- Buat button untuk update dan cancel berdampingan dengan sedikit jarak--}}
        <div class="d-flex align-items-start">
            <button type="submit" class="btn btn-primary">Update</button>
            <div style="width: 10px"></div>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
