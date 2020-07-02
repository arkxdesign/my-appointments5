

<div class="navbar-inner">
        {{-- Collapse --}}
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          {{-- Heading --}}
            <h6 class="navbar-heading p-0 text-muted">
              @if (auth()->user()->role == 'admin')
              <span class="docs-normal">Gestionar datos</span>
              @else
              <span class="docs-normal">Menú</span>
              @endif
            </h6>

          {{-- Nav items --}}
          <ul class="navbar-nav">
            @include('includes.panel.menu.' . auth()->user()->role)
          <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-text">Cerrar sesión</span>
              </a>
              <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
                @csrf
              </form>  
            </li>
          </ul>
           @if (auth()->user()->role == 'admin')
          {{-- Divider --}}
          <hr class="my-3">
          {{-- Heading --}}
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Reportes</span>
          </h6>
          {{-- Navigation --}}
{{-- Navigation --}}
<ul class="navbar-nav mb-md-3">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/charts/appointments/line') }}">
            <i class="ni ni-badge text-yellow"></i>
            <span class="nav-link-text">Frecuencia de citas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/charts/doctors/column') }}">
            <i class="ni ni-chart-pie-35 text-blue"></i>
            <span class="nav-link-text">Medicos más activos</span>
          </a>
        </li>

      </ul>
      @endif
    </div>
