<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Log;
use DB;
use Session;
use Validator;
use Hash;
use App\Models\Inventory;
use App\Models\Hospital;
use App\Models\Medication;

class InventoryController extends Controller
{
  public function home()
  {
    $hospital = Hospital::with('inventories')->find(Auth::user()->hospital_id);
    $inventories = $hospital->inventories;
    $searchKey = null;
    // dd($inventories);

    if (request()->searchKey && request()->searchKey !== '') {
      $inventoriesFilter = $inventories->filter(function ($value) {
        return stripos($value->name, request()->searchKey) !== false ||
          stripos($value->type, request()->searchKey) !== false ||
          stripos($value->vendor, request()->searchKey) !== false;
      });
      if (count($inventoriesFilter) <= 0) {
        session()->flash('search_message',
          'No result found for search key: ' . request()->searchKey
        );
      }
      $inventories = count($inventoriesFilter) > 0 ? $inventoriesFilter : $inventories;
      
      $searchKey = request()->searchKey;
    }

    $data = [
      'inventories' => $inventories,
      'searchKey' => $searchKey,
    ];

    return view('inventory.home', $data);
  }

  public function addDrug(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'image' => 'required|image', 
      'name' => 'required|string', 
      'quantity' => 'required|numeric',
      'type' => 'required|string', 
      'description' => 'required|string', 
      'vendor' => 'required|string', 
      'price' => 'required|numeric',
    ]);
    if ($validator->fails()) {
      Log::error($validator->errors());
      return redirect()->back()->withErrors($validator)->withInput();
    }

    DB::beginTransaction();

    try {

      $request['hospital_id'] = auth()->user()->hospital->id;
      $drug = Inventory::create($request->all());

      if($request->image){
        $image = $request->file('image');
        $name = $drug->id . '_inventory_img' . '.' .
        $image->getClientOriginalExtension();
        $folder = '/uploads/inventory/';
        $filePath = $this->uploadOne($image, $folder, $name);
        $drug->image = $filePath;
        $drug->save();
      }

      DB::commit();
      session()->flash('success_message', 'Drug Has Been Added to Inventory.');
    } catch (\Exception $exception) {
      DB::rollback();
      Log::error(['error' => $exception->getMessage()]);
      session()->flash('error_message', 'Error Adding Drug to Inventory.');  
    }

    return back();
  }

  public function medicationhome()
  {
    $medications = Medication::where('hospital_id', Auth::user()->hospital->id)
                              ->where('completed', false)->get();

    $data =[
      'medications' => $medications,
    ];

    return view('pharmacist_dashboard.medication.home', $data);
  }

  public function issueDrug($id)
  {
    $medication = Medication::find($id);
    $inventory = $medication->drug;

    if ($inventory->quantity >= $medication->quantity) {
      $medication->completed = true;
      $medication->save();

      $inventory->quantity = $inventory->quantity - $medication->quantity;
      $inventory->save();

      session()->flash('success_message', 'Medication has been Issued Successfully.');
    }else{
      session()->flash('error_message', 'Not Enough Quantity in the Inventory.');
    }

    return back();
  }
}
