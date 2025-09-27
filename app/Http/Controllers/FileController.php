<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('files.index', compact('files'));
    }

    public function create()
    {
        return view('files.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required|string|max:1024',
            'storage_path' => 'required|string|max:2048',
            'mime' => 'nullable|string|max:255',
            'size' => 'nullable|numeric',
            'uploaded_by' => 'nullable|exists:users,id',
            'meta' => 'nullable',
        ]);

        File::create($request->all());
        return redirect()->route('files.index')->with('success', 'File berhasil ditambahkan.');
    }

    public function show(File $file)
    {
        return view('files.show', compact('file'));
    }

    public function edit(File $file)
    {
        return view('files.edit', compact('file'));
    }

    public function update(Request $request, File $file)
    {
        $request->validate([
            'filename' => 'required|string|max:1024',
            'storage_path' => 'required|string|max:2048',
            'mime' => 'nullable|string|max:255',
            'size' => 'nullable|numeric',
            'uploaded_by' => 'nullable|exists:users,id',
            'meta' => 'nullable',
        ]);

        $file->update($request->all());
        return redirect()->route('files.index')->with('success', 'File berhasil diperbarui.');
    }

    public function destroy(File $file)
    {
        $file->delete();
        return redirect()->route('files.index')->with('success', 'File berhasil dihapus.');
    }
}
