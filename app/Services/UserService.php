<?php

namespace App\Services;

use App\Http\Requests\Users\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (User::where('email', $data['email'])->exists()) {
            return back();
        } else {
            $user = User::create($data);

            if ($request->hasFile('avatar')) {
                $avatarPath = Storage::put('public/images', $data['avatar']);
                $user->avatar = $avatarPath;
                $user->save();
            }

            event(new Registered($user));

            return redirect()->route('login');
        }
    }

    public function updateName(string $name):void
    {
        $user = auth()->user();
        $user->name = $name;
        $user->save();
    }

    public function updateEmail(string $email):void
    {
        $user = auth()->user();
        $user->email = $email;
        $user->save();
    }

    public function updateAvatar(string $image): string
    {
        $user = auth()->user();
        $avatarPath = Storage::put('public/images', $image);
        $user->avatar = $avatarPath;
        $user->save();

        return asset('storage/'.$avatarPath);
    }

    public function delete(string $id):void
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
