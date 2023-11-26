<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Http\Requests\StorePackageRequest;
use App\Models\City;
use App\Models\Package;
use App\Models\PackageStatus;
use Auth;
use DB;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function showPackage($id)
    {
        $packages = DB::select(" SELECT
                        p.id,
                        p.receiver_name,
                        p.receiver_address,
                        u.name as 'sender',
                        c.name as 'city',
                        s.name as 'status'
                FROM `package_statuses` ps
                JOIN statuses s ON s.id = ps.status_id
                JOIN packages p ON ps.package_id = p.id
                JOIN cities c ON c.id = p.city_id
                JOIN users u ON u.id = p.user_id
                WHERE ps.time = (SELECT MAX(time)
                FROM package_statuses WHERE ps.package_id = :id);", [$id]);
        return view("user.show-package", compact("packages"));
    }

    public function login() {
        return view("user.login");
    }
    public function showUserPackages()
    {
        $user_id = Auth::user()->id;
        $packages = Package::with('user', 'city')
                ->where('user_id', $user_id)
                ->get();

        return view("user.show-all", compact("packages"));
    }

    public function createPackage()
    {
        // $sender = "1";
        $cities = City::all();
        return view("user.create-package", compact("cities"));
    }

    public function storePackage(Request $request)
    {
        dd($request->all());

        // dd($data);
        // $data = $request->validate([
        //     "receiver_address" => "required",
        //     "receiver_name" => "required",
        //     "city_id" => "required",
        //     "weight" => "required|numeric"
        // ], [
        //     "receiver_address.required" => "Gavėjo adresas yra būtinas",
        //     "receiver_name.required" => "Gavėjo vardas yra būtinas",
        //     "city_id.required" => "Pasirinkite miestą",
        //     "weight.required" => "Įveskite siuntos svorį",
        //     "weight.numeric" => "Suntos svoris turi būti skaičius"
        // ]);


        $data['sender_id'] = auth()->user()->id;
        // $data['user_id'] = "1";

        $result = Package::create($data);
        PackageStatus::create(["status_id" => '1', "package_id" => $result->id]);

        return redirect()->route("user.show-all-packages")->with("message", "Siunta sukurta sėkmingai");
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function authLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user()->user_role;
            return redirect('/');
        } else {
            return redirect('/prisijungti')->withInput()->with('error', 'Klaidingas vartotojo slaptažodis arba paštas');
        }
    }
}
