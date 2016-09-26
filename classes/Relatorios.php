
<?php
	new Relatorios();
	
	class Relatorios{
		private $db;
		private $dataAtual;

###################################Construtor __construct()###################################		
		public function __construct(){
			
	 		$opcao = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET LC_TIME_NAMES = 'pt_BR'");
			$this->db = new PDO('mysql:host=localhost; dbname=googlecharts; charset=utf8', 'root','root', $opcao);
			
			$this->dataAtual = date('Y-m-d H:i:s');
			$uri = urldecode(filter_input(INPUT_SERVER, 'REQUEST_URI'));
			$request = explode('/', $uri);
			$metodo = $request[3];
			$parametro = $request[4];
			
			if(method_exists(get_class(), $metodo)){
				$this->$metodo($parametro);
			}else{
				return FALSE;
			}
		}

###################################function trafegoPorHora###################################
	 	public function trafegoPorHora($parametro = NULL){
	 		
	 		//$periodo = date('Y-m-d H:i:s', strtotime('-2 days', strtotime($this->dataAtual)));
	 		$periodo = date('Y-m-d H:i:s', strtotime($parametro));
		
	 		$sql = "SELECT HOUR(data) as horas, COUNT(id) as visitas "
	 				. " FROM trafego"
	 				. " WHERE data >= '{$periodo}' "
	 				. " GROUP BY horas ";
			$query = $this->db->query($sql);
			$resultado = $query->fetchAll(PDO::FETCH_OBJ);
			
			foreach ($resultado as $resultados){
				$dados[$resultados->horas] = $resultados->visitas;
			}
			
			//Array contendo todas as horas de um dia para mostrar no gráfico;
			$horas = array();
			for($i = 0; $i < 24; $i++):
				array_push($horas, '0');
			endfor;
			
			//Pega os índices de cada hora gerada no array anterior inserindo a qtde de visitas em cada hora;
			$final = array_replace($horas, $dados);
			
			//O tipo de dados utilizado para comunicar o PHP com o Javascript é o json;
			echo json_encode($final);
	 	}

###################################function trafegoSemanal###################################	 	
	 	public function trafegoSemanal(){
	 		
	 		$periodo = date('Y-m-d H:i:s', strtotime($param));
	 		//$periodo = date('Y-m-d H:i:s', strtotime('-7 days'));
	 		$sql = "SELECT DAYNAME(data) as diasDaSemana, COUNT(id) as visitas "
					." FROM trafego	"
					." WHERE data >= '{$periodo}' "
					." GROUP BY diasDaSemana "
					." ORDER BY data DESC ";
			$query = $this->db->query($sql);
			$resultado = $query->fetchAll(PDO::FETCH_OBJ);
			
			foreach ($resultado as $resultados){
				$dados[$resultados->diasDaSemana] = $resultados->visitas;
			}
			
			echo json_encode($dados);
	 	}
	 	
###################################function trafegoMensal###################################	 	
	 	public function trafegoMensal(){
	 		
	 		$mesAtual = date('m');
	 		$ano = date('Y');
	 		
	 		$sql = "SELECT DAY(data) as dias, COUNT(id) as visitas "
	 				." FROM trafego	"
	 				." WHERE MONTH(data) = '{$mesAtual}' "
	 				."   AND YEAR(data) = '{$ano}' "
	 				." GROUP BY dias ";
			$query = $this->db->query($sql);
			$resultado = $query->fetchAll(PDO::FETCH_OBJ);
			
			//Array que retorna os dados do BD
	 		foreach ($resultado as $resultados){
				$dados[$resultados->dias] = $resultados->visitas;
			}
			
			//Array que retorna todos os dias do mês
			$diasDoMes = $this->_dia_do_mes();
			
			$final = array_replace($diasDoMes, $dados);
			
			echo json_encode($final);
	 	}

###################################function trafegoNavegador###################################
	 	public function trafegoNavegador($param = NULL){
	 			
	 		$periodo = date('Y-m-d H:i:s', strtotime($param));
	 		//$periodo = date('Y-m-d H:i:s', strtotime('-7 days'));
	 		$sql = "SELECT navegador, COUNT(id) as visitas "
	 				." FROM trafego "
	 				." WHERE data >= '{$periodo}' "
	 				." GROUP BY navegador "
					." ORDER BY visitas DESC "
					." LIMIT 6";
			$query = $this->db->query($sql);
	 		$resultado = $query->fetchAll(PDO::FETCH_OBJ);
	 	
		 	//As seis possíveis cores que irão aparecer no gráfico
		 	$cores = array(0 => '#ff8000', 1 => '#FA2A00', 2 => '#1ABC9C', 3 => '#FABE28', 4 => '#353D47', 5 => '#00bfff');
		 	
		 	$i = 0;
		 	//Array multdirecional para preenchimento das propriedades do gráfico pizza
		 	//data = [{label, value, color}]
		 	foreach ($resultado  as $resultados){
			 	$dados[$i]['label'] = $resultados->navegador;
			 	$dados[$i]['value'] = $resultados->visitas;
			 	$dados[$i]['color'] = $cores[$i];
			 	$i++;
		 	}
		 	
		 	echo json_encode($dados);
	 	}	

###################################function trafegoPlataforma###################################
	 	public function trafegoPlataforma($param = NULL){
	 		
	 		$periodo = date('Y-m-d H:i:s', strtotime($param));
	 		//$periodo = date('Y-m-d H:i:s', strtotime('-7 days'));
	 		$sql = "SELECT plataforma, COUNT(id) as visitas "
					." FROM trafego "
					." WHERE data >= '{$periodo}' "
					." GROUP BY plataforma "
					." ORDER BY visitas DESC "
					." LIMIT 6";
			$query = $this->db->query($sql);
			$resultado = $query->fetchAll(PDO::FETCH_OBJ);
			
			//As seis possíveis cores que irão aparecer no gráfico
			$cores = array(0 => '#ff8000', 1 => '#FA2A00', 2 => '#1ABC9C', 3 => '#FABE28', 4 => '#353D47', 5 => '#00bfff');
			
			$i = 0;
			//Array multdirecional para preenchimento das propriedades do gráfico pizza
			//data = [{label, value, color}]
			foreach ($resultado  as $resultados){
				$dados[$i]['label'] = $resultados->plataforma;
				$dados[$i]['value'] = $resultados->visitas;
				$dados[$i]['color'] = $cores[$i];
				$i++;
			}
			
			echo json_encode($dados);
	 	}

	 	###################################Método trafecoPagina###################################
	 	public function trafegoPagina($param){
	 		$periodo = date('Y-m-d H:i:s', strtotime($param));
	 	
	 		$sql = "SELECT pagina, COUNT(id) as visitas "
	 				."FROM  trafego "
	 				."WHERE data >= '{$periodo}' "
	 				."GROUP BY pagina "
	 				."ORDER BY visitas DESC";
	 		$query = $this->db->query($sql);
	 		$resultado = $query->fetchAll(PDO::FETCH_OBJ);

	 		foreach ($resultado as $resultados){
	 			$dados[$resultados->pagina] = $resultados->visitas;
	 		}
	 		
	 		echo json_encode($dados);
	 	}	 	
	 	
###################################function _dia_do_mes###################################	 	
	 	private function _dia_do_mes(){
	 		
	 		$diaAtual = date('d');
	 		
	 		if($diaAtual <= 10){
	 			$mesAtual = 10;
	 		}elseif($diaAtual <= 15){
	 			$mesAtual = 15;
	 		}if($diaAtual <= 20){
	 			$mesAtual = 20;
	 		}if($diaAtual <= 25){
	 			$mesAtual = 25;
	 		}else{
	 			$mesAtual = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
	 		}
	 		
	 		$dias = array(1 => '0');
	 		for($i = 1; $i < $mesAtual; $i++):
	 			array_push($dias, '0');
	 		endfor;
	 		
	 		return $dias;
	 	}
	}

?>