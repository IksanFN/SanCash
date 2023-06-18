<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\Store;
use App\Http\Requests\Admin\User\Update;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);
        $nomor = 1;
        return view('admin.user.index', compact('users', 'nomor'));
    }

    public function store(Store $request)
    { 
        // Hidden Token
        $request->except('_token');

        // Get name file & hash name
        if ($request->file('avatar')) {
            $image = $request->file('avatar');
            $image->storeAs('public/avatar', $image->hashName());
            $image = $image->hashName();
        } else {
            $image = NULL;
        }

        // Insert to database
        $user = User::create([
            'name' => $request->name,
            'nisn' => $request->nisn,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'avatar' => $image,
        ]);

        // Check condition
        if ($user) {
            // Success
            session()->flash('success', 'Data user berhasil disimpan!');
            return back();
        } else {
            // Failed
            session()->flash('error', 'Data user gagal disimpan!');
            return back();
        }
    }

    public function edit(User $user)
    {
        $user = User::whereId($user->id)->first();
        return view('admin.user.edit', compact('user'));
    }

    public function update(Update $request, User $user)
    {
        $request->except('_token');
        // Get User By ID
        $user = User::find($user->id);

        // Check if avatar uploaded
        if ($request->hasFile('avatar')) {
            
            // Upload new image
            $image = $request->file('avatar');
            $image->storeAs('public/avatar', $image->hashName());

            // Delete old image
            Storage::delete('public/avatar/'.$user->avatar);

            // Update user with new avatar
            $updateUserWithImage = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nisn' => $request->nisn,
                'avatar' => $image->hashName(),
                'role' => $request->role,
            ]);

            if ($updateUserWithImage) {
                session()->flash('success', 'Data user berhasil di update');
            } else {
                session()->flash('error', 'Data user gagal di update');
            }
        } else {
            $updateUserWithoutImage = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nisn' => $request->nisn,
                'role' => $request->role,
            ]);

            if ($updateUserWithoutImage) {
                session()->flash('success', 'Data user berhasil di update');
            } else {
                session()->flash('error', 'Data user gagal di update');
            }
        }

        return redirect()->route('admin.user.index');
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            session()->flash('success', 'Data berhasil di hapus');
        } else {
            session()->flash('error', 'Data gagal di hapus');
        }

        return redirect()->route('admin.user.index');
    }
}
