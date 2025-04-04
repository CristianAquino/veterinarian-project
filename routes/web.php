<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BillItemController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\AlertMiddleware;
use App\Http\Middleware\AppointmentMiddleware;
use App\Http\Middleware\BillItemMiddleware;
use App\Http\Middleware\BillMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\InventoryMiddleware;
use App\Http\Middleware\MedicalRecordMiddleware;
use App\Http\Middleware\MedicationMiddleware;
use App\Http\Middleware\OwnerMiddleware;
use App\Http\Middleware\PetMiddleware;
use App\Http\Middleware\PrescriptionMiddleware;
use App\Http\Middleware\ServiceMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// employees
Route::resource('employees', EmployeeController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(EmployeeMiddleware::class)->group(function () {
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::put('employees/{employee}', [EmployeeController::class, 'update']);
});
Route::get('employees/appointments', [AppointmentController::class, 'show']);
// owners
Route::resource('owners', OwnerController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(OwnerMiddleware::class)->group(function () {
    Route::post('owners', [OwnerController::class, 'store']);
    Route::put('owners/{owner}', [OwnerController::class, 'update']);
});
// appointments
Route::resource('appointments', AppointmentController::class)
    ->only(['index', 'destroy']);
Route::middleware(AppointmentMiddleware::class)->group(function () {
    Route::post('appointments', [AppointmentController::class, 'store']);
    Route::put('appointments/{appointment}', [AppointmentController::class, 'update']);
});
// service
Route::resource('services', ServiceController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(ServiceMiddleware::class)->group(function () {
    Route::post('services', [ServiceController::class, 'store']);
    Route::put('services/{service}', [ServiceController::class, 'update']);
});
// pets
Route::resource('pets', PetController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(PetMiddleware::class)->group(function () {
    Route::post('pets', [PetController::class, 'store']);
    Route::put('pets/{pet}', [PetController::class, 'update']);
});
// medical records
Route::resource('medicalRecords', MedicalRecordController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(MedicalRecordMiddleware::class)->group(function () {
    Route::post('medicalRecords', [MedicalRecordController::class, 'store']);
    Route::put('medicalRecords/{medicalRecord}', [MedicalRecordController::class, 'update']);
});
// prescriptions
Route::resource('prescriptions', PrescriptionController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(PrescriptionMiddleware::class)->group(function () {
    Route::post('prescriptions', [PrescriptionController::class, 'store']);
    Route::put('prescriptions/{prescription}', [PrescriptionController::class, 'update']);
});
// inventories
Route::resource('inventories', InventoryController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(InventoryMiddleware::class)->group(function () {
    Route::post('inventories', [InventoryController::class, 'store']);
    Route::put('inventories/{inventory}', [InventoryController::class, 'update']);
});
// medications
Route::resource('medications', MedicationController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(MedicationMiddleware::class)->group(function () {
    Route::post('medications', [MedicationController::class, 'store']);
    Route::put('medications/{medication}', [MedicationController::class, 'update']);
});
// alerts
Route::resource('alerts', AlertController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(AlertMiddleware::class)->group(function () {
    Route::post('alerts', [AlertController::class, 'store']);
    Route::put('alerts/{alert}', [AlertController::class, 'update']);
});
// bills
Route::resource('bills', BillController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(BillMiddleware::class)->group(function () {
    Route::post('bills', [BillController::class, 'store']);
    Route::put('bills/{bill}', [BillController::class, 'update']);
});
// billItems
Route::resource('billItems', BillItemController::class)
    ->only(['index', 'show', 'destroy']);
Route::middleware(BillItemMiddleware::class)->group(function () {
    Route::post('billItems', [BillItemController::class, 'store']);
    Route::put('billItems/{billItem}', [BillItemController::class, 'update']);
});
require __DIR__ . '/auth.php';