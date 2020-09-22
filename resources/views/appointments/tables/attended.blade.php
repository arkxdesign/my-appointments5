@extends('layouts.panel')

@section('content')
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                 <h3 class="mb-0">Citas</h3>
                </div>
                  <div class="col text-right">
                    <a href="{{ url('appointments')}}" class="btn btn-sm btn-primary">Historial de citas</a>
                  </div>
                  <div class="col text-right">
                    <a href="{{ url('appointments/confirm')}}" class="btn btn-sm btn-primary">Mis próximas citas</a>
                  </div>
                  <div class="col text-right">
                    <a href="{{ url('appointments/pending')}}" class="btn btn-sm btn-primary">Citas por confirmar</a>
                  </div>
              </div>
            </div>

            <div class="card-body">
              @if(session('notification'))
              <div class="alert alert-success" role="alert">
                <strong>{{ session('notification') }}</strong> 
              </div>
              @endif


          @include('appointments.tables.attended')

          </div>
          <div class="card-body"> 
             
          </div>
        </div>

        <div class="col-md-12 mb-1">
              <!-- Chart -->
              <div class="chart"></div>
        </div>
  
 @endsection