<?php

include 'config.php';
include 'conexao.php';
include 'Acoes.php';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenBanking</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>


<body>

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <form class="form-signin" action="" method="post">
                    <div class="text-center mb-4">
                        <h1 class="h3 mb-3">
                            Login Admin
                        </h1>
                    </div>

                    <div class="form-label-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="user" class="form-control" placeholder="Digite o E-mail" autofocus required>
                    </div>

                    <div class="form-label-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="pass" class="form-control" placeholder="Digite sua senha" required>
                    </div>

                    <!-- Arquivo que vai ser executado após envio do form -->
                    <?php include 'verifica-login.php'; ?>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>