<!DOCTYPE >
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<title>Administração</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
	</head>
	<body>
		<div class="container-fluid">
			<?php include 'includes/header.php'; ?>
			
						
			<div class="col-md-12" text-center>
				<div class="row">
					<div class="col-md-12 top text-center">
						<h1>Dashboard Tráfego de Acesso ao Sistema</h1>
					</div>
				</div>
				
				<div class="row">
<!-- 					<div class="col-md-6"> -->
<!-- 						<canvas id="idSemDados" class="chart"></canvas> -->
<!-- 					</div> -->
					
					<div class="col-md-6">
						<h6>Gráfico Horários</h6>
						<canvas id="idHorarios" class="chart"></canvas>
					</div>

					<div class="col-md-6">
						<h6>Gráfico Por Semana</h6>
						<canvas id="idSemanal" class="chart"></canvas>
 					</div>
					
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<h6>Gráfico Por Plataforma</h6>
						<canvas id="idPlataforma" class="chart"></canvas>
 					</div>
 					
					<div class="col-md-6">
						<h6>Gráfico Por Navegador</h6>
						<canvas id="idNavegador" class="chart"></canvas>
 					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<h6>Gráfico Mensal</h6>
						<canvas id="idMensal" class="chart"></canvas>
 					</div>
				</div>
				
			</div>			
		</div>

		<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/Chart.min.js"></script>		
		<script type="text/javascript" src="assets/js/chart.init.js"></script>

	</body>
</html>