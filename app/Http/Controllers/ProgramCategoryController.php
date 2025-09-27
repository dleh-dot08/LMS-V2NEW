<?php

namespace App\Http\Controllers;

use App\Models\ProgramCategory;
use Illuminate\Http\Request;

class ProgramCategoryController extends Controller
{
    public function index()
    {
        $categories = ProgramCategory::all();
        return view('program_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('program_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:program_categories,name',
            'description' => 'nullable',
            'meta' => 'nullable',
        ]);

        ProgramCategory::create($request->all());
        return redirect()->route('program_categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(ProgramCategory $programCategory)
    {
        return view('program_categories.show', ['category' => $programCategory]);
    }

    public function edit(ProgramCategory $programCategory)
    {
        return view('program_categories.edit', ['category' => $programCategory]);
    }

    public function update(Request $request, ProgramCategory $programCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:program_categories,name,' . $programCategory->id,
            'description' => 'nullable',
            'meta' => 'nullable',
        ]);

        $programCategory->update($request->all());
        return redirect()->route('program_categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ProgramCategory $programCategory)
    {
        $programCategory->delete();
        return redirect()->route('program_categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
