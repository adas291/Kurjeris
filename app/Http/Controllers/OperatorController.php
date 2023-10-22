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

    public function showClients() {
        $clients = User::all();
        return view("operator.show-clients", compact('clients'));
    }
    public function showPackages()
    {
        $cityId = City::where('user_id', Auth::user()->id)->first()->id;

        $packages = Package::where('city_id', $cityId)
            ->with(['city', 'user']) // Eager load the 'city' and 'user' relationships
            ->get();

        return view("operator.show-all-packages", compact("packages"));
    }


    public function createClient()
    {
        return view("operator.create-client");
    }

    public function showPackage($packageId) {
        $package = Package::where("id", $packageId)->first();
        $packageHistory = PackageStatus::where("package_id", $packageId)
                                        ->with(['status'])
                                        ->get();

        $nextStatus = null;
        $packageStatusId = $package->status_id;
        if($packageStatusId < 4) {
            $nextStatus = Status::where('id', $packageStatusId + 1)->first();
            // dd($nextStatus);
        }
        return view("operator.show-package", compact("package", "packageHistory","nextStatus"));
    }

    public function updateStatus()
    {
        // dd($_POST);
        $packageId = request()->input('packageId');
        $statusId = request()->input('statusId');

        DB::beginTransaction();
        try {
            // $package = Package::find($packageId);
            Package::where('id', $packageId)->update(['status_id'=> $statusId]);
        } catch (\Exception $e) {
            dd('package updaete faile');
            DB::rollBack();
            return back()->withErrors(['status' => 'nepavyko pakeisti statuso']);
        }
        try {
            // dd($statusId);
            // dd($packageId + $statusId);
            PackageStatus::create(['package_id' => $packageId, 'status_id'=>$statusId]);

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

    public function storeUser(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']); // Hash the password
        $data['user_role'] = '1';

        try {
            $user = User::create($data);
        } catch (\Exception $e) {
            // dd($e);
            return back()
                ->withErrors(['name' => 'Toks klientas jau sukurtas'])
                ->withInput();
        }


        return redirect()->route('operator.show-clients');
    }



}
