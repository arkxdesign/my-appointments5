@extends('layouts.panel')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Nuevo médico</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('doctors')}}" class="btn btn-sm btn-primary">Cancelar y volver</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects form -->
              <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </div>
                @endif
              <form action="{{ url('doctors')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                </div>
                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input type="text" name="email" class="form-control" value="{{ old('email') }}" />
                </div>
                 <div class="form-group">
                  <label for="dni">DNI</label>
                  <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" />
                </div>              
                <div class="form-group">
                  <label for="address">Dirección</label>
                  <input type="text" name="address" class="form-control" value="{{ old('address') }}" />
                </div>
                <div class="form-group">
                  <label for="phone">Movil</label>
                  <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" />
                </div>              
                <div class="form-group">
                  <label for="phone2">Teléfono</label>
                  <input type="text" name="phone2" class="form-control" value="{{ old('phone2') }}" />
                </div>                            
                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input type="text" name="password" class="form-control" value="{{ old('password') }}"/> 
                  <p>"teclea los utimos 4 digitos del numero de celular"</p>
                </div>
                <div class="form-group">
                  <label for="specialities">Especialidades</label>
                  <select name="specialities[]" id="specialities" class="form-control selectpicker" data-style="btn-outline-primary" multiple title="Seleccione una o varias especialidades">
                    @foreach ($specialities as $speciality)
                      <option value="{{ $speciality->id}}">{{ $speciality->name }}</option>
                    @endforeach
                  </select>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection