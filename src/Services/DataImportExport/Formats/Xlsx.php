<?php

namespace Exceedone\Exment\Services\DataImportExport\Formats;

use PhpOffice\PhpSpreadsheet\IOFactory;

class Xlsx extends FormatBase
{
    protected $accept_extension = 'xlsx';

    public function getFileName()
    {
        return $this->filebasename.date('YmdHis'). ".xlsx";
    }

    public function createResponse($files)
    {
        return response()->stream(function () use ($files) {
            $files[0]['writer']->save('php://output');
        }, 200, $this->getDefaultHeaders());
    }

    protected function getDefaultHeaders()
    {
        $filename = $this->getFileName();
        return [
            'Content-Type'        => 'application/force-download',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
    }

    /**
     * get data table list. contains self table, and relations (if contains)
     */
    public function getDataTable($request)
    {
        // get file
        if (is_string($request)) {
            $path = $request;
        } else {
            $file = $request->file('custom_table_file');
            $path = $file->getRealPath();
        }
        
        $reader = $this->createReader();
        $spreadsheet = $reader->load($path);

        $datalist = [];
        // get all data
        foreach ($spreadsheet->getSheetNames() as $sheetName) {
            $sheet = $spreadsheet->getSheetByName($sheetName);
            $datalist[$sheetName] = getDataFromSheet($sheet, 0, false, true);
        }

        return $datalist;
    }
    /**
     * whether this out is as zip.
     * This table is parent and contains relation 1:n or n:n.
     */
    protected function isOutputAsZip()
    {
        return false;
    }
    
    protected function createWriter($spreadsheet)
    {
        return IOFactory::createWriter($spreadsheet, 'Xlsx');
    }
    
    protected function createReader()
    {
        return IOFactory::createReader('Xlsx');
    }
}
