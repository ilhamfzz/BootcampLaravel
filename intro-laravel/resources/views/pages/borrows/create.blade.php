@extends('layouts.master')

@section('title')
    Add Borrow
@endsection

@section('content')
<form action="{{ route('borrows.store') }}" method="POST">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @csrf
    {{-- <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-control" id="category_id" name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div> --}}
    <div class="form-group @error('book_id') has-error @enderror">
        <label for="book_id" class="form-control-label">Book</label>
        <select name="book_id" class="form-control">
            <option value="">Please select a book</option>
            @foreach ($books as $book)
                @if ($book->stock > 0)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @else
                    <option value="{{ $book->id }}" disabled>{{ $book->title }} (Out of Stock)</option>
                @endif
            @endforeach
        </select>
        @error('book_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group @error('borrowers_id') has-error @enderror">
        <label for="borrowers_id" class="form-control-label">Borrower</label>
        <select name="borrowers_id" class="form-control">
            <option value="">Please select a borrower</option>
            @foreach ($borrowers as $borrower)
                <option value="{{ $borrower->id }}">{{ $borrower->full_name }}</option>
            @endforeach
        </select>
        @error('borrowers_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group @error('borrow_date') has-error @enderror">
        <label for="borrow_date" class="form-control-label">Borrow Date</label>
        <input type="date" name="borrow_date" value="{{ old('borrow_date') }}" class="form-control">
        @error('borrow_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group
        @error('return_date') has-error @enderror">
        <label for="return_date" class="form-control-label">Return Date</label>
        <input type="date" name="return_date" value="{{ old('return_date') }}" class="form-control">
        @error('return_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        {{-- dipaling bawah ada tulisan submit and cancel --}}
    </div>
    {{-- <div class="form-group @error('status') has-error @enderror">
        <label for="status" class="form-control-label">Status</label>
        <select name="status" class="form-control">
            <option value="">Please select a status</option>
            <option value="returned">Returned</option>
            <option value="not_returned">Not Returned</option>
        </select>
        @error('status')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div> --}}
    <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-block btn-secondary" style="height: 38px;">Cancel</button>
        <div style="width: 20px;"></div>
        <button type="submit" class="btn btn-block btn-primary" style="height: 38px;">Submit</button>
    </div>
</form>
@endsection