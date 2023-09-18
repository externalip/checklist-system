<?php

namespace App\Exports;

use App\Models\User;
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




class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = DB::table('users')
            ->join('employees', 'users.employee_id', '=', 'employees.id')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.id', 'users.employee_id', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) AS employee_name"), 'roles.name AS role_name', 'users.username', 'users.active', 'users.created_at', 'users.updated_at')
            ->orderBy('users.id', 'asc')
            ->get();

        // ->join('employees', 'users.employee_id', '=', 'employees.id')
        // ->join('roles', 'users.role_id', '=', 'roles.id')
        // ->select('users.id', 'users.employee_id', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) AS employee_name"), 'users.role_id', 'users.username', 'users.active', 'users.created_at', 'users.updated_at')
        // ->orderBy('users.id', 'asc')
        // ->get();

        return $query;

    }
    //auto size
    public function registerEvents(): array{
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->autoSize();
            },
        ];
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'id',
            'employee_id',
            'employee_name',
            'role',
            'username',
            'account_state',
            'created_at',
            'updated_at',
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
            $row->id,
            $row->employee_id,
            $row->employee_name,
            $row->role_name,
            $row->username,
            $row->active,
            $row->created_at,
            $row->updated_at,
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
