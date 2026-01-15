<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\section;
use App\Models\StuffDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // ১. কুয়েরি শুরু করা হচ্ছে (সব রোলের জন্যই কমন)
        $query = Employee::with(['stuffDesignation', 'district', 'section']);

        // ২. ফিল্টারিং লজিক (সাইডবার থেকে ডেজিগনেশন ক্লিক করলে কাজ করবে)
        if ($request->has('designation')) {
            $query->where('stuff_designation_id', $request->designation);
        }

        // ৩. রোল ভিত্তিক ডাটা এবং ভিউ হ্যান্ডলিং

        // ক. Admin অথবা Employee (সব ডাটা দেখতে পাবেন)
        if ($user->hasAnyRole(['admin', 'employee'])) {
            $employees = $query->latest()->get();
            return view('employees.index', compact('employees'));
        }

        // খ. অন্যান্য রোল বা গেস্ট (যেমন: UserDashboard)
        // শুধুমাত্র অনুমোদিত (Approved) ডাটা ফিল্টার করা হচ্ছে
        $employees = $query->where('status', 1)->latest()->get();

        return view('employees.dashboard', compact('employees'));
    }



    public function create()
    {
        return view('employees.create');
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

    public function store(Request $request)
    {
        $data = $request->all();
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

        return redirect()->route('employees.index')->with('success', 'ডাটা সংরক্ষণ হয়েছে');
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
    public function show($id)
    {

        $employee = Employee::with(['section', 'stuffDesignation'])->findOrFail($id);

        // Fetch histories for this employee
        $histories = $employee->histories()->with(['section', 'designation'])->get();

        // Fetch sections and designations for the form dropdown
        $sections = Section::all();
        $designations = StuffDesignation::all();

        return view('employees.detail_view', compact('employee', 'histories', 'sections', 'designations'));

        //return view('employees.detail_view', compact('employee'));
    }

    public function showPrl()
    {
        $today = Carbon::today();
        $nextThreeYears = Carbon::today()->addYears(3);

        // Fetch employees whose PRL date is within next 3 years
        // Also eager load related district and designation
        $employees = Employee::with(['district', 'designation'])
            ->whereBetween('prl_date', [$today, $nextThreeYears])
            ->select(
                'id',
                'employee_id',
                'name_bn',
                'birth_date',
                'prl_date',
                'office_name',
                'service_book',
                'district_id',
                'stuff_designation_id'
            )
            ->orderBy('prl_date')
            ->get();

        return view('employees.dashboard', compact('employees'));
    }


    //public function pending()
    //{
    //  $employees = Employee::where('status', 0)->get();
    //return view('admin.employees.pending', compact('employees'));
    // }
    public function approve(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $employee->update([
            'status' => 1,
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Employee approved.');
    }



    public function downloadPDF($id)
    {
        $employee = Employee::findOrFail($id);
        $pdf = Pdf::loadView('employees.pdf_profile', compact('employee'));
        return $pdf->download($employee->employee_id . '_profile.pdf');
    }
}
