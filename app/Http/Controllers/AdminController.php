<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\Package;
use App\Models\User;
use App\Models\Street;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use App\Models\Operator;
use Illuminate\Validation\ValidationException;

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

    // $operators = DB::select('SELECT user_id as id, u.name as name, c.name as city, c.street FROM cities c
    //                             JOIN users u on u.id = c.user_id');
    $operators = Operator::with('street')
                            ->with('city')
                            ->with('street')
                            ->get();
    // $operators = City::select('users.user_id', 'cities.name')
    //     ->join('users', 'users.id', '=', 'cities.user_id')
    //     ->get();

    return view('admin.manage-operators', compact('operators'));
  }

  public function storeOperator(Request $request)
  {
    DB::beginTransaction();
    try {
      $data = $request->validate(
        [
          'name' => 'required',
          'city' => 'required',
          'email' => 'required|email',
          'street' => 'required',
          'password' => [
            'required',
            // 'min:6',
            // 'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*])/', // Requires at least one uppercase letter and one symbol
          ],
        ],
        [
          //   'password.required' => 'is required',
          'password.min' => 'Slaptažodis turi būti bent 7 simbolių ilgio',
          'password.regex' => 'Slaptažodis gali būti sudarytas iš didžiosios raidės, ir bent 1 specialaus simbolio'
        ]
      );

      $data['user_role'] = '2';
      $data['password'] = Hash::make($data['password']); // Hash the password
      $user= User::create($data);

      // return redirect()->route('admin.show-operators');
    } catch (ValidationException $validationException) {
      // Validation failed, return back with errors
      DB::rollBack();
      return back()->withInput()->withErrors($validationException->errors());
    } catch (\Exception $e) {
      // Handle other exceptions
      DB::rollBack();
      return back()->withInput()->withErrors(['email' => 'Vartotojas su tokiu el. paštu jau užregistruotas']);
    }
    try {

      $city = City::firstOrCreate([
        'name' => strtolower($data['city']),
      ]);

      $street = Street::firstOrCreate([
        'name' => strtolower($data['street']),
        'city_id' => $city->id
      ]);

      Operator::create([
        'city_id' => $city->id,
        'user_id' => $user->id,
        'street_id' => $street->id
      ]);

      DB::commit();
      return redirect(route('admin.show-operators'))->with('success', 'Operatorius sukurtas sėkmingai');

    } catch (\Exception $e) {
      DB::rollBack();
      return back()->withInput()->withErrors(['street' => 'Šio miesto gatvė jau turi savo operatorių']);
    }
  }

  public function showActivePackages()
  {
    $packages = Package::where('status_id', '<', 4)
      ->with('status', 'user', 'city')->get();

    $message = 'cia yra statuso zinute';
    return view('admin.show-active-packages', compact(['packages', 'message']));
  }

  public function showDurations()
  {
    $packages = DB::select(" SELECT TIMESTAMPDIFF(DAY,
                        (SELECT MIN(ps.time) FROM package_statuses ps WHERE package_id = p.id),
                        (SELECT MAX(ps.time) FROM package_statuses ps WHERE package_id = p.id)) as duration,
                        u.name as 'client_name',
                        c.name as city,
                        p.id as 'package_id'
                    FROM packages p
                    JOIN users u on u.id = p.user_id
                    JOIN cities c on c.id = p.city_id
                    WHERE p.is_finished = true");

    return view('admin.show-delivered-packages', compact(['packages']));
  }

}
