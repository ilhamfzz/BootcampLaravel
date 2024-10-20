@extends('layouts.master')

@section('title')
    List of Borrower
@endsection

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add Borrowing
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hi Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Have customers been recorded or have they borrowed books?
                </div>
                <div class="modal-footer">
                    <a href="{{ route('borrowers.create') }}" class="btn btn-secondary">No</a>
                    <a href="{{ route('borrows.create') }}" class="btn btn-primary">Yes</a>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrowers as $borrower)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $borrower->full_name }}</td>
                    <td>{{ $borrower->email }}</td>
                    <td>{{ $borrower->phone_number }}</td>
                    <td>{{ $borrower->address }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('borrowers.edit', $borrower->id) }}" class="btn btn-block btn-warning btn-sm" style="height: 30px;">Edit</a>
                        <div style="width: 10px;"></div>
                        <a href="{{ route('borrowers.show', $borrower->id) }}" class="btn btn-block btn-info btn-sm" style="height: 30px;">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection