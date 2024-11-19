<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBouquetRequest;
use App\Models\Bouquet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BouquetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bouquet::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', "%{$searchTerm}%");
        }

        $bouquets = $query->paginate(10);

        return view('admin.bouquet.index', compact('bouquets'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBouquetRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        Bouquet::create($data);

        return redirect()->route('bouqeuts.index')->with('success', 'Bouquet created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $bouquets = Bouquet::findOrFail($id);

        $data['slug'] = Str::slug($data['name']);

        $bouquets->update($data);

        return redirect()->route('bouqeuts.index')->with('success', 'Bouquet updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $bouquet = Bouquet::findOrFail($id);
        $bouquet->delete();

        return redirect()->route('bouqeuts.index')->with('success', 'Bouquet deleted successfully');
    }
}
