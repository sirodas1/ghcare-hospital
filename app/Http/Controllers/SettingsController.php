<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Log;

class SettingsController extends Controller
{
    public function home()
    {
        $hospital = Auth::user()->hospital;
        
        $data = [
            'hospital' => $hospital,
        ];

        return view('settings.rootHome', $data);
    }

    public function updateHospital()
    {
        $this->validate(request() ,[
            'logo' => 'nullable|image|',
            'name' => 'required|string',
            'institution_id' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'region' => 'required|string',
            'district' => 'required|string',
            'town' => 'required|string',
            'ghana_post_gps' => 'required|string',
            'type_of_institution' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $hospital = Auth::user()->hospital;
            $hospital->update(request()->except(['logo']));
            
            if(request()->logo){
                $image = request()->file('logo');
                $name = $hospital->id . '_logo' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/hospital';
                $filePath = $this->uploadOne($image, $folder, $name);
                $hospital->logo = $filePath;
                $hospital->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Hospital Was Not Successfully Registered Into The System.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Hospital Information Was Successfully Updated');

        return redirect()->back();
    }

    public function updateRootUser()
    {
        $this->validate(request() ,[
            'profile_pic' => 'nullable|image',
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
        ]);

        DB::beginTransaction();

        try {

            $user = Auth::user();
            $user->update(request()->except('profile_pic'));

            if(request()->profile_pic){
                $image = request()->file('profile_pic');
                $name = $user->id . '_profile_pic' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/hospital/root_user';
                $filePath = $this->uploadOne($image, $folder, $name);
                $user->profile_pic = $filePath;
                $user->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Account Information  Was Not Successfully Updated.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Account Information Was Successfully Updated');

        return redirect()->back();
    }
}
