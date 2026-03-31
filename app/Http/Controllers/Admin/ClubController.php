<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ClubService;
use App\DTOs\ClubDTO;

class ClubController extends Controller
{
    public function __construct(protected ClubService $clubService)
    {
    }

    public function index()
    {
        $clubsData = $this->clubService->getAll();
        
        $clubs = array_map(function ($data) {
            return ClubDTO::fromArray($data);
        }, $clubsData);

        return view('admin.clubs', compact('clubs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        $result = $this->clubService->create($request->all());
        
        if (isset($result['error'])) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $result = $this->clubService->update($id, $request->only('name'));
        
        if (isset($result['error'])) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(string $id)
    {
        $result = $this->clubService->delete($id);
        
        if (isset($result['error'])) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }

        return response()->json(['success' => true]);
    }
}
