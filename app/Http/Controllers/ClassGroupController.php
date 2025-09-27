<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\School;
use Illuminate\Http\Request;

class ClassGroupController extends Controller
{
    public function index()
    {
        $classGroups = ClassGroup::with('school')->get();
        return view('class-groups.index', compact('classGroups'));
    }

    public function create()
    {
        $schools = School::all();
        return view('class-groups.create', compact('schools'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'name' => 'required|string|max:255',
            'grade_label' => 'nullable|string|max:100',
            'academic_year' => 'required|integer',
            'capacity' => 'nullable|integer',
            'meta' => 'nullable',
        ]);

        ClassGroup::create($request->all());
        return redirect()->route('class-groups.index')->with('success', 'Class Group berhasil ditambahkan.');
    }

    public function show(ClassGroup $classGroup)
    {
        $classGroup->load('school');
        return view('class-groups.show', compact('classGroup'));
    }

    public function edit(ClassGroup $classGroup)
    {
        $schools = School::all();
        return view('class-groups.edit', compact('classGroup', 'schools'));
    }

    public function update(Request $request, ClassGroup $classGroup)
    {
        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'name' => 'required|string|max:255',
            'grade_label' => 'nullable|string|max:100',
            'academic_year' => 'required|integer',
            'capacity' => 'nullable|integer',
            'meta' => 'nullable',
        ]);

        $classGroup->update($request->all());
        return redirect()->route('class-groups.index')->with('success', 'Class Group berhasil diperbarui.');
    }

    public function destroy(ClassGroup $classGroup)
    {
        $classGroup->delete();
        return redirect()->route('class-groups.index')->with('success', 'Class Group berhasil dihapus.');
    }
}
