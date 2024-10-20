@extends('layouts.master')

@section('title')
    Add Borrowers
@endsection

@section('content')
    <form action="{{ route('borrowers.store') }}" method="POST" enctype="multipart/form-data">
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
        <div class="form-group @error('full_name') has-error @enderror">
            <label for="full_name" class="form-control-label">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control">
            @error('full_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group @error('email') has-error @enderror">
            <label for="email" class="form-control-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group @error('phone_number') has-error @enderror">
            <label for="phone_number" class="form-control-label">Phone Number</label>
            <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control">
            @error('phone_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group @error('address') has-error @enderror">
            <label for="address" class="form-control-label">Address</label>
            <textarea name="address" class="form-control">{{ old('address') }}</textarea>
            @error('address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group @error('ic_number') has-error @enderror">
            <label for="ic_number" class="form-control-label">Identity Number</label>
            <input type="text" name="ic_number" value="{{ old('ic_number') }}" class="form-control">
            @error('ic_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group @error('ic_image') has-error @enderror">
            <label for="ic_image" class="form-control-label">Identity Image</label>
            <input type="file" name="ic_image" class="form-control-file">
            @error('ic_image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        {{-- Submit --}}
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
        </div>
    </form>
@endsection
