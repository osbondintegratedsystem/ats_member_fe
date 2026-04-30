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

        $apiStartDate = $startDate ? str_replace('-', '', $startDate) : null;
        $apiEndDate = $endDate ? str_replace('-', '', $endDate) : null;

        $recapsData = $this->checkinService->list($apiStartDate, $apiEndDate);

        $recaps = array_map(function ($data) {
            return CheckinDTO::fromArray($data);
        }, $recapsData);

        return view('recap.index', compact('recaps', 'startDate', 'endDate'));
    }
}
