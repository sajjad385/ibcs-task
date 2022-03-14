<?php

namespace App\Imports;

use App\Models\EmployeeAttendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeAttendanceImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return EmployeeAttendance
     */
    public function model(array $row)
    {
        $firstInTime = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date:: excelToDateTimeObject($row['first_in_time']))->format('H:i:s');
        $lastOutTime = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date:: excelToDateTimeObject($row['last_out_time']))->format('H:i:s');
        return new EmployeeAttendance([
            'month' => $row['month'],
            'date' => gmdate("Y-m-d", (($row['date'] - 25569) * 86400)),
            'day' => $row['day'],
            'employee_id' => $row['id'],
            'employee_name' => $row['employee_name'],
            'department' => $row['department'],
            'first_in_time' => $firstInTime,
            'last_out_time' => $lastOutTime,
            'hours_of_work' => $row['hours_of_work'],
        ]);
    }
}
