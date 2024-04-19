<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $user = auth()->user();
        $users = User::all();

        return view('user.admin.users', compact('users', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
        ]);

        if (User::where('email', $request->input('email'))->exists()) {
            return back();
        } else {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            if ($request->hasFile('avatar')) {
                $avatarPath = Storage::put('public/images', $request->avatar);
                $user->avatar = $avatarPath;
                $user->save();
            }

            event(new Registered($user));

            return redirect()->route('login');
        }
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $id)
    {
        return redirect()->route('user.show.data', $id);
    }

    public function showData(string $id)
    {
        $user = User::findOrFail($id);

        return view('user.data', ['user'=>$user]);
    }

    public function showReviews(string $id)
    {
        $user = User::findOrFail($id);
        $reviews = Review::where('user_id', $id)->get();

        return view('user.reviews', ['user'=>$user, 'reviews'=>$reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    public function updateName(Request $request){
        $request->validate([
            'name'=>['required', 'string'],
        ]);

        $user = auth()->user();
        $name = $request->input('name');
        $user->name = $name;
        $user->save();

        return response()->json(['name'=>$name]);
    }

    public function updateEmail(Request $request){
        $request->validate([
            'email'=>['required', 'email','string', 'unique:users,email'],
        ]);

        $user = auth()->user();
        $email = $request->input('email');
        $user->email = $email;
        $user->save();

        return response()->json(['email'=>$email]);
    }

    public function updateAvatar(Request $request){
        $request->validate([
            'avatar'=>['required', 'image',],
        ]);

        $user = auth()->user();
        $avatarPath = Storage::put('public/images', $request->avatar);
        $user->avatar = $avatarPath;
        $user->save();

        $avatarURL = asset('storage/'.$avatarPath);

        return response()->json(['avatar'=>$avatarURL]);
    }

    public function updatePassword(Request $request){
        $request->validate([
            'password'=>['required', 'current_password'],
            'password_new'=>['required', 'min:8'],
        ]);
        $user = auth()->user();
        $password = $request->input('password_new');
        $password = Hash::make($password);
        $user->password = $password;
        $user->save();

        return response()->json(['password'=>$password]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back();
    }

    public function dashboard(string $id)
    {
//        return 123;
    }

    public function showAdminPanel(string $id)
    {
        return redirect()->route('user.show.admin.users', $id);
    }
}
