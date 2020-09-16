@extends('layouts.panel')
@section('content')
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Modificar datos de usuario</h3>
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
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                  {{ session('error') }}
                </div>
                @endif
                @if (session('notification'))
                <div class="alert alert-success" role="alert">
                  {{ session('notification') }}
                </div>
                @endif
              <form action="{{ url('profile') }}" method="POST">
                @csrf              
                <div class="form-group">
                  <label for="name">Nombre completo</label>
                  <input name="name" value="{{ old('name', $user->name) }}" id="name" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="phone">Número de teléfono</label>
                  <input name="phone" value="{{ old('phone', $user->phone) }}" id="phone" type="text" class="form-control" length="10" required>
                </div>
                <div class="form-group">
                  <label for="address">Dirección</label>
                  <input name="address" value="{{ old('address', $user->address) }}" id="address" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-sm btn-primary">Guardar cambios</button>
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
