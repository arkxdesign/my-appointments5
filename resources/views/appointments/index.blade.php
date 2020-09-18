@extends('layouts.panel')

@section('content')
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                 <h3 class="mb-0">Citas</h3>
                </div>
              </div>
            </div>

            <div class="card-body">
              @if(session('notification'))
              <div class="alert alert-success" role="alert">
                <strong>{{ session('notification') }}</strong> 
              </div>
              @endif
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active"  data-toggle="tab" href="#old-appointments" role="tab" >Historial de citas</a>
                  <a class="nav-item nav-link" data-toggle="tab" href="#confirmed-appointments" role="tab" aria-controls="nav-home" aria-selected="true">Mis próximas citas</a>
                  <a class="nav-item nav-link"  data-toggle="tab" href="#pending-appointments" role="tab" >Citas por confirmar</a>
                </div>
              </nav>

              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="old-appointments" role="tabpanel" aria-labelledby="nav-home-tab">
                  @include('appointments.tables.old')
                </div>
                <div class="tab-pane fade" id="confirmed-appointments" role="tabpanel" aria-labelledby="nav-profile-tab">
                  @include('appointments.tables.confirmed')
                </div>
                <div class="tab-pane fade" id="pending-appointments" role="tabpanel" aria-labelledby="nav-profile-tab">
                  @include('appointments.tables.pending')
                </div>
              </div>
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
