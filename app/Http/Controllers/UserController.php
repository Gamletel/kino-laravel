<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateAvatarUserRequest;
use App\Http\Requests\Users\UpdateEmailUserRequest;
use App\Http\Requests\Users\UpdateNameUserRequest;
use App\Models\Review;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(int $id = null): View
    {
        if ($id == null) {
            $user = auth()->user();
        }else{
            $user = User::find($id);
        }

        $users = User::all();

        return view('user.admin.users', compact( 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(): View
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        return $this->userService->store($request);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $id): RedirectResponse
    {
        return redirect()->route('users.show.data', $id);
    }

    public function showData(string $id): View
    {
        $user = User::findOrFail($id);

        return view('user.data', ['user' => $user]);
    }

    public function showReviews(string $id): View
    {
        $user = User::findOrFail($id);
        $reviews = Review::where('user_id', $id)->get();

        return view('user.reviews', ['user' => $user, 'reviews' => $reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    public function updateName(UpdateNameUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->userService->updateName($data->name);

        return response()->json(['name' => $data->name]);
    }

    public function updateEmail(UpdateEmailUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->userService->updateEmail($data->email);

        return response()->json(['email' => $data->email]);
    }

    public function updateAvatar(UpdateAvatarUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $avatarURL = $this->userService->updateAvatar($data->avatar);

        return response()->json(['avatar' => $avatarURL]);
    }

    public function updatePassword(Request $request): JsonResponse
    {

        $request->validate([
            'password' => ['required', 'current_password'],
            'password_new' => ['required', 'min:8'],
        ]);
        $user = auth()->user();
        $password = $request->input('password_new');
        $password = Hash::make($password);
        $user->password = $password;
        $user->save();

        return response()->json(['password' => $password]);
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
    public function destroy(string $id): RedirectResponse
    {
        $this->userService->delete($id);

        return back();
    }

    public function dashboard(string $id)
    {
        //TODO я не помню что тут должно быть
    }

    public function showAdminPanel(string $id)
    {
        return redirect()->route('users.show.admin.users', $id);
    }
}
