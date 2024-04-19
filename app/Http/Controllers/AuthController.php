<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Login user
     */
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ]);

        $rememberMe = $request->input('remember_me');

        if (auth()->attempt($data, $rememberMe)) {
            $user = Auth::user();

            return redirect()->route('user.show', $user->id);
        } else {
            return back();
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::factory()->make();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function createUser()
    {
        $user = User::factory()->create();

        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
