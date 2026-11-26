<?php

use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalMedicoController;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\PersonalMedico;

Route::get('/', function () {
    return view('inicio', [
        'totalPacientes' => Paciente::count(),
        'medicosActivos' => PersonalMedico::activos()->count(),
        'citasHoy'       => Cita::whereDate('fecha_hora', today())->count(),
        'proximasCitas'  => Cita::with(['paciente', 'personalMedico'])
            ->whereDate('fecha_hora', today())
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->orderBy('fecha_hora')
            ->take(5)
            ->get(),
    ]);
})->name('inicio');

Route::resource('pacientes', PacienteController::class);

Route::resource('personal-medico', PersonalMedicoController::class)
    ->parameters(['personal-medico' => 'personalMedico'])
    ->except(['destroy']);

Route::patch('personal-medico/{personalMedico}/estado',
    [PersonalMedicoController::class, 'cambiarEstado'])
    ->name('personal-medico.estado');