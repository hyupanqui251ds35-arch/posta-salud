@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
    <hgroup>
        <h1>Panel de Atención · Posta de Salud NUEVA VIDA</h1>
        <p>Resumen operativo del día ({{ now()->format('d/m/Y') }}) · Base conectada: <strong>{{ DB::connection()->getDatabaseName() }}</strong></p>
    </hgroup>

    {{-- Tarjetas KPI (RF19) --}}
    <div class="grid">
        <article style="border-top: 4px solid #0369a1;">
            <small style="color: #475569; font-weight: 600;">PACIENTES REGISTRADOS</small>
            <h2 style="margin: 0.35rem 0; color: #0c4a6e;">{{ $totalPacientes }}</h2>
            <a href="{{ route('pacientes.index') }}">Ver padrón de pacientes &rarr;</a>
        </article>

        <article style="border-top: 4px solid #15803d;">
            <small style="color: #475569; font-weight: 600;">PERSONAL MÉDICO ACTIVO</small>
            <h2 style="margin: 0.35rem 0; color: #166534;">{{ $medicosActivos }}</h2>
            <a href="{{ route('personal-medico.index') }}">Gestionar profesionales &rarr;</a>
        </article>

        <article style="border-top: 4px solid #0284c7;">
            <small style="color: #475569; font-weight: 600;">CITAS PROGRAMADAS HOY</small>
            <h2 style="margin: 0.35rem 0; color: #0369a1;">{{ $citasHoy }}</h2>
            <small style="color: #64748b;">Turnos de 30 min (RN02)</small>
        </article>
    </div>

    {{-- Accesos rápidos --}}
    <article>
        <header><strong>Accesos rápidos</strong></header>
        <div class="acciones">
            <a href="{{ route('pacientes.create') }}" role="button">+ Nuevo paciente</a>
            <a href="{{ route('personal-medico.create') }}" role="button" class="secondary">+ Nuevo profesional</a>
        </div>
    </article>

    {{-- Agenda de hoy --}}
    <h2>Próximas citas de hoy</h2>
    <table>
        <thead>
            <tr>
                <th>Hora</th>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Especialidad</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proximasCitas as $cita)
                <tr>
                    <td><strong>{{ $cita->fecha_hora->format('H:i') }}</strong></td>
                    <td>{{ $cita->paciente->apellidos }}, {{ $cita->paciente->nombres }}</td>
                    <td>{{ $cita->personalMedico->apellidos }}, {{ $cita->personalMedico->nombres }}</td>
                    <td>{{ $cita->personalMedico->especialidad }}</td>
                    <td><mark class="estado-activo">{{ ucfirst($cita->estado) }}</mark></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay citas pendientes o confirmadas para el resto del día.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection