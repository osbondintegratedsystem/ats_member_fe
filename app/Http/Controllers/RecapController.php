<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CheckinService;
use App\DTOs\CheckinDTO;

class RecapController extends Controller
{
    public function __construct(protected CheckinService $checkinService)
    {
    }

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $recapsData = $this->checkinService->recap($startDate, $endDate);

        $recaps = array_map(function ($data) {
            return CheckinDTO::fromArray($data);
        }, $recapsData);

        return view('recap.index', compact('recaps', 'startDate', 'endDate'));
    }
}
