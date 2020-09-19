@extends('layouts.panel')
@section('content')

           <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                 <h3 class="mb-0">Buscar citas por folio</h3>
                </div>
              </div>
            </div>

            <div class="card-body">
              @if(session('notification'))
              <div class="alert alert-success" role="alert">
                <strong>{{ session('notification') }}</strong> 
              </div>
              @endif

            <div class="table-responsive">
                          
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Cita #</th>
                    <th scope="col">Doctor</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Fecha Cita</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                @if (count($searchId))
                  @foreach ($searchId as $appointment)
                  <tr>
                    <td>
                      <div class="text-blue">
                      {{ $appointment->id}}
                    </div>
                    </td>
                    <th scope="row">
                      {{ $appointment->doctor->name }}
                    </th>
                    <td>
                      {{ $appointment->patient->name }}
                    </td>
                    <td>
                      {{ $appointment->speciality->name }}
                    </td>
                    <td>
                      {{ $appointment->scheduled_date }}
                    </td>
                    <td>
                      {{ $appointment->scheduled_time_12 }}
                    </td>
                    <td>
                        @if  ($appointment->status == 'Cancelada')
                          <div class="text-danger">
                          {{ $appointment->status }}
                          </div>
                        @else  
                          <div class="text-success">
                          {{ $appointment->status }}
                          </div>  
                       @endif

                    </td>
                    <td>
                      <a href="{{ url('/appointments/'.$appointment->id) }}" class="btn btn-sm btn-primary">
                        Ver +
                      </a>
                    </td>
                  </tr>

                  @endforeach
                @endif
                  
                </tbody>
              </table>
            </div>

            <div class="card-body"> 
   
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

