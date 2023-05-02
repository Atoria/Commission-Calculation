<?php

namespace App\Http\Controllers;

use App\Services\CommissionService;
use App\Services\CsvParserService;
use App\Services\RatesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommissionController extends Controller
{

    private readonly CsvParserService $csvParser;
    private readonly CommissionService $commissionService;
    private readonly RatesService $ratesService;

    public function __construct(CsvParserService  $csvParser,
                                CommissionService $commissionService,
                                RatesService      $ratesService)
    {
        $this->csvParser = $csvParser;
        $this->commissionService = $commissionService;
        $this->ratesService = $ratesService;
    }

    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|file',
        ]);
        $file = $request->file('file');

        /*
         *  Fetch rates initially on request.
         *  Better practice would be to have cron-job which will update rates in our DB or will cache it.
        */
        $ratesResult = $this->ratesService->getRates();
        if ($ratesResult->getCode() !== 200) {
            return response()->json($ratesResult->toArray(), $ratesResult->getCode());
        }

        $csvResponse = $this->csvParser->parseCsv($file);

        if ($csvResponse->getCode() !== 200) {
            return response()->json($ratesResult->toArray(), $ratesResult->getCode());
        }

        $result = $this->commissionService->calculate($csvResponse->getData());
        return response()->json($result->toArray(), $result->getCode());

    }
}
