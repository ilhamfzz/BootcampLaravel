@extends('layouts.master')

@section('title')
    Borrowed List
@endsection

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add Borrow
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
            <tr class="text-center">
                <th>#</th>
                <th>Book</th>
                <th>Borrower</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrows as $borrow)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrow->book->title }}</td>
                    <td>{{ $borrow->borrower->full_name }}</td>
                    <td>{{ $borrow->borrow_date }}</td>
                    <td>{{ $borrow->return_date }}</td>
                    <td>
                        @if ($borrow->status == 'returned')
                            <span class="badge badge-success">{{ $borrow->status }}</span>
                        @else
                            <span class="badge badge-warning">{{ $borrow->status }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($borrow->status == 'returned')
                            <a href="{{ route('borrows.show', $borrow->id) }}" class="btn btn-block btn-sm btn-info" style="align-items: center; padding: 0px 0px;">Detail</a>
                        @else
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('borrows.return', $borrow->id) }}" class="btn btn-block btn-sm btn-success" style="align-items: center; padding: 0px 0px;">Return</a>
                                <div style="width: 20px;"></div>
                                <a href="{{ route('borrows.show', $borrow->id) }}" class="btn btn-block btn-sm btn-info" style="align-items: center; padding: 0px 0px;">Detail</a>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection