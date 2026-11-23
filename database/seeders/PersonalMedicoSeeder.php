<?php

namespace Database\Seeders;

use App\Models\PersonalMedico;
use App\Models\User;
use Illuminate\Database\Seeder;

class PersonalMedicoSeeder extends Seeder
{
    public function run(): void
    {
        $usuario = User::where('email', 'medico@posta.test')->first();
        PersonalMedico::factory()->create([
            'user_id'      => $usuario->id,
            'nombres'      => 'Rosa',
            'apellidos'    => 'Huamán Quispe',
            'especialidad' => 'Medicina general',
        ]);

        PersonalMedico::factory()->count(4)->create();
        PersonalMedico::factory()->inactivo()->create();
    }
}
