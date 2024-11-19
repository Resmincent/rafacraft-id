<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', "%{$searchTerm}%");
        }

        $categories = $query->paginate(10);


        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->only(['name']);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('categories_covers', 'public');
            $data['cover'] = $coverPath;
        }

        $data['slug'] = Str::slug($data['name']);
        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('categories_covers', 'public');
            if ($category->cover) {
                Storage::disk('public')->delete($category->cover);
            }
            $data['cover'] = $coverPath;
        }

        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $category = Category::findOrFail($id);
        if ($category->cover) {
            Storage::disk('public')->delete($category->cover);
        }
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
