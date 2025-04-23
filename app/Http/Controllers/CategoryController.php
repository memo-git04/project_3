<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.modules.category.index_category', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //get the data from the form and save it to the database
        Category::create([
            'category_name' => $request->category_name,//' ' => name column in the database,
            // $request->category_name is the name of the input field in the form
        ]);
        return Redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.modules.category.edit_category', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //update the category
        $category->update([
            'category_name' => $request->update_category,
        ]);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Redirect::route('categories.index');
    }
}
