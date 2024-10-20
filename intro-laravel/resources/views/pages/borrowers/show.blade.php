@extends('layouts.master')

@section('title')
    Borrower Detail
@endsection

@section('content')
    <br>
    <div class="d-flex justify-content-between align-items-start">
        <a href="{{ route('borrowers.index') }}" class="btn btn-secondary">Back</a>
        <h1>{{ $borrower->full_name }}</h1>
        <div>
            <a href="{{ route('borrowers.edit', $borrower->id) }}" class="btn btn-warning">Edit</a>
            {{-- <form style="display:inline-block" method="POST" action="{{ route('borrowers.destroy', $borrower->id) }}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form> --}}
        </div>
    </div>
    <hr>
    <img src="{{asset ('uploads/ic/'.$borrower->ic_image)}}" alt="image" style="width:50%; display:block; margin:auto;">
    <br>
    <table class="table">    
        {{-- <tr>
            <th>Name</th>
            <td>{{ $borrower->full_name }}</td>
        </tr> --}}
        <tr>
            <th>Email</th>
            <td>{{ $borrower->email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $borrower->phone_number }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $borrower->address }}</td>
        </tr>
        {{-- <tr>
            <th>Created At</th>
            <td>{{ $borrower->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $borrower->updated_at }}</td>
        </tr> --}}
    </table>
    <br>
    <h3>List of borrowed books</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Book Cover</th>
                <th>Book Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrows as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{asset ('uploads/books/'.$item->book->image)}}" alt="image" style="width:50px; height:50px;"></td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->book->category->name }}</td>
                    <td>
                        @if ($item->status == 'returned')
                            <span class="badge badge-success">{{ $item->status }}</span>
                        @else
                            <span class="badge badge-warning">{{ $item->status }}</span>
                        @endif
                    <td>
                        <a href="{{ route('borrows.show', $item->id) }}" class="btn btn-sm btn-block btn-info">Detail</a>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection