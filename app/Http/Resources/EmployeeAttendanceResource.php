<?php

namespace App\Http\Resources;

use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

/**
 * Class BookingResource
 * @package App\Http\Resources
 * @property EmployeeAttendance $resource
 */
class EmployeeAttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'month' => $this->resource->month,
            'date' => $this->resource->date,
            'day' => $this->resource->day,
            'employee_id' => $this->resource->employee_id,
            'employee_name' => $this->resource->employee_name,
            'department' => $this->resource->department,
            'first_in_time' => $this->resource->first_in_time,
            'last_out_time' => $this->resource->last_out_time,
            'hours_of_work' => $this->resource->hours_of_work,
        ];
    }
}
