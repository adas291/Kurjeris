<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Operator;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Status;
use App\Models\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;

class OperatorController extends Controller
{

  public function showClients()
  {
    $clients = User::all();
    $message = session("message");
    return view("operator.show-clients", compact('clients', 'message'));
  }

  public function showPackages()
  {

    $userId = Auth::user()->id;
    $operator = Operator::where('user_id', $userId)->first();

    $packages = Package::where('city_id', $operator->city_id)
                    ->where('street_id', $operator->street_id)
                    ->with(['city', 'user']) // Eager load the 'city' and 'user' relationships
                    ->get();

    return view("operator.show-all-packages", compact("packages"));
  }


  public function createClient()
  {
    return view("operator.create-client");
  }

  public function showPackage($packageId)
  {
    $package = Package::where("id", $packageId)->first();

    $packageHistory = PackageStatus::where("package_id", $packageId)
      ->with(['status'])
      ->get();

    // dd($packageHistory);
    $nextStatus = null;
    $packageStatusId = $package->status_id;
    if ($packageStatusId < 4) {
      $nextStatus = Status::where('id', $packageStatusId + 1)->first();
      // dd($nextStatus);
    }
    return view("operator.show-package", compact("package", "packageHistory", "nextStatus"));
  }

  public function updateStatus()
  {
    // dd($_POST);
    $packageId = request()->input('packageId');
    $statusId = request()->input('statusId');
    $isFinished = $statusId == 4 ? true : false;
    DB::beginTransaction();
    try {
      // $package = Package::find($packageId);

      Package::where('id', $packageId)->update([
        'status_id' => $statusId,
        'is_finished' => $isFinished
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->withErrors(['status' => 'nepavyko pakeisti statuso']);
    }
    try {
      // dd($statusId);
      // dd($packageId + $statusId);
      PackageStatus::create(['package_id' => $packageId, 'status_id' => $statusId]);
      // dd('insert to status failed ');
      DB::commit();
      return redirect(route('operator.show-package', [$packageId]));
      // return response('status update to ' . $statusId);
    } catch (\Exception $e) {

      // dd('insert to status failed ');
      dd($e);
      DB::rollBack();
      return response('Netinkama statusas: ' . $statusId);
    }

  }

  public function viewStatus($id)
  {

    $packages = Package::with('city, user')
      ->where('id', $id);
  }

  public function storeUser(Request $request)
  {
    $data = $request->validate(
      [
        'name' => 'required',
        'email' => 'required|email',
        'password' => [
          'required',
          'min:6',
          'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*])/', // Requires at least one uppercase letter and one symbol
        ],
      ],
      [
        'password.required' => 'Slaptažodis yra būtinas',
        'password.min' => 'Slaptažodis privalo būti bent 6 simbolių ilgio',
        'password.regex' => 'Slaptažodį privalo sudaryti bent viena didžioji raidė ir specalus simbolis'
      ]
    );

    $data['password'] = Hash::make($data['password']); // Hash the password
    $data['user_role'] = '1';

    try {
      $user = User::create($data);
    } catch (\Exception $e) {
      // dd($e);
      return back()->withInput()->with('message', "Naudotojoas su šiuo el. paštu jau užregistruotas");
    }


    return redirect()->route('operator.show-clients')->with("message", "Klientas sukurtas sėkmingai");
  }



}
