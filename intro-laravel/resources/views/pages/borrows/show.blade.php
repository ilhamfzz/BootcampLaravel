@extends('layouts.master')

@section('title')
    Detail Borrow
@endsection

@section('content')
    <br>
    <div class="d-flex justify-content-between align-items-start">
        <a href="{{ route('borrows.index') }}" class="btn btn-secondary">Back</a>
        <h1>{{ $borrow->book->title }}</h1>
        <div>
            {{-- <a href="{{ route('borrows.edit', $borrow->id) }}" class="btn btn-warning">Edit</a>
            <form style="display:inline-block" method="POST" action="{{ route('borrows.destroy', $borrow->id) }}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form> --}}
        </div>
    </div>
    <hr>
    <img src="{{asset ('uploads/books/'.$borrow->book->image)}}" alt="image" style="width:25%; display:block; margin:auto;">
    <br>
    <table class="table">    
        <tr>
            <th>Borrow Date</th>
            <td>{{ $borrow->borrow_date }}</td>
        </tr>
        <tr>
            <th>Return Date</th>
            <td>{{ $borrow->return_date }}</td>
        </tr>
        <tr>
            <th>Book</th>
            <td>{{ $borrow->book->title }}</td>
        </tr>
        {{-- <tr>
            <th>Borrower</th>
            <td>{{ $borrow->borrower->full_name }}</td>
        </tr> --}}
        {{-- <tr>
            <th>Created At</th>
            <td>{{ $borrow->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $borrow->updated_at }}</td>
        </tr> --}}
        <tr>
            <th>Status</th>
            <td>
                @if ($borrow->status == 'returned')
                    <span class="badge badge-success">{{ $borrow->status }}</span>
                @else
                    <span class="badge badge-warning">{{ $borrow->status }}</span>
                @endif
            </td>
        </tr>
    </table>

    <br>
    <h3>Borrower Detail</h3>
    <img src="{{asset ('uploads/ic/'.$borrow->borrower->ic_image)}}" alt="ic_image" style="width:50%; display:block; margin:auto;">
    <br>
    <table class="table">
        <tr>
            <th>Full Name</th>
            <td>{{ $borrow->borrower->full_name }}</td>
        </tr>
        <tr>
            <th>IC Number</th>
            <td>{{ $borrow->borrower->ic_number }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $borrow->borrower->address }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $borrow->borrower->phone_number }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $borrow->borrower->email }}</td>
        </tr>
    </table>
    <br>
    <div class="d-flex align-items-start">
        @if ($borrow->status == 'not_returned')
            <form method="POST" action="{{ route('borrows.return', $borrow->id) }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-sm btn-success" style="width:100px">Return</button>
            </form>
        @else 
            <button class="btn btn-sm btn-success" disabled="true" style="width:100px">Returned</button>     
        @endif
        <div style="width:10px"></div>
            <a href="{{ route('borrows.index') }}" class="btn btn-sm btn-secondary" style="width:100px">Back</a>
    </div>
    
@endsection