<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\AuthorsSheet;
use App\Exports\Sheets\BooksSheet;

class LibraryExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new AuthorsSheet(),
            new BooksSheet(),
        ];
    }
}
