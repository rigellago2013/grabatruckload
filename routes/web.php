<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\LoadsController;
use App\Http\Controllers\MovementsController;
use App\Http\Controllers\TrucksController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::get('/test', function (\Illuminate\Http\Request $request) {
    $request->session()->flash('flash.banner', 'Yay it works!');
    $request->session()->flash('flash.bannerStyle', 'success');
    return redirect(route('dashboard'));
});

Route::get('/debug-sentry', function () {
    throw new \Exception('My first Sentry error!');
});

// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('loads', LoadsController::class);
    Route::resource('trucks', TrucksController::class);
    Route::post('loads/{load}/transition/{state}', [LoadsController::class, 'transition'])->name('loads.transition');
    Route::get('loads/{load}/pickup-details', [LoadsController::class, 'pickupDetails'])->name('loads.update-pickup-details');
    Route::get('loads/{load}/delivery-details', [LoadsController::class, 'deliveryDetails'])->name('loads.update-delivery-details');
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::resource('movements', MovementsController::class);
    Route::resource('links', LinksController::class);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
// });

Route::get('/routes')->name('routes');

Route::get('samples/{template}', function ($template) {
    auth()->login(\App\Models\User::first());

    return view("samples.$template");
});
