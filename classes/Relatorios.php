
<?php
new Relatorios();

class Relatorios{
	private $db;
	private $dataAtual;
	
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
	
 	public function trafegoPorHora($parametro = NULL){
 		//$periodo = date('Y-m-d H:i:s', strtotime('-2 days', strtotime($this->dataAtual)));
 		$periodo = date('Y-m-d H:i:s', strtotime($parametro, strtotime($this->dataAtual)));
	
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
}

?>