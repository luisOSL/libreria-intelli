<?php
namespace App\Exports\Sheets;

use App\Author;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AuthorsSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection() { 
        return Author::all(['id', 'name', 'books_count']); 
    }

    public function title(): string { return 'Autores'; }

    public function headings(): array { 
        return ['ID', 'Nombre del Autor', 'Total de Libros']; 
    }

    public function styles(Worksheet $sheet)
    {
        // Obtener el número de filas con datos
        $lastRow = $sheet->getHighestRow();
        $lastColumn = 'C'; // ID, Nombre, Cantidad

        return [
            // Estilo para la fila de encabezados (Fila 1)
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4A90E2']
                ],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ],
            // Aplicar bordes a toda la tabla de datos
            "A1:{$lastColumn}{$lastRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
        ];
    }
}