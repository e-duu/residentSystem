<?php

use App\Http\Controllers\ComerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DieController;
use App\Http\Controllers\FamilyCardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MoveController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashbaord');

Route::prefix('/resident')->group(function () {
    Route::get('/all', [ResidentController::class, 'index'])->name('resident.index');
    Route::post('/create', [ResidentController::class, 'store'])->name('resident.store');
    Route::get('/create', [ResidentController::class, 'create'])->name('resident.create');
    Route::get('/show/{id}', [ResidentController::class, 'show'])->name('resident.show');
    Route::get('/edit/{id}', [ResidentController::class, 'edit'])->name('resident.edit');
    Route::post('/update/{id}', [ResidentController::class, 'update'])->name('resident.update');
    Route::delete('/delete/{id}', [ResidentController::class, 'destroy'])->name('resident.delete');
    Route::post('file-import-resident', [ResidentController::class, 'fileImport'])->name('file-import-resident');
    Route::get('file-export-resident', [ResidentController::class, 'fileExport'])->name('file-export-resident');
    Route::get('template-resident', [ResidentController::class, 'template'])->name('template-resident');
    Route::get('reset', [ResidentController::class, 'filterreset'])->name('resident.reset');
});

Route::prefix('/family-card')->group(function () {
    Route::get('/all', [FamilyCardController::class, 'index'])->name('family-card.index');
    Route::post('/create', [FamilyCardController::class, 'store'])->name('family-card.store');
    Route::get('/create', [FamilyCardController::class, 'create'])->name('family-card.create');
    Route::get('/show/{id}', [FamilyCardController::class, 'show'])->name('family-card.show');
    Route::get('/edit/{id}', [FamilyCardController::class, 'edit'])->name('family-card.edit');
    Route::post('/update/{id}', [FamilyCardController::class, 'update'])->name('family-card.update');
    Route::delete('/delete/{id}', [FamilyCardController::class, 'destroy'])->name('family-card.delete');
    Route::post('file-import-family', [FamilyCardController::class, 'fileImport'])->name('file-import-family');
    Route::get('file-export-family', [FamilyCardController::class, 'fileExport'])->name('file-export-family');
    Route::get('template-family-card', [FamilyCardController::class, 'template'])->name('template-family');
    Route::get('reset', [FamilyCardController::class, 'filterreset'])->name('family-card.reset');
});

Route::prefix('/member')->group(function () {
    Route::post('/create', [MemberController::class, 'store'])->name('member.store');
    Route::get('/create/{id}', [MemberController::class, 'create'])->name('member.create');
    Route::get('/show/{id}', [MemberController::class, 'show'])->name('member.show');
    Route::get('/edit/{id}', [MemberController::class, 'edit'])->name('member.edit');
    Route::post('/update/{id}', [MemberController::class, 'update'])->name('member.update');
    Route::delete('/delete/{id}', [MemberController::class, 'destroy'])->name('member.delete');
    Route::post('file-import-member', [MemberController::class, 'fileImport'])->name('file-import-member');
    Route::get('file-export-member', [MemberController::class, 'fileExport'])->name('file-export-member');
    Route::get('template-member', [MemberController::class, 'template'])->name('template-member');
    Route::get('reset', [MemberController::class, 'filterreset'])->name('member.reset');
});

Route::prefix('/comer')->group(function () {
    Route::get('/all', [ComerController::class, 'index'])->name('comer.index');
    Route::post('/create', [ComerController::class, 'store'])->name('comer.store');
    Route::get('/create', [ComerController::class, 'create'])->name('comer.create');
    Route::get('/show/{id}', [ComerController::class, 'show'])->name('comer.show');
    Route::get('/edit/{id}', [ComerController::class, 'edit'])->name('comer.edit');
    Route::post('/update/{id}', [ComerController::class, 'update'])->name('comer.update');
    Route::delete('/delete/{id}', [ComerController::class, 'destroy'])->name('comer.delete');
    Route::post('file-import-comer', [ComerController::class, 'fileImport'])->name('file-import-comer');
    Route::get('file-export-comer', [ComerController::class, 'fileExport'])->name('file-export-comer');
    Route::get('template-comer', [ComerController::class, 'template'])->name('template-comer');
    Route::get('reset', [ComerController::class, 'filterreset'])->name('comer.reset');
});

Route::prefix('/move')->group(function () {
    Route::get('/all', [MoveController::class, 'index'])->name('move.index');
    Route::post('/create', [MoveController::class, 'store'])->name('move.store');
    Route::get('/create', [MoveController::class, 'create'])->name('move.create');
    Route::get('/show/{id}', [MoveCardController::class, 'show'])->name('move.show');
    Route::get('/edit/{id}', [MoveController::class, 'edit'])->name('move.edit');
    Route::post('/update/{id}', [MoveController::class, 'update'])->name('move.update');
    Route::delete('/delete/{id}', [MoveController::class, 'destroy'])->name('move.delete');
    Route::post('file-import-move', [MoveController::class, 'fileImport'])->name('file-import-move');
    Route::get('file-export-move', [MoveController::class, 'fileExport'])->name('file-export-move');
    Route::get('template-move', [MoveController::class, 'template'])->name('template-move');
    Route::get('reset', [MoveController::class, 'filterreset'])->name('move.reset');
});

Route::prefix('/die')->group(function () {
    Route::get('/all', [DieController::class, 'index'])->name('die.index');
    Route::post('/create', [DieController::class, 'store'])->name('die.store');
    Route::get('/create', [DieController::class, 'create'])->name('die.create');
    Route::get('/show/{id}', [DieCardController::class, 'show'])->name('die.show');
    Route::get('/edit/{id}', [DieController::class, 'edit'])->name('die.edit');
    Route::post('/update/{id}', [DieController::class, 'update'])->name('die.update');
    Route::delete('/delete/{id}', [DieController::class, 'destroy'])->name('die.delete');
    Route::post('file-import-die', [DieController::class, 'fileImport'])->name('file-import-die');
    Route::get('file-export-die', [DieController::class, 'fileExport'])->name('file-export-die');
    Route::get('template-die', [DieController::class, 'template'])->name('template-die');
    Route::get('reset', [DieController::class, 'filterreset'])->name('die.reset');
});

