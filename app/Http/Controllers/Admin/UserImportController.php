<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class UserImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.users.import.form');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls'
        ]);

        $rows = Excel::toArray([], $request->file('file'))[0];

        // buang header kalau ada
        if (isset($rows[0]) && str_contains(strtolower($rows[0][0]), 'name')) {
            array_shift($rows);
        }

        $validatedRows = [];
        foreach ($rows as $row) {
            $errors = [];

            // cek nama
            if (empty($row[0])) {
                $errors[] = 'Nama wajib diisi';
            }

            // cek email
            if (empty($row[1]) || !filter_var($row[1], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email tidak valid';
            } elseif (\App\Models\User::where('email', $row[1])->exists()) {
                $errors[] = 'Email sudah terdaftar';
            }

            // cek role
            $roleName = $row[2] ?? 'user';
            $role = \App\Models\Role::where('name', $roleName)->first();
            if (!$role) {
                $errors[] = "Role '{$roleName}' tidak ditemukan";
            }

            $validatedRows[] = [
                'data' => $row,
                'errors' => $errors
            ];
        }

        Session::put('import_users', $validatedRows);

        return redirect()->route('admin.users.import.form')->with('success', 'Preview data siap!');
    }

    public function removeRow($index)
    {
        $rows = Session::get('import_users', []);

        if (isset($rows[$index])) {
            unset($rows[$index]);
            $rows = array_values($rows); // reindex ulang
            Session::put('import_users', $rows);
        }

        return response()->json(['success' => true, 'rows' => $rows]);
    }

    public function commit()
    {
        $rows = Session::get('import_users', []);

        foreach ($rows as $row) {
            if (!empty($row['errors'])) {
                continue; // skip data yang error
            }

            $data = $row['data'];
            $role = \App\Models\Role::where('name', $data[2] ?? 'user')->first();

            User::create([
                'name' => $data[0] ?? null,
                'email' => $data[1] ?? null,
                'password' => bcrypt('password123'),
                'role_id' => $role->id ?? 2,
            ]);
        }

        Session::forget('import_users');

        return redirect()->route('admin.users.index')->with('success', 'Import berhasil!');
    }
}
