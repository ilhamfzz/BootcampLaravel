<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowers;
use App\Models\Borrows;

class BorrowersController extends Controller
{
    public function index()
    {
        $borrowers = Borrowers::all();
        return view('pages.borrowers.index', compact('borrowers'));
    }

    public function create()
    {
        return view('pages.borrowers.create');
    }

    public function show($id)
    {
        $borrower = Borrowers::find($id);
        $borrows = Borrows::where('borrowers_id', $id)->get();
        return view('pages.borrowers.show', compact('borrower', 'borrows'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'full_name' => 'required',
                'email' => 'required | email',
                'phone_number' => 'required',
                'address' => 'required',
                'ic_number' => 'required|unique:borrowers,ic_number|min:16|max:16',
                'ic_image' => 'required | image | mimes:jpeg,png,jpg | max:2048',
            ],
            [
                'full_name.required' => 'The full name field is required',
                'email.required' => 'The email field is required',
                'email.email' => 'The email must be a valid email address',
                'phone_number.required' => 'The phone number field is required',
                'address.required' => 'The address field is required',
                'ic_number.required' => 'The IC number field is required',
                'ic_number.unique' => 'The IC number has already been taken',
                'ic_number.min' => 'The IC number must be at least 16 characters',
                'ic_number.max' => 'The IC number may not be greater than 16 characters',
                'ic_image.required' => 'The IC image field is required',
                'ic_image.image' => 'The IC image must be an image',
                'ic_image.mimes' => 'The IC image must be a file of type: jpeg, png, jpg',
                'ic_image.max' => 'The IC image must be a file with a maximum size of 2 MB',
            ]
        );

        $ic_image = $request->file('ic_image');
        $fileName = time() . '.' . $ic_image->getClientOriginalExtension();
        $ic_image->move(public_path('uploads/ic/'), $fileName);

        $borrower = new Borrowers;
        $borrower->full_name = $request->input('full_name');
        $borrower->email = $request->input('email');
        $borrower->phone_number = $request->input('phone_number');
        $borrower->address = $request->input('address');
        $borrower->ic_number = $request->input('ic_number');
        $borrower->ic_image = $fileName;
        $borrower->save();

        return redirect()->route('borrowers.index')->with('success', 'Borrower data has been added');
    }

    public function edit($id)
    {
        $borrower = Borrowers::find($id);
        return view('pages.borrowers.edit', compact('borrower'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'full_name' => 'required',
                'email' => 'required | email',
                'phone_number' => 'required',
                'address' => 'required',
                'ic_number' => 'required|unique:borrowers,ic_number,' . $id . '|min:16|max:16',
                'ic_image' => 'image | mimes:jpeg,png,jpg | max:2048',
            ],
            [
                'full_name.required' => 'The full name field is required',
                'email.required' => 'The email field is required',
                'email.email' => 'The email must be a valid email address',
                'phone_number.required' => 'The phone number field is required',
                'address.required' => 'The address field is required',
                'ic_number.required' => 'The IC number field is required',
                'ic_number.unique' => 'The IC number has already been taken',
                'ic_number.min' => 'The IC number must be at least 16 characters',
                'ic_number.max' => 'The IC number may not be greater than 16 characters',
                'ic_image.image' => 'The IC image must be an image',
                'ic_image.mimes' => 'The IC image must be a file of type: jpeg, png, jpg',
                'ic_image.max' => 'The IC image must be a file with a maximum size of 2048 kilobytes',
            ]
        );

        $borrower = Borrowers::find($id);
        $borrower->full_name = $request->input('full_name');
        $borrower->email = $request->input('email');
        $borrower->phone_number = $request->input('phone_number');
        $borrower->address = $request->input('address');
        $borrower->ic_number = $request->input('ic_number');

        if ($request->hasFile('ic_image')) {
            $ic_image = $request->file('ic_image');
            $fileName = time() . '.' . $ic_image->getClientOriginalExtension();
            $ic_image->move(public_path('uploads/ic/'), $fileName);
            $borrower->ic_image = $fileName;
        }

        $borrower->save();

        return redirect()->route('borrowers.index')->with('success', 'Borrower data has been updated');
    }

    public function destroy($id)
    {
        $borrower = Borrowers::find($id);
        $borrower->delete();
        return redirect()->route('borrowers.index')->with('success', 'Borrower data has been deleted');
    }
}
