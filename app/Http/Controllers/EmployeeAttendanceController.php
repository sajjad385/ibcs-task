<?php

namespace App\Http\Controllers;

use App\Filters\EmployeeAttendanceFilter;
use App\Http\Requests\AttendanceImportRequest;
use App\Http\Resources\EmployeeAttendanceResource;
use App\Imports\EmployeeAttendanceImport;
use App\Models\EmployeeAttendance;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\File;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $query = EmployeeAttendanceFilter::new()->apply();
        $attendances = $query->paginate($this->limit())
            ->each(function ($report) use ($request) {
                $inTime = $request->input('in_time', null);
                $outTime = $request->input('out_time', null);
                if ($inTime) {
                    $report->setAttribute('in_time', $inTime . ':00');
                }
                if ($outTime) {
                    $report->setAttribute('out_time', $outTime . ':00');
                }
            });
        $reports = EmployeeAttendanceResource::collection($attendances);
        return view('employee.attendance', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('employee.import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AttendanceImportRequest $request
     * @return RedirectResponse
     */
    public function store(AttendanceImportRequest $request): RedirectResponse
    {
        try {
            Excel::import(new EmployeeAttendanceImport, $request->file('file'));
            Toastr::success('Data Import Successfully', 'Imported');
            return redirect()->route('attendances.index');
        } catch (\Exception $exception) {
            Toastr::error($exception->getMessage(), 'Error');
            return redirect()->back();
        }
    }


    public function reports(Request $request)
    {
        $reports = EmployeeAttendance::query()->get();
        $data = [
            'date' => now(),
            'reports' => $reports
        ];
        $pdf = PDF::loadView('employee.report', $data);
        $file = 'Employee-attendance-report' . now()->format('Y-m-d-H-i-s') . '.pdf';
        return $pdf->download($file);
    }
}
