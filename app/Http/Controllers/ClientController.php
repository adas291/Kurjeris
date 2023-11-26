<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\City;
use App\Models\Package;
use App\Models\PackageStatus;
use Auth;
use DB;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function showAllPackages()
    {
        $userId = Auth::user()->id;
        $packages = Package::where("user_id", $userId)->get();
        $message = session('message'); // Retrieve the message from the session
        return view("client.show-all", compact("packages", "message"));
    }

    public function showPackage($id)
    {
        $packages = DB::select(" SELECT
                        p.id,
                        p.receiver_name,
                        p.receiver_address,
                        u.name as 'sender',
                        c.name as 'city',
                        p.street as 'street',
                        s.name as 'status'
                FROM `package_statuses` ps
                JOIN statuses s ON s.id = ps.status_id
                JOIN packages p ON ps.package_id = p.id
                JOIN cities c ON c.id = p.city_id
                JOIN users u ON u.id = p.user_id
                WHERE ps.time = (SELECT MAX(time)
                FROM package_statuses WHERE ps.package_id = :id);", [$id]);

        return view("client.show-all", compact("packages"));
    }

    public function createPackage()
    {
        // $sender = "1";
        $cities = City::all();
        return view("client.create-package", compact("cities"));
    }

    public function storePackage(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            "receiver_address" => "required",
            "receiver_name" => "required",
            "city_id" => "required",
            "weight" => "required|numeric|gt:0",
            "street_id" => "required"
        ]);

        // $data['sender_id'] = auth()->user()->id;
        $data['user_id'] = Auth::user()->id;
        try {
            $result = Package::create($data);
            PackageStatus::create(["status_id" => '1', "package_id" => $result->id]);
        } catch (\Exception $e) {
            dd($e);
        }

        return redirect()->route("client.show-all-packages")->with("message", "Siunta sukurta sėkmingai");
    }

}
