function retornoVal(param){
	var valores = [];
	$.each(param, function(key, val){
		valores.push(val);
	});
	
	return valores;
}

/*********************************** GRÁFICO DE LINHAS - SEM DADOS ***********************************/

/*$(function () {
    var ctx, data, myLineChart, options;
    Chart.defaults.global.responsive = true;
    ctx = $('#idSemDados').get(0).getContext('2d');
    ctx.canvas.height = 80;
    options = {
        showScale: true,
        scaleShowGridLines: false,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 0,
        scaleShowHorizontalLines: false,
        scaleShowVerticalLines: true,
        bezierCurve: false,
        bezierCurveTension: 0.4,
        pointDot: false,
        pointDotRadius: 0,
        pointDotStrokeWidth: 2,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 4,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
    };

    data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(34, 167, 240,0.2)",
                strokeColor: "#22A7F0",
                pointColor: "#22A7F0",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "#22A7F0",
                data: [65, 59, 80, 81, 56, 55, 40]
            }
        ]
    };
    myLineChart = new Chart(ctx).Line(data, options);
});*/

/*********************************** GRÁFICO DE LINHAS - POR HORA***********************************/

$(function () {
    var ctx, data, myLineChart, options;
    Chart.defaults.global.responsive = true;
    ctx = $('#idHorarios').get(0).getContext('2d');
    ctx.canvas.height = 75;
    options = {
        showScale: true,
        scaleShowGridLines: false,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 0,
        scaleShowHorizontalLines: false,
        scaleShowVerticalLines: true,
        bezierCurve: false,
        bezierCurveTension: 0.4,
        pointDot: false,
        pointDotRadius: 0,
        pointDotStrokeWidth: 2,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 4,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
    };

    var periodo = '-3 days';
    $.getJSON("relatorios/trafegoPorHora/" + periodo, function(resposta){
    
	    data = {
	        labels: Object.keys(resposta),
	        datasets: [
	            {
	                label: "My First dataset",
	                fillColor: "rgba(34, 167, 240,0.2)",
	                strokeColor: "#22A7F0",
	                pointColor: "#22A7F0",
	                pointStrokeColor: "#fff",
	                pointHighlightFill: "#fff",
	                pointHighlightStroke: "#22A7F0",
	                data: retornoVal(resposta)
	            }
	        ]
	    };
	    
	    myLineChart = new Chart(ctx).Line(data, options);
	    
    });
});

/*********************************** GRÁFICO DE BARRAS - SEMANAL ***********************************/
$(function () {
    var ctx, data, myBarChart, option_bars;
    Chart.defaults.global.responsive = true;
    ctx = $('#idSemanal').get(0).getContext('2d');
    ctx.canvas.height = 75;
    option_bars = {
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: false,
        barShowStroke: true,
        barStrokeWidth: 1,
        barValueSpacing: 5,
        barDatasetSpacing: 3,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
    };
    
    $.getJSON("relatorios/trafegoSemanal/", function(resposta){
  
	    data = {
	        labels: Object.keys(resposta),
	        datasets: [
	            {
	                label: "My First dataset",
	                fillColor: "rgba(26, 188, 156,0.6)",
	                strokeColor: "#1ABC9C",
	                pointColor: "#1ABC9C",
	                pointStrokeColor: "#fff",
	                pointHighlightFill: "#fff",
	                pointHighlightStroke: "#1ABC9C",
	                data: retornoVal(resposta)
	            }
	        ]
	    };
	    
	    myBarChart = new Chart(ctx).Bar(data, option_bars);
	    
    });
});

/*********************************** GRÁFICO EM PIZZA - PLATAFORMA ***********************************/
$(function () {
    var ctx, data, myPieChart, options;
    Chart.defaults.global.responsive = true;
    ctx = $('#idPlataforma').get(0).getContext('2d');
    ctx.canvas.height = 80;
    options = {
        showScale: false,
        scaleShowGridLines: false,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 0,
        scaleShowHorizontalLines: false,
        scaleShowVerticalLines: false,
        bezierCurve: false,
        bezierCurveTension: 0.4,
        pointDot: false,
        pointDotRadius: 0,
        pointDotStrokeWidth: 2,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 4,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    
    $.getJSON("relatorios/trafegoPlataforma/", function(resposta){
    	
    	data = resposta;
    		
    	var myPieChart = new Chart(ctx).Pie(data, options);
    
    });
    
});

/*********************************** GRÁFICO EM PIZZA - PLATAFORMA ***********************************/
$(function () {
    var ctx, data, myPieChart, options;
    Chart.defaults.global.responsive = true;
    ctx = $('#idPlataforma').get(0).getContext('2d');
    ctx.canvas.height = 80;
    options = {
        showScale: false,
        scaleShowGridLines: false,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 0,
        scaleShowHorizontalLines: false,
        scaleShowVerticalLines: false,
        bezierCurve: false,
        bezierCurveTension: 0.4,
        pointDot: false,
        pointDotRadius: 0,
        pointDotStrokeWidth: 2,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 4,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    
    $.getJSON("relatorios/trafegoPlataforma/", function(resposta){
    	
    	data = resposta;
    		
    	var myPieChart = new Chart(ctx).Pie(data, options);
    
    });
    
});


/*********************************** GRÁFICO EM PIZZA - NAVEGADOR ***********************************/
$(function () {
    var ctx, data, myPieChart, options;
    Chart.defaults.global.responsive = true;
    ctx = $('#idNavegador').get(0).getContext('2d');
    ctx.canvas.height = 80;
    options = {
        showScale: false,
        scaleShowGridLines: false,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 0,
        scaleShowHorizontalLines: false,
        scaleShowVerticalLines: false,
        bezierCurve: false,
        bezierCurveTension: 0.4,
        pointDot: false,
        pointDotRadius: 0,
        pointDotStrokeWidth: 2,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 4,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    
    var periodo = '-90 days';
    $.getJSON("relatorios/trafegoNavegador/", function(resposta){
   	//$.getJSON("relatorios/trafegoNavegador/" + periodo, function(resposta){	
    	data = resposta;
    		
    	var myPieChart = new Chart(ctx).Doughnut(data, options);
    
    });
    
});

/*********************************** GRÁFICO DE BARRAS - MENSAL ***********************************/
$(function () {
    var ctx, data, myBarChart, option_bars;
    Chart.defaults.global.responsive = true;
    ctx = $('#idMensal').get(0).getContext('2d');
    ctx.canvas.height = 45;
    option_bars = {
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: false,
        barShowStroke: true,
        barStrokeWidth: 1,
        barValueSpacing: 5,
        barDatasetSpacing: 3,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
    };
    
    var periodo = '-90 days';
    $.getJSON("relatorios/trafegoMensal/", function(resposta){
   	//$.getJSON("relatorios/trafegoMensal/" + periodo, function(resposta){

   		data = {
	        labels: Object.keys(resposta),
	        datasets: [
	            {
	                label: "My First dataset",
	                fillColor: "rgba(26, 188, 156,0.6)",
	                strokeColor: "#1ABC9C",
	                pointColor: "#1ABC9C",
	                pointStrokeColor: "#fff",
	                pointHighlightFill: "#fff",
	                pointHighlightStroke: "#1ABC9C",
	                data: retornoVal(resposta)
	            }
	        ]
	    };
	    
	    myBarChart = new Chart(ctx).Bar(data, option_bars);
	    
    });
});