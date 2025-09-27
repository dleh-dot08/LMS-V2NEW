<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Tampilkan daftar sumber daya (resource).
     */
    public function index()
    {
        // Sesuaikan tampilan jika ini bukan tampilan admin
        return view('roles.index'); 
        // Atau jika Anda memang tidak menggunakannya lagi, Anda bisa menghapus file ini.
    }

    // ... metode-metode lain yang mungkin ada (create, store, edit, dsb.)
}
