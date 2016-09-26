<?php

class Trafeco {
	private $db;
	private $ip;
	private $data;
	private $uri;
	private $user_agent;
	
	public function __construct(){
		$this->db = new PDO("mysql:host=localhost; dbname=googlecharts", "root","root");
		$this->uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT);
		//$this->ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
		$this->ip = '189.110.56.197';
		$cookie = filter_input(INPUT_COOKIE,md5($this->uri), FILTER_DEFAULT);
		$this->user_agent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');
	
		if(!$cookie){
			$this->_set_cookie();
			$this->_set_data(); //Salva os dados do cookie no BD;
		}

	}
	
	private function _set_cookie(){
		setcookie(md5($this->uri), true, time() + strtotime(date('Y-m-d 23:59:59')));
	}
	
	private function _set_data(){
		$this->data['data'] = date('Y-m-d H:i:s');
		$this->data['pagina'] = $this->uri;
		$this->data['ip'] = $this->ip;
	
		//Os dados de País, Região, Cidade etc... serão coletados através da API (ip-api.com) em formato JSON
		$geolocalizacao = json_decode(file_get_contents("http://ip-api.com/json/{$this->ip}"));

		
		$this->data['cidade'] = (isset($geolocalizacao->city)) ? $geolocalizacao->city : 'Desconhecida';
		$this->data['regiao'] = (isset($geolocalizacao->regionName)) ? $geolocalizacao->regionName : 'Desconhecida';
		$this->data['pais'] = (isset($geolocalizacao->country)) ? $geolocalizacao->country : 'Desconhecido';
		$this->data['navegador'] = $this->_get_navegador();
		$this->data['referencia'] = $this->_get_referencia();
		$this->data['plataforma'] = $this->_get_plataforma();
		
		$this->_salvar_dados();
	}
	
	private function _get_navegador(){
		include 'config/navegadores.php';
	
		foreach ($browsers as $key => $value){
			if(preg_match('|' . $key . '.*?([0-9\.]+)|i', $this->user_agent)){
				return $value;
			}
		}
	}

	private function _get_plataforma(){
		include 'config/plataformas.php';
	
		foreach ($platforms as $key => $value){
			if(preg_match('|' . preg_quote($key) . '|i', $this->user_agent)){
				return $value;
			}
		}
	}
	
	private function _get_referencia(){
		$refencia = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_VALIDATE_URL);
		$hostRefencia = parse_url($refencia, PHP_URL_HOST);
		$hostServer = filter_input(INPUT_SERVER, 'SERVER_NAME');
		
		//Se não tiver dados da variável $referencia é porque o usuário digitou o nome da página direto na url
		if (!$refencia){
			$retorno = 'Acesso Direto pela URL';
		}elseif($hostRefencia == $hostServer){
			$retorno = 'Navegação Interna';
		}else{
			$retorno = $refencia;
		}
		
		return $retorno;
	}
	
	private function _salvar_dados(){
		$sqlInsert = " INSERT INTO trafego ( data,  pagina,  ip,  cidade,  regiao,  pais,  navegador,  referencia,  plataforma) "
				   . "				VALUES(:data, :pagina, :ip, :cidade, :regiao, :pais, :navegador, :referencia, :plataforma) ";
		$query = $this->db->prepare($sqlInsert);
		$query->execute($this->data);
	}
}