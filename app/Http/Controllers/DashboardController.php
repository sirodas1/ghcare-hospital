<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        return view('dashboard.home');
    }



    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        DB::beginTransaction();

        try {
            $user = auth()->user();
            if(Hash::check($request->old_password, $user->password)){
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }else{
                session()->flash('error_password', 'Old Password was Inaccurate.');
                return redirect()->back();
            }
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_password', 'Password Update was Not Successfully.');
            return redirect()->back();
        }

        session()->flash('success_password', 'Password Update was Successfully.');

        return redirect()->back();
    }
}
