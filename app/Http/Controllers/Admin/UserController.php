<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * index: list + search + filter by role + pagination
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        $role = $request->query('role');
        $status = $request->query('status'); // aktif / nonaktif
        $perPage = intval($request->query('per_page', 15));

        $users = User::query()
            ->with('role')
            ->when($q, function ($qb, $q) {
                $qb->where(function($q2) use ($q) {
                    $q2->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
                });
            })
            ->when($role, function ($qb, $role) {
                if (is_numeric($role)) {
                    $qb->where('role_id', intval($role));
                } else {
                    $qb->whereHas('role', fn($r) => $r->where('name', $role));
                }
            })
            ->when($status !== null && $status !== '', function ($qb) use ($status) {
                $qb->where('is_active', $status === 'active' ? 1 : 0);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact('users','roles','q','role','status'));
    }


    /**
     * show create form
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * store new user
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        // handle files (avatar/idcard) -> store and create files record if you use files table
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar_file_id'] = $this->createFileRecord($path, $request->user()->id ?? null);
        }

        if ($request->hasFile('idcard')) {
            $path = $request->file('idcard')->store('idcards', 'public');
            $data['idcard_file_id'] = $this->createFileRecord($path, $request->user()->id ?? null);
        }

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return redirect()->route('admin.users.index')->with('success', "User {$user->name} berhasil dibuat.");
    }

    /**
     * show edit form
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * update user
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar_file_id'] = $this->createFileRecord($path, $request->user()->id ?? null);
        }

        if ($request->hasFile('idcard')) {
            $path = $request->file('idcard')->store('idcards', 'public');
            $data['idcard_file_id'] = $this->createFileRecord($path, $request->user()->id ?? null);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', "User {$user->name} berhasil diupdate.");
    }

    /**
     * destroy (delete)
     */
    public function destroy(User $user)
    {
        // optional: soft delete vs hard delete. Here we do hard delete.
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', "User dihapus.");
    }

    /**
     * Toggle is_active (status toggle)
     */
    public function toggleActive(Request $request, User $user)
    {
        $this->authorizeForUser($request->user(), 'update', $user); // optional policy

        $user->is_active = $user->is_active ? 0 : 1;
        $user->save();

        if ($request->wantsJson()) {
            return response()->json(['ok' => true, 'is_active' => (int)$user->is_active]);
        }

        return redirect()->back()->with('success', "Status user {$user->name} diperbarui.");
    }

    /**
     * Helper to create files record (basic) — adjust to your files table/service.
     */
    protected function createFileRecord(string $storagePath, $uploadedBy = null)
    {
        // if you have Files model
        if (class_exists(\App\Models\File::class)) {
            $file = \App\Models\File::create([
                'filename' => basename($storagePath),
                'storage_path' => $storagePath,
                'mime' => Storage::disk('public')->mimeType($storagePath) ?? null,
                'size' => Storage::disk('public')->size($storagePath) ?? null,
                'uploaded_by' => $uploadedBy,
            ]);
            return $file->id;
        }

        // fallback: return null
        return null;
    }

    public function show($id)
    {
        $user = User::with('role')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
}
