<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SampleDataImport;

class ImportController extends Controller
{

    public function importView()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        // $file = $request->file('excel_file');
        // Excel::import(new SampleDataImport, $file);
        Excel::import(new SampleDataImport, request()->file('excel_file'));
    }
}