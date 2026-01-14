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
            ->first();
        //dd($employees);
        // যদি তথ্য না থাকে অথবা স্ট্যাটাস ১ (Active) না হয়
        if (!$employees || $employees->status != 1) {
            // তাকে অন্য কোনো পেজে পাঠিয়ে দিন অথবা একটি মেসেজ দেখান
            return redirect()->back()->with('error', 'আপনার প্রোফাইল এখনো এডমিন দ্বারা অনুমোদিত হয়নি। অনুগ্রহ করে অপেক্ষা করুন।');
        }
        return view('user.normalUser', compact('employees'));
    }

    public function create()
    {
        return view('user.createNormalUser');
    }
    public function store(Request $request)
    {
        // ১. প্রথমেই চেক করুন এই ইউজারের ডাটা অলরেডি আছে কি না (Manual Check)
        if (Employee::where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'আপনার তথ্য ইতিমধ্যে সিস্টেমে রয়েছে।');
        }

        // ২. অন্যান্য ফিল্ড ভ্যালিডেশন
        $request->validate([
            'birth_date' => 'required|date',
            'district_id' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'service_book' => 'nullable|mimes:pdf,docx,jpg,png|max:5120',
            // এখানে user_id ভ্যালিডেশন দরকার নেই কারণ আমরা উপরে ম্যানুয়ালি চেক করেছি
        ]);

        $data = $request->all();

        // ৩. সিস্টেম জেনারেটেড ডাটা সেট করা
        $data['user_id'] = Auth::id();
        $data['name_en'] = Auth::user()->name;
        $data['status']  = 0; // ⏳ Pending for admin approval

        // ৪. ফাইল আপলোড হ্যান্ডলিং
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('service_book')) {
            $data['service_book'] = $request->file('service_book')->store('service_books', 'public');
        }

        // ৫. PRL তারিখ গণনা (৫৯ বছর পর)
        if ($request->birth_date) {
            $data['prl_date'] = Carbon::parse($request->birth_date)->addYears(59)->toDateString();
        }

        // ৬. আইডি জেনারেশন এবং সেভ
        $data['employee_id'] = $this->generateEmployeeId();

        Employee::create($data);

        return redirect()->route('NormalUser.Dashboard')->with('success', 'আপনার তথ্য সফলভাবে সংরক্ষিত হয়েছে এবং অনুমোদনের জন্য অপেক্ষমাণ।');
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
