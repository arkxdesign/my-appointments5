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

              <div class="nav-wrapper">
                  <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0 active" href="#old-appointments"  id="tabs-icons-text-1-tab" data-toggle="tab" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Historial de citas</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0" href="#confirmed-appointments" id="tabs-icons-text-2-tab" data-toggle="tab"  role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Mis próximas citas</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0" href="#pending-appointments" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Citas por confirmar</a>
                      </li>
                  </ul>
              </div>

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
