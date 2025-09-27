<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramCategory;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('category')->get();
        return view('programs.index', compact('programs'));
    }

    public function create()
    {
        $categories = ProgramCategory::all();
        return view('programs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:512',
            'slug' => 'required|string|max:512|unique:programs,slug',
            'category_id' => 'nullable|exists:program_categories,id',
            'description' => 'nullable',
            'meta' => 'nullable',
        ]);

        Program::create($request->all());
        return redirect()->route('programs.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function show(Program $program)
    {
        $program->load('category');
        return view('programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        $categories = ProgramCategory::all();
        return view('programs.edit', compact('program', 'categories'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title' => 'required|string|max:512',
            'slug' => 'required|string|max:512|unique:programs,slug,' . $program->id,
            'category_id' => 'nullable|exists:program_categories,id',
            'description' => 'nullable',
            'meta' => 'nullable',
        ]);

        $program->update($request->all());
        return redirect()->route('programs.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program berhasil dihapus.');
    }
}
