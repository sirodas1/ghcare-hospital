<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Validator;

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

    public function nurseHome()
    {
        $nurse = Auth::guard('nurse')->user();
        $data = [
            'nurse' => $nurse,
        ];
        return view('nurse_dashboard.settings.home', $data);
    }

    public function updateNurse()
    {
        $validator = Validator::make(request()->all() ,[
            'profile_pic' => 'nullable|image',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'othernames' => 'nullable|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'nursing_card_number' => 'required|string',
            'gender' => 'required|string',
            'age' => 'required|numeric',
            'region' => 'required|string',
            'district' => 'required|string',
            'town' => 'required|string',
            'landmark' => 'required|string',
            'residential_address' => 'required|string',
        ]);
        if ($validator->fails()) {
            Log::error($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $nurse = Auth::guard('nurse')->user();
            $nurse->update(request()->except('profile_pic'));
            
            if(request()->profile_pic){
                $image = request()->file('profile_pic');
                $name = $nurse->id . '_profile_pic' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/nurse/';
                $filePath = $this->uploadOne($image, $folder, $name);
                $nurse->profile_pic = $filePath;
                $nurse->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Account Information Was Not Successfully Updated .');
            return redirect()->back();
        }

        session()->flash('success_message', 'Account Information Was Successfully Updated.');

        return redirect()->back();
    }

    public function doctorHome()
    {
        $doctor = Auth::guard('doctor')->user();
        $data = [
            'doctor' => $doctor,
        ];
        return view('doctor_dashboard.settings.home', $data);
    }

    public function updateDoctor()
    {
        $validator = Validator::make(request()->all() ,[
            'profile_pic' => 'nullable|image',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'othernames' => 'nullable|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'doctor_card_number' => 'required|string',
            'gender' => 'required|string',
            'age' => 'required|numeric',
            'region' => 'required|string',
            'district' => 'required|string',
            'town' => 'required|string',
            'landmark' => 'required|string',
            'residential_address' => 'required|string',
        ]);
        if ($validator->fails()) {
            Log::error($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $doctor = Auth::user();
            $doctor->update(request()->except('profile_pic'));
            
            if(request()->profile_pic){
                $image = request()->file('profile_pic');
                $name = $doctor->id . '_profile_pic' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/doctor/';
                $filePath = $this->uploadOne($image, $folder, $name);
                $doctor->profile_pic = $filePath;
                $doctor->save();
            }
            
            DB::commit();
            session()->flash('success_message', 'Account Information Was Successfully Updated.');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();
            session()->flash('error_message', 'Account Information Was Not Successfully Updated .');
        }

        return redirect()->back();
    }
}
