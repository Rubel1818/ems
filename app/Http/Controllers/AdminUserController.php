<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
//use EmailVerificationNotificationController;
// User Management এর জন্য AdminController মেথড ব্যবহার করা হয়েছে  
class AdminUserController extends Controller
{
    // User Management এর জন্য AdminController মেথড
    public function userIndex()
    {
        // ১) latest() ব্যবহার করা হয়েছে যাতে নতুন ইউজার সবার আগে দেখা যায়
        // ২) get() এর পরিবর্তে paginate(5) ব্যবহার করা হয়েছে ৫ জন ইউজার দেখানোর জন্য
        $users = User::whereNotNull('email_verified_at')
            ->with('roles')
            ->latest()
            ->paginate(5);

        $roles = \Spatie\Permission\Models\Role::all();

        return view('admin.user_management', compact('users', 'roles'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_approved' => true]);
        return back()->with('success', 'ইউজার এপ্রুভ করা হয়েছে।');
    }

    public function changeRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->syncRoles($request->role);
        return back()->with('success', 'ইউজারের রোল পরিবর্তন করা হয়েছে।');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'ইউজার সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
