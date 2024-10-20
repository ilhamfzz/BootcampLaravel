<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('pages.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required | min:2 | max:255',
                'description' => 'required', // Description is required and have text data type
            ],
            [
                'name.required' => 'The name field is required',
                'name.min' => 'The name must be at least 2 characters',
                'name.max' => 'The name may not be greater than 255 characters',
                'description.required' => 'The description field is required',
            ]
        );

        DB::table('categories')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        // $category = DB::table('categories')->where('id', $id)->first();
        $category = Categories::find($id);
        return view('pages.categories.show', ['category' => $category]);
    }

    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('pages.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required | min:2 | max:255',
                'description' => 'required', // Description is required and have text data type
            ],
            [
                'name.required' => 'The name field is required',
                'name.min' => 'The name must be at least 2 characters',
                'name.max' => 'The name may not be greater than 255 characters',
                'description.required' => 'The description field is required',
            ]
        );

        DB::table('categories')->where('id', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->route('categories.index');
    }
}
