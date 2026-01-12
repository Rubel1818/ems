<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\History;
use App\Models\Section;
use App\Models\StuffDesignation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeHistoryController extends Controller
{
    /* ===============================
        READ (LIST)
    =============================== */
    public function index(Employee $employee)
    {
        $histories = $employee->histories()
            ->with(['section', 'designation'])
            ->orderBy('start_date', 'desc')
            ->get();

        $sections = Section::orderBy('section_name_bn')->get();
        $designations = StuffDesignation::orderBy('designation_name_bn')->get();

        return view('employees.histories.index', compact(
            'employee',
            'histories',
            'sections',
            'designations'
        ));
    }

    /* ===============================
        CREATE / STORE
    =============================== */



    public function create(Employee $employee)
    {
        $sections = Section::all();
        $designations = StuffDesignation::all();

        return view('employees.histories.create', compact(
            'employee',
            'sections',
            'designations'
        ));
    }

    public function store(Request $request, Employee $employee)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'designation_id' => 'required|exists:stuff_designations,id',
            'start_date' => 'required|date',
        ]);

        $startDate = Carbon::parse($request->start_date);

        $lastHistory = $employee->histories()
            ->orderBy('start_date', 'desc')
            ->first();

        if ($lastHistory) {
            if ($startDate->lte($lastHistory->start_date)) {
                return back()->withErrors([
                    'start_date' => 'Starting date must be after last history date'
                ]);
            }

            $lastHistory->update([
                'end_date' => $startDate->copy()->subDay()
            ]);
        }

        $employee->histories()->create([
            'section_id' => $request->section_id,
            'designation_id' => $request->designation_id,
            'start_date' => $startDate,
            'end_date' => null,
        ]);

        return back()->with('success', 'History added successfully');
    }

    /* ===============================
        EDIT
    =============================== */
    public function edit(Employee $employee, History $history)
    {
        abort_if($history->employee_id !== $employee->id, 403);

        $sections = Section::orderBy('section_name_bn')->get();
        $designations = StuffDesignation::orderBy('designation_name_bn')->get();

        return view('employees.histories.edit', compact(
            'employee',
            'history',
            'sections',
            'designations'
        ));
    }

    /* ===============================
        UPDATE
    =============================== */
    public function update(Request $request, Employee $employee, History $history)
    {
        abort_if($history->employee_id !== $employee->id, 403);

        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'designation_id' => 'required|exists:stuff_designations,id',
            'start_date' => 'required|date',
        ]);

        $newStart = Carbon::parse($request->start_date);

        $previous = $employee->histories()
            ->where('start_date', '<', $history->start_date)
            ->orderBy('start_date', 'desc')
            ->first();

        $next = $employee->histories()
            ->where('start_date', '>', $history->start_date)
            ->orderBy('start_date')
            ->first();

        if ($previous) {
            $previous->update([
                'end_date' => $newStart->copy()->subDay()
            ]);
        }

        $history->update([
            'section_id' => $request->section_id,
            'designation_id' => $request->designation_id,
            'start_date' => $newStart,
            'end_date' => $next
                ? Carbon::parse($next->start_date)->subDay()
                : null,
        ]);

        return redirect()
            ->route('employees.histories.index', $employee->id)
            ->with('success', 'History updated successfully');
    }

    /* ===============================
        DELETE
    =============================== */
    public function destroy(Employee $employee, History $history)
    {
        abort_if($history->employee_id !== $employee->id, 403);

        $previous = $employee->histories()
            ->where('start_date', '<', $history->start_date)
            ->orderBy('start_date', 'desc')
            ->first();

        $next = $employee->histories()
            ->where('start_date', '>', $history->start_date)
            ->orderBy('start_date')
            ->first();

        if ($previous) {
            $previous->update([
                'end_date' => $next
                    ? Carbon::parse($next->start_date)->subDay()
                    : null
            ]);
        }

        $history->delete();

        return back()->with('success', 'History deleted successfully');
    }
}
