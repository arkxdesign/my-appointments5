@extends('layouts.panel')

@section('content')
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Nueva especialidad</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('specialties')}}" class="btn btn-sm btn-primary">Cancelar y volver</a>
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
              <form action="{{ url('specialties')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="name">Especialidad</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}" required/>
                </div>
                <div class="form-group">
                  <label for="description">Descripción</label>
                  <input type="text" name="description" class="form-control" value="{{ old('description') }}" required/>
                </div>
                 <div class="form-group">
                  <label for="price">Precio</label>
                  <input type="number" name="price" class="form-control" value="{{ old('price') }}" required="" />
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
