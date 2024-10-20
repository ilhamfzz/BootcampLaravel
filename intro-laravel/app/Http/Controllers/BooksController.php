<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Books;
use Faker\Core\File;

class BooksController extends Controller
{
    // display listing of the resource
    public function index()
    {
        $books = Books::all();
        return view('pages.books.index', compact('books'));
        // compact() to send data to view it equal to ['books' => $books]
    }

    public function create()
    {
        $categories = Categories::all();
        return view('pages.books.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required | min:2 | max:255',
                'summary' => 'required | min:2',
                'image' => 'nullable | image | mimes:jpeg,png,jpg | max:2048', // max 2MB
                'stock' => 'required | integer',
                'category_id' => 'required | exists:categories,id',
            ],
            [
                'title.required' => 'The title field is required',
                'title.min' => 'The title must be at least 2 characters',
                'title.max' => 'The title may not be greater than 255 characters',
                'summary.required' => 'The summary field is required',
                'summary.min' => 'The summary must be at least 2 characters',
                'image.image' => 'The file must be an image',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg',
                'image.max' => 'The image may not be greater than 2MB',
                'stock.required' => 'The stock field is required',
                'stock.integer' => 'The stock must be an integer',
                'category_id.required' => 'The category field is required',
                'category_id.exists' => 'The selected category is invalid',
            ]
        );

        $image = $request->file('image');
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/books/'), $fileName);

        $book = new Books;
        $book->title = $request->input('title');
        $book->summary = $request->input('summary');
        $book->image = $fileName;
        $book->stock = $request->input('stock');
        $book->category_id = $request->input('category_id');
        $book->save();

        return redirect()->route('books.index');
    }

    public function show($id)
    {
        $book = Books::where('id', $id)->first();
        return view('pages.books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Books::where('id', $id)->first();
        $categories = Categories::all();
        return view('pages.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required | min:2 | max:255',
                'summary' => 'required | min:2',
                'image' => 'nullable | image | mimes:jpeg,png,jpg | max:2048', // max 2MB
                'stock' => 'required | integer',
                'category_id' => 'required',
            ],
            [
                'title.required' => 'The title field is required',
                'title.min' => 'The title must be at least 2 characters',
                'title.max' => 'The title may not be greater than 255 characters',
                'summary.required' => 'The summary field is required',
                'summary.min' => 'The summary must be at least 2 characters',
                'image.image' => 'The file must be an image',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg',
                'image.max' => 'The image may not be greater than 2MB',
                'stock.required' => 'The stock field is required',
                'stock.integer' => 'The stock must be an integer',
                'category_id.required' => 'The category field is required',
            ]
        );

        $book = Books::where('id', $id)->first();

        if ($request->hasFile('image')) {
            // delete old image
            $oldImage = public_path('uploads/books/' . $book->image);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/books/'), $fileName);
        } else {
            $fileName = $book->image;
        }

        $book->title = $request->input('title');
        $book->summary = $request->input('summary');
        $book->image = $fileName;
        $book->stock = $request->input('stock');
        $book->category_id = $request->input('category_id');
        $book->save();

        return redirect()->route('books.index');
    }

    public function destroy($id)
    {
        $book = Books::where('id', $id)->first();
        $book->delete();
        return redirect()->route('books.index');
    }
}
