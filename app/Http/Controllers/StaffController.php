<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Pharmacist;
use App\Models\Nurse;
use Log;
use DB;
use Session;
use Validator;
use Hash;

class StaffController extends Controller
{
    public function home()
    {
        return view('dashboard.staff.home');
    }

    public function viewDoctors()
    {
        $doctors = Doctor::all();

        $data = [
            'doctors' => $doctors,
        ];
        return view('dashboard.staff.doctors.home', $data);
    }

    public function addDoctor()
    {
        return view('dashboard.staff.doctors.create');
    }

    public function storeDoctor(Request $request)
    {
        $validator = Validator::make(request()->all() ,[
            'profile_pic' => 'nullable|image',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'othernames' => 'nullable|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
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
            //Hash encode the password before saving into database.
            request()['password'] = Hash::make(request()->password);
            request()['hospital_id'] = auth()->user()->hospital_id;

            $doctor = Doctor::create(request()->all());
            
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
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Doctor Was Not Successfully Added To The Hospital.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Doctor Was Successfully Added To The Hospital.');

        return redirect()->route('staff.doctors.home');
    }

    public function showDoctor($id)
    {
        $doctor = Doctor::find($id);
        $data = [
            'doctor' => $doctor,
        ];
        return view('dashboard.staff.doctors.show', $data);
    }

    public function updateDoctor(Request $request, $id)
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
            $doctor = Doctor::find($id);
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
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Doctor Information Was Not Successfully Updated .');
            return redirect()->back();
        }

        session()->flash('success_message', 'Doctor Information Was Successfully Updated.');

        return redirect()->back();
    }

    /**
     * Pharmacist Controller Methods
     */
    public function viewPharmacists()
    {
        $pharmacists = Pharmacist::all();

        $data = [
            'pharmacists' => $pharmacists,
        ];
        return view('dashboard.staff.pharmacists.home', $data);
    }

    public function addPharmacist()
    {
        return view('dashboard.staff.pharmacists.create');
    }

    public function storePharmacist(Request $request)
    {
        $validator = Validator::make(request()->all() ,[
            'profile_pic' => 'nullable|image',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'othernames' => 'nullable|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'pharmacist_card_number' => 'required|string',
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
            //Hash encode the password before saving into database.
            request()['password'] = Hash::make(request()->password);
            request()['hospital_id'] = auth()->user()->hospital_id;

            $pharmacist = Pharmacist::create(request()->all());
            
            if(request()->profile_pic){
                $image = request()->file('profile_pic');
                $name = $pharmacist->id . '_profile_pic' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/pharmacist/';
                $filePath = $this->uploadOne($image, $folder, $name);
                $pharmacist->profile_pic = $filePath;
                $pharmacist->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Pharmacist Was Not Successfully Added To The Hospital.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Pharmacist Was Successfully Added To The Hospital.');

        return redirect()->route('staff.pharmacists.home');
    }

    public function showPharmacist($id)
    {
        $pharmacist = Pharmacist::find($id);
        $data = [
            'pharmacist' => $pharmacist,
        ];
        return view('dashboard.staff.pharmacists.show', $data);
    }

    public function updatePharmacist(Request $request, $id)
    {
        $validator = Validator::make(request()->all() ,[
            'profile_pic' => 'nullable|image',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'othernames' => 'nullable|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'pharmacist_card_number' => 'required|string',
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
            $pharmacist = Pharmacist::find($id);
            $pharmacist->update(request()->except('profile_pic'));
            
            if(request()->profile_pic){
                $image = request()->file('profile_pic');
                $name = $pharmacist->id . '_profile_pic' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/pharmacist/';
                $filePath = $this->uploadOne($image, $folder, $name);
                $pharmacist->profile_pic = $filePath;
                $pharmacist->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Pharmacist Information Was Not Successfully Updated .');
            return redirect()->back();
        }

        session()->flash('success_message', 'Pharmacist Information Was Successfully Updated.');

        return redirect()->back();
    }

    /**
     * Nurses Controller Methods
     */
    public function viewNurses()
    {
        $nurses = Nurse::all();

        $data = [
            'nurses' => $nurses,
        ];
        return view('dashboard.staff.nurses.home', $data);
    }

    public function addNurse()
    {
        return view('dashboard.staff.nurses.create');
    }

    public function storeNurse(Request $request)
    {
        $validator = Validator::make(request()->all() ,[
            'profile_pic' => 'nullable|image',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'othernames' => 'nullable|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
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
            //Hash encode the password before saving into database.
            request()['password'] = Hash::make(request()->password);
            request()['hospital_id'] = auth()->user()->hospital_id;

            $nurse = Nurse::create(request()->all());
            
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

            session()->flash('error_message', 'Nurse Was Not Successfully Added To The Hospital.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Nurse Was Successfully Added To The Hospital.');

        return redirect()->route('staff.nurses.home');
    }

    public function showNurse($id)
    {
        $nurse = nurse::find($id);
        $data = [
            'nurse' => $nurse,
        ];
        return view('dashboard.staff.nurses.show', $data);
    }

    public function updateNurse(Request $request, $id)
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
            $nurse = Nurse::find($id);
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

            session()->flash('error_message', 'Nurse Information Was Not Successfully Updated .');
            return redirect()->back();
        }

        session()->flash('success_message', 'Nurse Information Was Successfully Updated.');

        return redirect()->back();
    }
}
