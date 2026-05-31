<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function indexView()
    {
        $users = $this->service->getAll();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editView(int $id)
    {
        $user = $this->service->findById($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Display a listing of the resource as JSON.
     */
    public function index()
    {
        return response()->json($this->service->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->service->store($request->validated());
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = $this->service->findById($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->service->update($user, $request->validated());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->service->delete($user);
        return response()->json(null, 204);
    }
}
