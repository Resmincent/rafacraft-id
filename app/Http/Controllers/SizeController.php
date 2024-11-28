<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSizeRequest;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Size::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('size', 'like', "%{$searchTerm}%");
        }

        $sizes = $query->paginate(10);

        return view('admin.size.index', compact('sizes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizeRequest $request)
    {
        $data = $request->all();
        Size::create($data);

        return redirect()->route('sizes.index')->with('success', 'Bouquet created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $data = $request->validate([
            'size' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        $bouquets = Size::findOrFail($id);

        $data['slug'] = Str::slug($data['name']);

        $bouquets->update($data);

        return redirect()->route('sizes.index')->with('success', 'Bouquet updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $bouquet = Size::findOrFail($id);
        $bouquet->delete();

        return redirect()->route('sizes.index')->with('success', 'Bouquet deleted successfully');
    }
}
