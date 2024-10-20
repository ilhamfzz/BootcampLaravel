@extends('layouts.master')

@section('title')
    Create Category
@endsection

@section('content')
    <form method="POST" action="{{ route('categories.store') }}">
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
        {{-- Input field for name and description --}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" cols="30" rows="10"></textarea>
        </div>
        {{-- Buat button untuk create dan cancel berdampingan dengan sedikit jarak--}}
        <div class="d-flex align-items-start">
            <button type="submit" class="btn btn-primary">Create</button>
            <div style="width: 10px"></div>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection