<?php

namespace App\Exports;

use App\Models\Models;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\AutoSize;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ModelsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query =  DB::table('Models')
            ->leftJoin('Tags', 'Tags.model_id', '=', 'Models.id')
            ->leftJoin('forms', 'Tags.form_id', '=', 'forms.id')
            ->groupBy('models.id', 'Models.model_name')
            ->select('models.id AS model_id', 'Models.model_name', DB::raw("IFNULL(GROUP_CONCAT(forms.form_name SEPARATOR ', '), '') AS checksheet_appearance"))
            ->get();



        // ->join('employees', 'users.employee_id', '=', 'employees.id')
        // ->join('roles', 'users.role_id', '=', 'roles.id')
        // ->select('users.id', 'users.employee_id', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) AS employee_name"), 'users.role_id', 'users.username', 'users.active', 'users.created_at', 'users.updated_at')
        // ->orderBy('users.id', 'asc')
        // ->get();

        return $query;

    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'model_id',
            'model_name',
            'checksheet_appearance',
        ];
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->autoSize();
            },
        ];
    }

    /**
    * @param mixed $row
    *
    * @return array
    */
    public function map($row): array
    {
        return [
            $row->model_id,
            $row->model_name,
            $row->checksheet_appearance,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true, 'size' => 16]],

            'A:Z' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

}
