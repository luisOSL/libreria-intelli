<?php

namespace App\Http\Controllers;

use App\Exports\LibraryExport;
use Maatwebsite\Excel\Facades\Excel;

class LibraryController extends Controller
{
    //
    public function export()
    {
        return Excel::download(new LibraryExport, 'Reporte-Autor-Libros.xlsx');
    }
}
