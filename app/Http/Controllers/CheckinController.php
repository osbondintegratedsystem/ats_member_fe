<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CheckinService;

class CheckinController extends Controller
{
    public function __construct(protected CheckinService $checkinService)
    {
    }

    public function index()
    {
        return view('checkin');
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'member_id' => 'required|string',
        ]);

        $result = $this->checkinService->checkIn($request->member_id);

        if (isset($result['error'])) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }

        return response()->json(['success' => true, 'data' => $result]);
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'member_id' => 'required|string',
        ]);

        $result = $this->checkinService->checkOut($request->member_id);

        if (isset($result['error'])) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }

        return response()->json(['success' => true, 'data' => $result]);
    }
}
