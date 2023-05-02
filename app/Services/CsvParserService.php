<?php

namespace App\Services;

use App\Http\Transformers\Response\ApiResponse;
use App\Http\Transformers\Response\ErrorResponse;
use App\Http\Transformers\Response\SuccessResponse;
use App\Models\Transaction;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CsvParserService
{

    /**
     * @param $file
     * @return Transaction[]
     */
    public function parseCsv($file): ApiResponse
    {
        try {

            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();

            $result = [];
            //Parse CSV file and create Transactions list
            foreach ($worksheet->toArray() as $row) {
                $result[] = new Transaction(
                    $row[0],
                    $row[1],
                    $row[2],
                    $row[3],
                    $row[4],
                    $row[5],
                );
            }

            return new SuccessResponse(200, $result);
        } catch (\Exception $e) {
            return new ErrorResponse(500, $e->getMessage());
        }

    }
}
