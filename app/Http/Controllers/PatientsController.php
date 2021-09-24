<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientsController extends Controller
{
    public function home()
    {
        $patients = null;
        $data = [
            'patients' => $patients,
        ];

        return view('patient.home', $data);
    }

    public function accessPatient(Request $request)
    {
        $this->validate($request, [
            'national_card_id' => 'required',
        ]);

        $patient = Patient::where('national_card_id', $request->national_card_id)->first();

        $data =[
            'patient' => $patient,
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

        return view('patient.folder', $data);
    }
}
