<?php


namespace App\Filters;

use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\Log;

class EmployeeAttendanceFilter extends Filter
{
    /**
     * @inheritDoc
     */
    public function getQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return EmployeeAttendance::query();
    }

    public function employee($keyword)
    {
        $this->query->where('employee_id', 'LIKE', '%' . $keyword . '%');
    }

}
