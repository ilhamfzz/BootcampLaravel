@extends('layouts.master')

@section('title')
    Edit Borrower
@endsection

@section('content')
    <form method="POST" action="{{ route('borrowers.update', $borrower->id) }}" enctype="multipart/form-data">
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
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $borrower->full_name }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $borrower->email }}">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $borrower->phone_number }}">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $borrower->address }}">
        </div>
        <div class="form-group">
            <label for="ic_number">Identity Number</label>
            <input type="text" class="form-control" id="ic_number" name="ic_number" value="{{ $borrower->ic_number }}">
        </div>
        <div class="form-group">
            <label for="ic_image">Identity Image</label>
            <input type="file" class="form-control-file" id="ic_image" name="ic_image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('borrowers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection