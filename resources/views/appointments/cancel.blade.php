@extends('layouts.panel')

@section('content')
        <div class="card">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                 <h3 class="mb-0">Cancelar cita</h3>
                </div>
              </div>
            </div>

            <div class="card-body">
              @if(session('notification'))
              <div class="alert alert-success" role="alert">
                <strong>{{ session('notification') }}</strong> 
              </div>
              @endif

              @if ($role == 'patient')
              <div class="mb-0">
                Recibe un cordial saludo  <strong>{{ $appointment->patient->name }}</strong>, estás a punto de cancelar tu cita reservada con el médico  <strong>{{ $appointment->doctor->name}}</strong> (especialidad  <strong>{{ $appointment->speciality->name}}</strong>) para el día <strong>{{ $appointment->scheduled_date}}</strong> a las <strong>{{ $appointment->scheduled_time_12}}</strong>.
              </div>
              @elseif ($role == 'doctor')
              <div class="mb-0">
                Estás apunto de cancelar tú cita reservada con el paciente  <strong>{{ $appointment->patient->name }}</strong>, para el día <strong>{{ $appointment->scheduled_date}}</strong> hora <strong>{{ $appointment->scheduled_time_12}}</strong>.<br/><br/>
              </div>
              @else
              <div class="mb-0">
                Estás apunto de cancelar la cita reservada: <br/>
                <strong>Cita #: </strong> {{ $appointment->id }}<br/>
                <strong>Doctor: </strong> {{ $appointment->doctor->name }}<br/>
                <strong>Paciente: </strong> {{ $appointment->patient->name }} <br/> 
                <strong>Especialidad: </strong>  {{ $appointment->speciality->name}} <br/> 
                <strong>Fecha y Hora: </strong> {{ $appointment->scheduled_date}} | {{ $appointment->scheduled_time_12}}.
              </div>
              @endif

              <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}" method="POST">
                @csrf
                <div class="form-group">
                <label for="justification">Por favor cuéntanos el motivo de la cancelación:</label>
                <textarea id="justification" name="justification" rows="3" class="form-control" required></textarea>
                </div>                
                <button class="btn btn-sm btn-danger" type="submit">Cancelar cita</button>
                <a href="{{ url('/appointments') }}" class="btn btn-sm btn-primary">
                  Conservar cita
                </a>
              </form>

            </div>

            

            </div>


          </div>


          <div class="card-body"></div>

          <div class="col-md-12 mb-1">
                <!-- Chart -->
                <div class="chart"></div>
          </div>
  
 @endsection
