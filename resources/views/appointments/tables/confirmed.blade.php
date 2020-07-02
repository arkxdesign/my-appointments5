            
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush" >
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Especialidad</th>
                    @if ($role == 'patient' || $role == 'admin')
                    <th scope="col">Médico</th>
                    @endif
                    @if ($role == 'doctor' || $role == 'admin')
                    <th scope="col">Paciente</th>
                    @endif
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($confirmedAppointments as $appointment)
                  <tr>
                    <th scope="row">
                      {{ $appointment->speciality->name }}
                    </th>
                    
                    @if ($role == 'patient' || $role == 'admin')
                    <td>
                      {{ $appointment->doctor->name }}
                    </td>  
                    @endif

                    @if ($role == 'doctor' || $role == 'admin')
                    <td>
                      {{ $appointment->patient->name }}  
                    </td>
                    @endif
                    <td>
                      {{ $appointment->scheduled_date }}
                    </td>
                    <td>
                      {{ $appointment->scheduled_time_12 }}
                    </td>
                    <td>
                      {{ $appointment->type }}
                    </td>
                    <td>
                      @if ($role == 'admin')  
                       <a class="btn btn-sm btn-primary" href="{{ url('/appointments/'.$appointment->id) }}"  data-toggle="tooltip" data-placement="top" title="Ver detalle de la cita">
                        <i class="ni ni-zoom-split-in"></i>
                       </a>
                      @endif     
                        <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Cancelar cita"
                         href="{{ url('/appointments/'.$appointment->id.'/cancel') }}">
                        <i class="ni ni-fat-delete"></i>
                        </a>  


                      
                    </td>
                  </tr>
                  <tr><td class="thead-light" >Observaciones: </td>
                  <td colspan="6"><div style="white-space:nowrap; overflow:hidden; text-overflow: ellipsis; width:400px;"> {{ $appointment->description }}</div> </td>

                  </tr>

                  @endforeach
                  
                </tbody>
              </table>
            </div>
          
            <div class="card-body"> 
               {{ $confirmedAppointments->links() }}
            </div>