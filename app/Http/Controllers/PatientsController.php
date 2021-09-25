<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\AllergyAndPhorbia;
use App\Models\Folder;
use App\Models\File;
use App\Models\Doctor;
use App\Models\Inventory;
use App\Models\Medication;
use DB;
use Auth;
use Log;

class PatientsController extends Controller
{
    public function home()
    {
        $folders = Folder::where('hospital_id', Auth::user()->hospital->id)->get();
        $data = [
            'folders' => $folders,
        ];

        return view('patient.home', $data);
    }

    public function accessPatient(Request $request)
    {
        $this->validate($request, [
            'national_card_id' => 'required',
        ]);
        $patient = Patient::where('national_card_id', $request->national_card_id)->first();
        if (!$patient) {
            session()->flash('error_message', 'Patient Doesn\'t exist.');
            return back();
        }
        
        $folder = $patient->folders->where('hospital_id', auth()->user()->hospital->id)->first();

        $data =[
            'patient' => $patient,
            'folder' => $folder,
        ];
        return view('patient.details', $data);
    }

    public function openFolders($id)
    {
        $patient = Patient::find($id);
        $folders = $patient->folders;
        $data = [
            'patient' => $patient,
            'folders' => $folders,
        ];

        return view('patient.folders', $data);
    }

    public function openFolder($id)
    {
        $folder = Folder::find($id);
        $data = [
            'folder' => $folder,
        ];

        return view('patient.folder', $data);
    }

    public function nurseAccessPatient(Request $request)
    {
        $this->validate($request, [
            'national_card_id' => 'required',
        ]);

        $patient = Patient::where('national_card_id', $request->national_card_id)->first();
        if (!$patient) {
            session()->flash('error_message', 'Patient Doesn\'t exist.');
            return back();
        }

        $folder = $patient->folders->where('hospital_id', auth()->user()->hospital->id)->first();
        
        $data =[
            'patient' => $patient,
            'folder' => $folder,
        ];

        return view('nurse_dashboard.patient.home', $data);
    }

