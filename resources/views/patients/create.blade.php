@extends('layouts.panel')

@section('content')
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Nuevo paciente</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('patients')}}" class="btn btn-sm btn-primary">Cancelar y volver</a>
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
              <form action="{{ url('patients')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}" required/>
                </div>
                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input type="text" name="email" class="form-control" value="{{ old('email') }}" required/>
                </div>
                 <div class="form-group">
                  <label for="dni">DNI</label>
                  <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" required/>
                </div>              
                <div class="form-group">
                  <label for="address">Dirección</label>
                  <input type="text" name="address" class="form-control" value="{{ old('address') }}" required/>
                </div>
                <div class="form-group">
                  <label for="phone">Movil</label>
                  <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required/>
                </div>              
                <div class="form-group">
                  <label for="phone2">Telefono</label>
                  <input type="text" name="phone2" class="form-control" value="{{ old('phone2') }}" required/>
                </div>                            
                 <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input type="text" name="password" class="form-control" value=""/> 
                  <p>"teclea los utimos 4 digitos del numero de celular"</p>
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
