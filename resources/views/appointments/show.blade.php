@extends('layouts.panel')

@section('content')

          <div class="card shadow">

            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                 
                  
                    <h2> Cita # {{ $appointment->id }}</h2>
                  
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="alert alert-secondary">
              <ul>
                <li>
                  <strong>Agendada para el:</strong> {{ $appointment->scheduled_date }} <strong>a las</strong> {{ $appointment->scheduled_time_12 }}
                </li>
                
                <li>
                  <strong>Estado:</strong> {{ $appointment->status }}
                </li>
                @if ($role == 'patient' || $role == 'admin')
                <li>
                  <strong>Médico:</strong> {{ $appointment->doctor->name }}
                </li>
                @endif
                @if ($role == 'doctor' || $role == 'admin')
                <li>
                  <strong>Paciente:</strong> {{ $appointment->patient->name }}
                </li>
                @endif
                <li>
                  <strong>Especialidad:</strong> {{ $appointment->speciality->name }}
                </li>
                <li>
                  <strong>Tipo:</strong> {{ $appointment->type }}
                </li>
                <li>
                  <strong>Observación:</strong> {{ $appointment->description }}
                </li>
                </div>
                @if ($appointment->status == 'Cancelada')
                <div class="alert alert-secondary">
                  <strong>Acerca de la cancelación:</strong>
                  <ul>
                    @if ($appointment->cancellation)
                      <li>
                        <strong>Fecha de cancelación:</strong>
                        {{ $appointment->updated_at->format('Y-m-d') }} <strong> a las </strong> {{ $appointment->updated_at->format('g:i A') }}
                      </li>
                      <li>
                        <strong>¿Quién canceló la cita?:</strong>
                        @if (auth()->id() == $appointment->cancellation->cancelled_by_id)
                          Tú
                        @else  
                        {{ $appointment->cancellation->cancelled_by->name}}
                        @endif
                      </li>
                      <li>
                        <strong>Motivo de la cancelación:</strong>
                        {{ $appointment->cancellation->justification }}
                      </li>
                      @else
                      <li><strong>Esta cita fue cancelada antes de su confirmación.</strong></li>
                    @endif

                  </ul>
                </div>
                @endif
              </ul>
              <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">
                Volver
              </a>
            
            </div>


          </div>
        <div class="card-body"> 
             
          </div>
        </div>

        <div class="col-md-12 mb-1">
              <!-- Chart -->
              <div class="chart"></div>
        </div>
  
  
 @endsection