    public function addAllergyOrPhobia(Request $request)
    {
        $this->validate($request, [
            'patient_id' => 'required|numeric',
            'type' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        DB::beginTransaction();
        
        try {
            $allergy = AllergyAndPhorbia::create($request->all());

            DB::commit();
            session()->flash('success_message', 'Allergy or Phobia Successfully Added.');
        } catch (\Exception $exception) {
            Log::error(['error' => $exception->getMessage()]);
            session()->flash('error_message', 'Failed to Add Allergy or Phobia.');
            DB::rollback();
        }

        return back();
    }

    public function nurseCreateFolder($id)
    {
        DB::beginTransaction();
        try {
            $folder = Folder::create([
                'hospital_id' => Auth::user()->hospital->id,
                'patient_id' => $id
            ]);

            DB::commit();
            session()->flash('success_message', 'Folder Created Successfully.');
        } catch (\Exception $exception) {
            Log::error(['error' => $exception->getMessage()]);
            DB::rollback();
            session()->flash('error_message', 'Error Occured when Creating Folder for Patient.');
        }
        return back();
    }

    public function nurseCreateFile($id)
    {
        $folder = Folder::find($id);
        $doctors = Doctor::where('hospital_id', Auth::user()->hospital->id)->where('on_duty', true)->get();
        $data = [
            'folder' => $folder,
            'doctors' => $doctors
        ];
        return view('nurse_dashboard.patient.new_file', $data);
    }

    public function nurseStoreFile(Request $request)
    {
        $this->validate($request, [
            'folder_id' => 'required|numeric',
            'nurse_id' => 'required|numeric',
            'doctor_id' => 'required|numeric',
            'symptoms' => 'required|string',
            'temperature' => 'required|numeric',
            'bpm' => 'required|numeric',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'prognosis' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $datetime = $request->date . ' ' . $request->time;
            $request['time_of_detection'] = date('Y-m-d h:i:s', strtotime($datetime));

            $file = File::create($request->all());
            DB::commit();
            session()->flash('success_message', 'File Created Successfully and Assigned to Doctor.');
        } catch (\Exception $exception) {
            Log::error(['error' => $exception->getMessage()]);
            DB::rollback();
            session()->flash('error_message', 'Failed to Create File.');
            return  back();
        }

        $ghana_card = Folder::find($request->folder_id)->patient->national_card_id;
        return redirect()->route('nurse.patient.home',['national_card_id' => $ghana_card ]);
    }

    public function nurseEditFile($id)
    {
        $file = File::find($id);
        $doctors = Doctor::where('hospital_id', Auth::user()->hospital->id)->where('on_duty', true)->get();

        $data = [
            'file' => $file,
            'doctors' => $doctors,
        ];
        return view('nurse_dashboard.patient.edit_file', $data);
    }

    public function nurseUpdateFile(Request $request, $id)
    {
        $this->validate($request, [
            'folder_id' => 'required|numeric',
            'nurse_id' => 'required|numeric',
            'doctor_id' => 'required|numeric',
            'symptoms' => 'required|string',
            'temperature' => 'required|numeric',
            'bpm' => 'required|numeric',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'prognosis' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $file = File::find($id);
            $file->update($request->all());

            DB::commit();
            session()->flash('success_message', 'File Updated Successfully.');
        } catch (\Exception $exception) {
            Log::error(['error' => $exception->getMessage()]);
            DB::rollback();
            session()->flash('error_message', 'Failed to Update File.');
            return  back();
        }

        $ghana_card = Folder::find($request->folder_id)->patient->national_card_id;
        return redirect()->route('nurse.patient.home',['national_card_id' => $ghana_card ]);
    }

    // Doctor Controller Methods
    public function doctorPatients()
    {
        $files = File::where('doctor_id', Auth::user()->id)
                    ->where('health_status','!=', 'Cured')->get();
        $data = [
            'files' => $files,
        ];

        return view('doctor_dashboard.patients.home', $data);
    }

    public function getFile($id)
    {
        $file = File::find($id);
        $patient = $file->folder->patient;
        $drugs = Inventory::where('hospital_id', Auth::user()->hospital->id)->get();
        $data = [
            'file' => $file,
            'patient' => $patient,
            'drugs' => $drugs,
        ];

        return view('doctor_dashboard.patients.file', $data);
    }

    public function updateFile(Request $request, $id)
    {
        $this->validate($request, [
            'symptoms' => 'required|string',
            'temperature' => 'required|numeric',
            'bpm' => 'required|numeric',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'diagnosis' => 'required|string',
            'health_status' => 'required|string',
            'contagious' => 'required|boolean',
            'time_of_cured' => 'nullable|date',
        ]);

        DB::beginTransaction();

        try {

            $file = File::find($id);
            $request['time_of_cured'] = date('Y-m-d h:i:s', strtotime($request->time_of_cured));

            $file->update($request->all());

            DB::commit();
            session()->flash('success_message', 'File Updated Successfully.');
        } catch (\Exception $exception) {
            Log::error(['error' => $exception->getMessage()]);
            DB::rollback();
            session()->flash('error_message', 'Failed to Update File.');
            return  back();
        }

        return back();
    }

    public function prescribe(Request $request)
    {
        $this->validate($request,  [
            'doctor_id' => 'required|numeric',
            'file_id' => 'required|numeric',
            'drug_id' => 'required|numeric',
            'dosage' => 'required|string',
            'quantity' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $request['hospital_id'] = Auth::user()->hospital->id;
            $medication = Medication::create($request->all());
            session()->flash('success_message', 'Prescription of Medication was Successful.');
            DB::commit();
        } catch (\Excepttion $exception) {
            DB::rollback();
            Log::error(['error' => $exception->getMessage()]);
            session()->flash('error_message', 'Error Prescribing Medication.');
        }

        return back();
    }
}
