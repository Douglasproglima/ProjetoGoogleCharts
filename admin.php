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
				
				<div class="row" >
					<div class="col-md-6" >
						<div class="row" >
							<div class="col-md-8">
								<h3>Páginas mais Visitadas</h3>
							</div>
							<div class="col-md-4" >
								<select class="form-control col=md-6" id="idPagesSelect">
									<option value="-24 hours" selected="selected" >Últimas 24 horas</option>
									<option value="-7 days">Últimos 7 dias</option>
									<option value="-15 days">Últimos 15 dias</option>
									<option value="-30 days">Últimos 30 dias</option>
								</select>
							</div>
						</div>
						
						<table class="table table-bordered table-striped" >
							<thead>
								<th>Cód.</th>
								<th>Páginas</th>
								<th>Visualizações</th>
							</thead>
							<tbody id="idPages">
								
							</tbody>
						</table>
					</div>
				</div>
					
				<hr />
				
				<div class="row">
					<div class="col-md-12">
						<h3>Demonstrativo</h3>
						<canvas id="idSemDados" class="chart"></canvas>
					</div>
				</div>
				
				<div class="row">					
					<div class="col-md-6">
						<h3>Visualizações Horários</h3>
						<canvas id="idHorarios" class="chart"></canvas>
					</div>

					<div class="col-md-6">
						<h3>Visualizações Por Semana</h3>
						<canvas id="idSemanal" class="chart"></canvas>
 					</div>
					
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<h3>Visualizações Por Plataforma</h3>
						<canvas id="idPlataforma" class="chart"></canvas>
 					</div>
 					
					<div class="col-md-6">
						<h3>Visualizações Por Navegador</h3>
						<canvas id="idNavegador" class="chart"></canvas>
 					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<h3>Visualizações do Mês</h3>
						<canvas id="idMensal" class="chart"></canvas>
 					</div>
				</div>
				
			</div>			
		</div>

		<script type="text/javascript" src="assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/Chart.min.js"></script>		
		<script type="text/javascript" src="assets/js/chart.init.js"></script>
		<script type="text/javascript" src="assets/js/tabelas.init.js"></script>

	</body>
</html>