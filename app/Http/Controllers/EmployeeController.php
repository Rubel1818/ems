<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('service_book')) {
            $data['service_book'] = $request->file('service_book')->store('service_books', 'public');
        }

        Employee::create($data);

        return redirect()->route('employees.index')->with('success', 'ডাটা সংরক্ষণ হয়েছে');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('service_book')) {
            $data['service_book'] = $request->file('service_book')->store('service_books', 'public');
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'ডাটা আপডেট হয়েছে');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back()->with('success', 'ডাটা ডিলিট হয়েছে');
    }
    public function show(Employee $employee)
    {
        return view('employees.detail_view', compact('employee'));
    }
}
