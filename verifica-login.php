<?php
	//session_start();
	//Não é necessário definir session_start(); pois ele já está setado no arquivo verifica-session.php


	//Verificação de session no momento do login (quando os campos "email" e "senha" são enviados pelo form)
    if(isset($_POST['user']) && isset($_POST['pass'])){
		
        $user = htmlspecialchars($_POST['user']);
        $senha = htmlspecialchars($_POST['pass']);
		
        //Função responsável por ir ao banco de dados conferir se os dados estão ok.
		$dados = $acoes->login($user);
		
        //Primeiro ele tento aqui, viu que não tinha e rachou fora.
		if(!empty($dados['id']) && $dados['id'] > 0){
			
            //Aqui ele confere se a senha inserida ( variável $senha ) é igual a senha do banco de dados
			if(password_verify($senha, $dados['pass'])){

                //Aqui, caso o login e a senha estejam corretos, ele vai armazenar estes dados na sessão, através da variável $_SESSION.
				$_SESSION['id'] = $dados['id'];
                $_SESSION['user'] = $dados['user'];
				
				//Aqui ele direciona para a página testbrian.
                echo "<script>location.href='./resultadoapi.php'</script>";
					
				
                
            }else{
                //Erro de senha incorreta.
				if(isset($_SESSION['id'])){
					unset($_SESSION['id']);
				}

				if(isset($_SESSION['user'])){
					unset($_SESSION['user']);
				}
		
                echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Email ou senha incorretos!</p></div>';
            }
        }else{
            //Erro de usuário inexistente.
			if(isset($_SESSION['id'])){
				unset($_SESSION['id']);
			}

			if(isset($_SESSION['user'])){
				unset($_SESSION['user']);
			}
    		//Caiu nessa condição aqui por que não encontrou nenhum usuario com aqueles dados que eu coloquei !
            echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Email não cadastrado.</p></div>';
        }
    }
