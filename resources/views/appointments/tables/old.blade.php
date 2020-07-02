            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Cita #</th>
                    <th scope="col">Doctor</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Fecha Cita</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha de Estado</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($oldAppointments as $appointment)
                  <tr>
                    <td>
                      {{ $appointment->id}}
                    </td>
                    <th scope="row">
                      {{ $appointment->doctor->name }}
                    </th>
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
                      {{ $appointment->status }}
                    </td>
                    <td>
                      {{ $appointment->updated_at->format('Y-m-d') }} - {{ $appointment->updated_at->format('g:i A') }}
                    </td>
                    <td>
                      <a href="{{ url('/appointments/'.$appointment->id) }}" class="btn btn-sm btn-primary">
                        Ver +
                      </a>
                    </td>
                  </tr>

                  @endforeach
                  
                </tbody>
              </table>
            </div>

            <div class="card-body"> 
               {{ $oldAppointments->links() }}
            </div>