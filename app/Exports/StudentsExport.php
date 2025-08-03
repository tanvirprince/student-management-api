<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'image',
            'email',
            'phone',
            'address',
            'dob',
            'password',
            'class',
            'section',
            'created_at',
            'updated_at',
        ];
    }
}
