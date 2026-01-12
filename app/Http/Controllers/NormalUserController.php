<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class NormalUserController extends Controller
{
    public function index()
    {
        $employees = Employee::with([
            'stuffDesignation',
            'district',
            'section'
        ])
            ->where('user_id', auth()->id())
            ->get();

        return view('user.normalUser', compact('employees'));
    }

    public function create()
    {
        return view('user.createNormalUser');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::id();
        $name_en = Auth::user()->name;
        $data['name_en'] = $name_en;
        $data['user_id'] = $user_id;
        $data['status'] = 0; // ⏳ Pending
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('service_book')) {
            $data['service_book'] = $request->file('service_book')->store('service_books', 'public');
        }
        // Calculate PRL date: 59 years after birth_date
        $prlDate = Carbon::parse($request->birth_date)->addYears(59);
        $data['prl_date'] = $prlDate->toDateString();
        $employeeId = $this->generateEmployeeId();
        $data['employee_id'] = $employeeId;
        Employee::create($data);

        return redirect()->route('NormalUser.Dashboard')->with('success', 'ডাটা সংরক্ষণ হয়েছে');
    }
    private function generateEmployeeId()
    {
        $lastEmployee = Employee::orderBy('id', 'desc')->first();

        if (!$lastEmployee) {
            return 'EMP0001';
        }

        $lastNumber = (int) str_replace('EMP', '', $lastEmployee->employee_id);
        $newNumber = $lastNumber + 1;

        return 'EMP' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}
