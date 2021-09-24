@extends('layouts.dashboard')

@section('title', 'Hospitals Inventory')
@section('page-back', route('home'))
@section('back-check', true)

@section('content')
  @if (isset($inventories) && $inventories->isNotEmpty())
    <div class="row justify-content-between mt-5">
      <div class="col-md-7">
        <form action="{{route('inventory.home')}}" method="GET">
          <div class="form-row">
            <input type="text" name="searchKey" id="searchKey" value="{{old('searchKey') ?? $searchKey}}" class="form-control w-75" placeholder="Search for Drug by Name;">
            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
      <div class="col-md-3">
        <a href="#" class="btn btn-success"data-toggle="modal" data-target="#addDrugModal"><i class="fa fa-plus"></i>&emsp;Add Drug</a>
      </div>
    </div>
  @else
    <div class="row justify-content-end mt-5">
      <div class="col-md-3">
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addDrugModal"><i class="fa fa-plus"></i>&emsp;Add Drug</a>
      </div>
    </div>
  @endif
  
  @if (session()->has('search_message'))
    <br>
    <div class="row justify-content-center">
      <div class="col-6 bg-danger px-4 py-2">
        <span class="text-light">{{session()->get('success_message')}}</span>
      </div>
    </div><br><br>
  @endif
  @if (session()->has('success_message'))
    <br>
    <div class="row justify-content-center">
      <div class="col-6 bg-success px-4 py-2">
        <span class="text-light">{{session()->get('success_message')}}</span>
      </div>
    </div><br><br>
  @endif
  @if (isset($inventories) && $inventories->isNotEmpty())
    <div class="row p-2 my-3">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="bg-success text-light">
            <th scope="col"></th>
            <th scope="col">Drug Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Type</th>
            <th scope="col">Description</th>
            <th scope="col">Vendor</th>
            <th scope="col" nowrap="nowrap">Price (GHc)</th>
          </thead>
          <tbody class="my-2">
            @foreach ($inventories as $inventory)
              <tr class="cursor-pointer my-1">
                <td class="col-1"><img src="{{$inventory->image}}" alt="No Image Available" class="img img-fluid"></td>
                <td>{{$inventory->name}}</td>
                <td>{{$inventory->quantity}}</td>
                <td>{{$inventory->type}}</td>
                <td>{{$inventory->description}}</td>
                <td>{{$inventory->vendor}}</td>
                <td>{{$inventory->price}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @else
    <br><br><br>
    <div class="row justify-content-center h4 text-secondary mt-5">
      There are no Drugs Added into the Hospitals Inventory.
    </div>
  @endif

  {{-- Add Drugs Modal --}}
  <div class="modal fade" id="addDrugModal" tabindex="-1" role="dialog" aria-labelledby="addDrugModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="row justify-content-center my-4">
            <span class="form-header">Enter Drug Information</span>
          </div>
          <div class="row justify-content-center">
            <div class="col-9">
              <form method="POST" action="{{ route('inventory.add') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                  <div class="col-6 col-md-3">
                    <div class="row justify-content-center mb-3">
                      <span class="text-secondary">Upload Drug Image</span>
                    </div>
                    <div id="uploadImageBlock" class="border border-success w-100 p-5 d-flex align-center justify-content-center rounded cursor-pointer" onclick="document.getElementById('image').click()">
                      <span class="text-success"><i class="fa fa-camera fa-2x"></i></span>
                    </div>
                    <img id="imagePreview" src="#" class="img img-fluid rounded" onclick="document.getElementById('image').click()" hidden>
                  </div>
                  <input type="file" name="image" id="image" onchange="loadImagePreview('imagePreview', this);" accept="image/*" hidden>
                  <div class="col-md-6 offset-md-3">
                    <label for="type">Enter Name of Vender: </label>
                    <input id="vendor" type="text" class="form-control" name="vendor" required placeholder="Enter Vendor Name">
                  </div>
                </div>
                <div class="form-group row my-3">
                  <div class="col-md-6">
                    <label for="type">Enter Drug Name: </label>
                    <input id="name" type="text" class="form-control" name="name" required placeholder="Enter Drug Name">
                  </div>
                  <div class="col-md-6">
                    <label for="type">Select Drug Type: </label>
                    <select name="type" id="type" class="form-control">
                      <option>Tablet</option>
                      <option>Syrup</option>
                      <option>Drip</option>
                      <option>Cream</option>
                      <option>Drops</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row my-3">
                  <div class="col">
                    <label for="type">Enter Description of The Drug: </label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter Drug Description"></textarea>
                  </div>
                </div>
                <div class="form-group row my-3">
                  <div class="col-md-6">
                    <label for="type">Enter Quantity: </label>
                    <input id="quantity" type="number" class="form-control" name="quantity" step="1" min="1" required placeholder="Enter Quantity">
                  </div>
                  <div class="col-md-6">
                    <label for="type">Enter Drug Price (GHc): </label>
                    <input id="price" type="number" class="form-control" step="0.01" min="0.00" name="price" required placeholder="Enter Price (GHc)">
                  </div>
                </div>
                <div class="form-group my-4 row justify-content-center">
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-success w-100" style="border-radius: 25px;">
                      {{ __('Add Drug') }}
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection