// Bars chart
//

$(function () {

	var $chart = $('#chart-barsP');
		function initChart($chart) {

		// Create chart
		var ordersChart = new Chart($chart, {
			type: 'bar',
			data: {
				labels: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
				datasets: [{
					label: 'Citas médicas',
					data: appointmentsByDayP
				}]
			}
		});

		// Save to jQuery object
		$chart.data('chart', ordersChart);

	}

		if ($chart.length)
		initChart($chart);
});