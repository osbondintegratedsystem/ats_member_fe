<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CheckinService;
use App\DTOs\CheckinDTO;

class CheckinController extends Controller
{
    public function __construct(protected CheckinService $checkinService)
    {
    }

    public function index(Request $request)
    {
        $startDate = $request->input('date_start', now()->format('Y-m-d'));
        $endDate = $request->input('date_end', now()->format('Y-m-d'));

        $apiStartDate = str_replace('-', '', $startDate);
        $apiEndDate = str_replace('-', '', $endDate);

        $recapsData = $this->checkinService->list($apiStartDate, $apiEndDate);

        $recaps = array_map(function ($data) {
            return CheckinDTO::fromArray($data);
        }, $recapsData);

        return view('checkin', compact('recaps', 'startDate', 'endDate'));
    }
    //! CHECKIN
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



    //! CHECKOUT
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
