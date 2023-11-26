<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Street;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/getStreets/{id}', function($id) {
    // $streets = City::where('id', $id)->(['street']);
    $streets = Street::where('city_id', $id)->get(['id','name']);
    // dd($streets);
    echo json_encode($streets);
});

Route::prefix("admin")->middleware(['auth', 'role:3'])->group(function () {
    Route::get("/op", [AdminController::class, "showOperators"])->name("admin.show-operators");
    Route::get("/op/kurti", [AdminController::class, "createOperator"])->name("admin.create-operator");
    Route::post("/operatorius/kurti", [AdminController::class, "storeOperator"])->name("admin.store-operator");
    Route::get("operator", [AdminController::class, "showOperators"])->name("admin.show-operators");
    Route::get("vykdomos-siuntos", [AdminController::class, "showActivePackages"])->name("admin.show-active-packages");
    Route::get("siunto-trukmes", [AdminController::class, "showDurations"])->name("admin.show-durations");
});

Route::prefix("operatorius")->middleware(['auth', 'role:2'])->group(function () {
    Route::get("/klientai", [OperatorController::class, "showClients"])->name("operator.show-clients");
    Route::get("/kurti-klienta", [OperatorController::class, "createClient"])->name("operator.create-client");
    Route::post("/saugoti-klienta", [OperatorController::class, "storeUser"])->name("operator.store-client");

    Route::get("/siunta/{id}", [OperatorController::class, "showPackage"])->name("operator.show-package");
    Route::post("/atnaujinti-statusa", [OperatorController::class, "updateStatus"])->name("operator.update-status");
    Route::get("/siuntos", [OperatorController::class, "showPackages"])->name("operator.show-all-packages");

});

Route::prefix("klientas")->middleware(['auth', 'role:1'])->group(function () {
    Route::get("/siuntos/{id}", [ClientController::class, "showPackage"])->name("client.show-package");
    Route::get("/siuntos", [ClientController::class, "showAllPackages"])->name("client.show-all-packages");
    Route::get("/kurti-siunta", [ClientController::class, "createPackage"])->name("client.create-package");
    Route::post("/saugoti-siunta", [ClientController::class, "storePackage"])->name("client.store-package");
});


Route::get('/', function () {
    return view('home');
});

Route::get('prisijungti', [UserController::class, "login"])->name("user.login");
Route::post('prisijungti', [UserController::class, "authLogin"])->name("user.login-auth");
Route::post('/atsijungti', [UserController::class, 'logout'])->name('user.logout');

// Route::get('/successful/{id}', function($id) {return "successful role: " . $id;})->name("successful");


// require __DIR__ . '/auth.php';
