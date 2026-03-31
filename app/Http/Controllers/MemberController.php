<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use App\DTOs\MemberDTO;

class MemberController extends Controller
{
    public function __construct(protected MemberService $memberService)
    {
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $membersData = $this->memberService->getAll($search);

        $members = array_map(function ($data) {
            return MemberDTO::fromArray($data);
        }, $membersData);

        return view('members.index', compact('members', 'search'));
    }

    public function show(string $id)
    {
        $data = $this->memberService->getById($id);

        if (!$data) {
            return response()->json(['error' => true, 'message' => 'Member not found'], 404);
        }

        return response()->json(MemberDTO::fromArray($data));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'package' => 'required',
            'expiration_date' => 'required',
            'phone' => 'required',
        ]);

        $result = $this->memberService->create($request->all());

        if (isset($result['error'])) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }

        return response()->json(['success' => true]);
    }
}
