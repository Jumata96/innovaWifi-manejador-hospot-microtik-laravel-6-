<script> 
	var chart;
	
	function requestDatta(interface) {
		var idrouter = $("select[name=idrouter]").val();
		$.ajax({
			url: "{{url('/monitor')}}?interface="+interface+"&idrouter="+idrouter,
			datatype: "json",
			success: function(data) {
				var midata = JSON.parse(data);
				if( midata.length > 0 ) {
					var TX=parseFloat(midata[0].data);
					var RX=parseFloat(midata[1].data);
					//console.log(midata[0].data+" ::::: "+parseFloat(midata[0].data));
					var x = (new Date()).getTime(); 
					shift=chart.series[0].data.length > 19;
					console.log(shift);
					chart.series[0].addPoint([x, TX], true, shift);
					chart.series[1].addPoint([x, RX], true, shift);

					TXvar = 'Kb';
					RXvar = 'Kb';
					
					if (TX >= 1000) {
						TX2 = TX/1000;	
						TXvar = 'Mb';
					}else{
						TX2 = TX;
					}

					if (RX >= 1000) {
						RX2 = RX/1000;	
						RXvar = 'Mb';
					}else{
						RX2 = RX;
					}
					
					$("#trafico2").text(TX2.toFixed(1)+ TXvar +'/' +RX2.toFixed(1)+ RXvar);
					$("#cpu").text(midata[2]+"%");
					//$("#conexiones").text(midata[3]);
				}else{
					//document.getElementById("trafico").innerHTML="- / -";
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
			}       
		});
	}	

	$(document).ready(function() {
			Highcharts.setOptions({
				global: {
					useUTC: false
				}
			});
	

           chart = new Highcharts.Chart({
			   chart: {
				renderTo: 'container',
				animation: Highcharts.svg,
				type: 'spline',
				events: {
					load: function () {
						setInterval(function () {
							requestDatta($("select[name=interface]").val());
							console.log(requestDatta($("select[name=interface]").val()));
						}, 1100);
					}				
			}
		 },
		 title: {
			text: 'Monitor de Tráfico en Tiempo Real'
		 },
		 xAxis: {
			type: 'datetime',
				tickPixelInterval: 150,
				maxZoom: 20 * 500
		 },
		 yAxis: {
			minPadding: 0.2,
				maxPadding: 0.2,
				title: {
					text: 'Tráfico',
					margin: 80
				}
		 },
            series: [{
                name: 'TX',
                data: []
            }, {
                name: 'RX',
                data: []
            }]
	  });

	 
  });
</script>