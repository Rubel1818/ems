<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class DashboardController extends Controller
{
    public function index()
    {


        $user = auth::user();

        $employees = Employee::with(['district', 'section', 'stuffDesignation'])
            ->where('status', 1)
            ->get();


        //return view('employees.dashboard', compact('employees'));
        // Empty collection for other roles
        return view('employees.dashboard', compact('employees'));
    }
}
