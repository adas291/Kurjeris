<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
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
        return view('admin.create-simple');
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
            // dd($e->getMessage());
            return back()->withInput()->withErrors(['name' => 'Vartotojo vardas uzimtas']);
        }
        try {

            $newCity = City::create(['name' => strtolower($data['city']),
                                     'user_id' => $newUser->id]);
            DB::commit();
            return redirect(route('admin.show-operators'))->with('success','');

        } catch (\Exception $e) {

            // dd($e->getMessage());
            DB::rollBack();
            return back()->withInput()->withErrors(['city' => 'Miestas jau turi savo operatoriu']);
        }
    }

}
