<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\DTOs\UserDTO;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function index()
    {
        $usersData = $this->userService->getAll();
        
        $users = array_map(function ($data) {
            return UserDTO::fromArray($data);
        }, $usersData);

        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'role' => 'required',
            'status' => 'required',
        ]);

        $result = $this->userService->create($request->all());
        
        if (isset($result['error'])) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'status' => 'required',
        ]);

        $result = $this->userService->update($id, $request->except('id'));
        
        if (isset($result['error'])) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(string $id)
    {
        $result = $this->userService->delete($id);
        
        if (isset($result['error'])) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }

        return response()->json(['success' => true]);
    }
}
