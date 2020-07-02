@extends('layouts.panel')
@section('content')
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Registrar nueva cita</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('patients')}}" class="btn btn-sm btn-primary">Cancelar y volver</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects form -->
              <div class="card-body">

              @if(session('notification'))
              <div class="alert alert-success" role="alert">
                <strong>{{ session('notification') }}</strong> 
              </div>
              @endif

                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </div>
                @endif
              <form action="{{ url('appointments') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="speciality">Especilidad</label>
                    <select name="speciality_id" id="speciality" class="form-control" required>
                      <option value="">Seleccionar especialidad</option>
                      @foreach ($specialities as $speciality)
                        <option value="{{ $speciality->id}} " @if(old('speciality_id') == $speciality->id) selected @endif>{{ $speciality->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="email">Médicos</label>
                    <select name="doctor_id" id="doctor" class="form-control" required>
                       @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id}} " @if(old('doctor_id') == $doctor->id) selected @endif>{{ $doctor->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="dni">Fecha</label>
                  <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                          </div>
                          <input class="form-control datepicker" placeholder="Seleccionar fecha"
                          id="date" name="scheduled_date" type="text" 
                          value="{{ old('scheduled_date'), date('Y-m-d') }}" 
                          data-date-format="yyyy-mm-dd" 
                          data-date-start-date="{{ date('Y-m-d') }}" 
                          data-date-end-date="+30d">
                      </div>
                  </div>
                </div>              
                <div class="form-group">
                  <label for="address">Hora de atención</label> 
                  <div id="hours">
                    <div id="hours">
                      @if ($intervals)
                        @foreach ($intervals['morning'] as $key => $interval)
                          <div class="custom-control custom-radio mb-3">
                            <input name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input" id="intervalMorning{{ $key }}" type="radio" required>
                            <label class="custom-control-label" for="intervalMorning{{ $key }}"> {{ $interval['start'] }} - {{ $interval['end'] }} </label>
                          </div>
                        @endforeach
                        @foreach ($intervals['afternoon'] as $key => $interval)
                          <div class="custom-control custom-radio mb-3">
                            <input name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input" id="intervalAfternoon{{ $key }}" type="radio" required>
                            <label class="custom-control-label" for="intervalAfternoon{{ $key }}"> {{ $interval['start'] }} - {{ $interval['end'] }} </label>
                          </div>
                        @endforeach
                      @else
                        <div class="alert alert-primary" role="alert">
                          Selecciona un médico y una fecha, para ver las horas disponibles.
                        </div>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="type">Tipo de consulta</label>
                  <div class="custom-control custom-radio mb-3">
                    <input name="type" class="custom-control-input" id="type1" type="radio"
                    @if(old('type', 'Consulta') == 'Consulta') checked @endif value="Consulta">
                    <label class="custom-control-label" for="type1">Consulta</label>
                  </div>

                  
                  <div class="custom-control custom-radio mb-3">
                    <input name="type" class="custom-control-input" id="type2" type="radio"
                    @if(old('type') == 'Examen') checked @endif value="Examen">
                    <label class="custom-control-label" for="type2">Examen</label>
                  </div>

                  
                  <div class="custom-control custom-radio mb-3">
                    <input name="type" class="custom-control-input" id="type3" type="radio"
                    @if(old('type') == 'Operación') checked @endif value="Operación">
                    <label class="custom-control-label" for="type3">Operación</label>
                  </div>

                </div>
                <div class="form-group">
                  <label for="description">Observación</label>
                    <textarea name="description" id="description" type="text" class="form-control" rows="5" required>{{ old('description', 'Describe alguna observación o comentario') }}</textarea>
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-sm btn-primary">Crear</button>
                </div>   
              </div>


              </form> 
            </div>
          </div>

        <div class="col-md-12 mb-1">
              <!-- Chart -->
              <div class="chart"></div>
        </div>


         


@endsection
 
@section('scripts')
<script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('/js/appointments/create.js') }}"></script>
@endsection

