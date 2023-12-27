<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
    public function showUploadForm () {
        return view('upload');
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('excel_file');
        $path = $file->getPathname();

        $spreadsheet = IOFactory::load($path);

        $sheet = $spreadsheet->getActiveSheet();

        $headers = [];

        foreach ($sheet->getRowIterator(1)->current()->getCellIterator() as $cell) {
            $headers[] = $cell->getValue();
        }

        $data = [];

        foreach ($sheet->getRowIterator(2) as $row) {
            $rowData = [];

            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }

            $rowKeyValue = array_combine($headers, array_map('strval', $rowData));

            $data[] = $rowKeyValue;
        }

        echo "<pre>";
        print_r($data);
    }
}
