@extends('layouts.panel')

@section('content')
        <div class="card">
          <div class="col-md-12 mb-1">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Reporte: Frecuencia de citas</h3>
                </div>
                
              </div>
            </div>

            <div class="card">
              <div class="card-body">
            
                <div id="container"></div>
            
            </div>
            </div>

            <div class="card">
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                 <thead class="thead-light">
                  <tr>
                    <th>Mes</th>
                    <th>Registradas</th>
                    <th>Confirmadas</th>
                    <th>Atendidas</th>
                    <th>Canceladas</th>
                    </tr>
                  </thead>
                 <tbody>
                  <tr>
                   
                  <td>
                    <table>@foreach ( $meses as $mes )<tr><td>{{ $mes }}</td></tr>@endforeach</table>
                  
                  </td>  
                  
                   
                  <td>
                    <table>@foreach ( $counts as $count )<tr><td>{{ $count }}</td></tr>@endforeach</table>
                   
                  </td>
                  
                  
                  <td>
                    <table>@foreach ( $confirmed as $confirm )<tr><td>{{ $confirm }}</td></tr>@endforeach</table>
                   
                  </td>
                  
                  
                  <td>
                    <table>@foreach ( $attended as $attendes )<tr><td>{{ $attendes }}</td></tr>@endforeach</table>
                   
                  </td>
                  
                  
                  <td>
                    <table>@foreach ( $cancelled as $cancells )<tr><td>{{ $cancells }} </td></tr>@endforeach</table>
                  
                  </td>
                                                     
 
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
       
        </div>
        </div>
     <div class="chart"></div>
  
  
@endsection

@section('scripts')
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script>
  Highcharts.chart('container', {
      chart: {
          type: 'line'
      },
      title: {
          text: 'Citas registradas mensualmente'
      },
      xAxis: {
          categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
      },
      yAxis: {
          title: {
              text: 'Cantidad de citas'
          }
      },
      plotOptions: {
          line: {
              dataLabels: {
                  enabled: true
              },
              enableMouseTracking: true
          }
      },
      series: [{
          name: 'Registradas',
          data: @json($counts)
    },{
          name: 'Confirmadas',
          data: @json($confirmed)
      },{
          name: 'Atendidas',
          data: @json($attended)
      },{
          name: 'Canceladas',
          data: @json($cancelled)
      }, 

      {{-- {
          name: 'Citas canceladas',
          data: @json($cancells)
      } --}}
      ]
  });
  </script>
@endsection
