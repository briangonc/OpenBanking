<?php

class Acoes{

	private $bd;

	public function __construct($banco_de_dados) {
		
	    $this->bd = $banco_de_dados;
	}
		
	
	//Essa é a função responsável para ir até o banco de dados ver se o usuário existe.
	public function login($user){


	    $query 	= $this->bd->prepare("SELECT * FROM usuarios WHERE user = :user LIMIT 1");
		$query->bindValue(':user', $user, PDO::PARAM_STR);
	    
		try{
			$query->execute();
		}
		
		catch(PDOException $e){
			die($e->getMessage());
		}
		
		return $query->fetch();
		
	}
	
	
	
	
	//Funçao responsável pelo cadastro
	public function cadastrar_user($user, $pass){


	    $query 	= $this->bd->prepare("INSERT INTO usuarios (
		user, 
		pass
		) 
		
		VALUES (
		:user, 
		:pass
		)"
		);

		$query->bindValue(':user', $user, PDO::PARAM_STR);
		$query->bindValue(':pass', $pass, PDO::PARAM_STR);

	    
		try{
			$query->execute();
			//RETORNAR SUCESSO
			return true;
		}
		
		catch(PDOException $e){
			die($e->getMessage());
		}

		
	}
	
	
}


$acoes = new Acoes($bd);