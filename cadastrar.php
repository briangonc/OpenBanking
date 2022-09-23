<?php

//Recebendo os dados do formulário
if(isset($_POST['cadastrar'])){
    $user = htmlspecialchars($_POST['user']);
    $pass = htmlspecialchars($_POST['pass']);

    //Criptografando a senha digitada antes de enviar para o banco de dados
    $hash_password = password_hash($pass, PASSWORD_DEFAULT);

    $cadastrar = $acoes->cadastrar_user($user, $hash_password);

    header('location: resultadoapi.php?status=success');
    exit;
}

?>