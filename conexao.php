
<!-- Aqui eu fiz a configuração de comunicação com o banco de dados MySQL (xampp) -->

<?php      

    $db_type = "mysql";
    $host = "localhost";  
    $user = "root";  
    $pass = '';  
    $db = "teste_vaga";  

    try{
        $bd = new PDO($db_type.':host='.$host.';dbname='.$db,$user,$pass);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bd->exec("set names utf8");
    }
    
    catch(Exception $e){
        die('ERROR : '.$e->getMessage());
    } 
?>