<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrows;
use App\Models\Borrowers;
use App\Models\Books;

class BorrowsController extends Controller
{
    public function index()
    {
        $borrows = Borrows::all();
        return view('pages.borrows.index', compact('borrows'));
    }

    public function create()
    {
        $borrowers = Borrowers::all();
        $books = Books::all();
        return view('pages.borrows.create', compact('borrowers', 'books'));
    }

    public function show($id)
    {
        $borrow = Borrows::find($id);
        return view('pages.borrows.show', compact('borrow'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'book_id' => 'required | exists:books,id',
                'borrow_date' => 'required | date',
                'return_date' => 'required | date',
                'borrowers_id' => 'required | exists:borrowers,id',
            ],
            [
                'book_id.required' => 'The book field is required',
                'book_id.exists' => 'The selected book is invalid',
                'borrow_date.required' => 'The borrow date field is required',
                'borrow_date.date' => 'The borrow date must be a date',
                'return_date.required' => 'The return date field is required',
                'return_date.date' => 'The return date must be a date',
                'borrowers_id.required' => 'The borrower field is required',
                'borrowers_id.exists' => 'The selected borrower is invalid',
            ]
        );

        $borrow = new Borrows;
        $borrow->book_id = $request->input('book_id');
        $borrow->borrow_date = $request->input('borrow_date');
        $borrow->return_date = $request->input('return_date');
        $borrow->borrowers_id = $request->input('borrowers_id');
        $borrow->save();

        $book = Books::find($request->input('book_id'));
        $book->stock = $book->stock - 1;
        $book->save();

        return redirect()->route('borrows.index')->with('success', 'Borrow data has been added');
    }

    public function edit($id)
    {
        $borrow = Borrows::find($id);
        return view('pages.borrows.edit', compact('borrow'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'book_id' => 'required | exists:books,id',
                'borrow_date' => 'required | date',
                'return_date' => 'required | date',
                'borrowers_id' => 'required | exists:borrowers,id',
            ],
            [
                'book_id.required' => 'The book field is required',
                'book_id.exists' => 'The selected book is invalid',
                'borrow_date.required' => 'The borrow date field is required',
                'borrow_date.date' => 'The borrow date must be a date',
                'return_date.required' => 'The return date field is required',
                'return_date.date' => 'The return date must be a date',
                'borrowers_id.required' => 'The borrower field is required',
                'borrowers_id.exists' => 'The selected borrower is invalid',
            ]
        );

        $borrow = Borrows::find($id);
        if ($borrow->book_id != $request->input('book_id')) {
            $book = Books::find($borrow->book_id);
            $book->stock = $book->stock + 1;
            $book->save();

            $book = Books::find($request->input('book_id'));
            $book->stock = $book->stock - 1;
            $book->save();
        }

        $borrow->book_id = $request->input('book_id');
        $borrow->borrow_date = $request->input('borrow_date');
        $borrow->return_date = $request->input('return_date');
        $borrow->borrowers_id = $request->input('borrowers_id');
        $borrow->save();

        return redirect()->route('borrows.index')->with('success', 'Borrow data has been updated');
    }

    public function destroy($id)
    {
        $borrow = Borrows::find($id);
        $borrow->delete();
        return redirect()->route('borrows.index')->with('success', 'Borrow data has been deleted');
    }

    public function return($id)
    {
        $borrow = Borrows::find($id);
        $book = Books::find($borrow->book_id);
        $book->stock = $book->stock + 1;
        $book->save();
        $borrow->status = 'returned';
        $borrow->save();

        // $borrow->delete();
        return redirect()->route('borrows.index')->with('success', 'Book has been returned');
    }
}
