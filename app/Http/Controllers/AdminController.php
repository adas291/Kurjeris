<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\Package;
use App\Models\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use App\Models\Operator;

class AdminController extends Controller
{
    public function index()
    {
        $operators = Operator::all();
        view('admin.index', compact('operators'));

    }


    public function createOperator()
    {
        return view('admin.create-operator');
    }

    public function showOperators()
    {

        $operators = DB::select('SELECT user_id as id, u.name as name, c.name as city FROM cities c
                                JOIN users u on u.id = c.user_id');

        // $operators = City::select('users.user_id', 'cities.name')
        //     ->join('users', 'users.id', '=', 'cities.user_id')
        //     ->get();

        return view('admin.manage-operators', compact('operators'));
    }

    public function storeOperator(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validate([
                'name' => 'required',
                'city' => 'required',
                'password' => 'required',
                'email' => 'required',
            ]);

            $data['user_role'] = '2';
            $data['password'] = Hash::make($data['password']); // Hash the password
            $newUser = User::create($data);
            // return redirect()->route('admin.show-operators');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->withInput()->withErrors(['name' => 'Vartotojo vardas uzimtas']);
        }
        try {

            City::create([
                'name' => strtolower($data['city']),
                'user_id' => $newUser->id
            ]);
            DB::commit();
            return redirect(route('admin.show-operators'))->with('success', 'Operatorius sukurtas sėkmingai');

        } catch (\Exception $e) {

            // dd($e->getMessage());
            DB::rollBack();
            return back()->withInput()->withErrors(['city' => 'Miestas jau turi savo operatoriu']);
        }
    }

    public function showActivePackages()
    {
        $packages = Package::where('status_id', '<', 5)
                        ->with('status', 'user', 'city')->get();

        $message = 'cia yra statuso zinute';
        return view('admin.show-active-packages', compact(['packages','message']));
    }

    public function showDurations()
    {
        $packages = DB::select(" SELECT TIMESTAMPDIFF(SEcond,
                        (SELECT MIN(ps.time) FROM package_statuses ps WHERE package_id = p.id),
                        (SELECT MAX(ps.time) FROM package_statuses ps WHERE package_id = p.id)) as duration,
                        u.name as 'client_name',
                        c.name as 'city',
                        p.id as 'package_id'
                    FROM packages p
                    JOIN users u on u.id = p.user_id
                    JOIN cities c on c.id = p.city_id");

        return view('admin.show-delivered-packages', compact(['packages']));
    }

}
