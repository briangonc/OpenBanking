<?php
include 'config.php';
include 'conexao.php';
include 'Acoes.php';

//Aqui eu faço a leitura da API disponibilizada
$url = 'https://data.directory.openbankingbrasil.org.br/participants';

$response = file_get_contents($url);

$response = json_decode($response, 1);


//Aqui estou verificando, se a variável $_SESSION['user'] estiver vazia, a pagina não pode abrir
if (empty($_SESSION['user'])) {
    echo "<script>location.href='./index.php'</script>";
}

$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
            break;

        case 'error':
            $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
            break;
    }
}

// Página que será aberta no Browser
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="refresh" content="3600;URL='<?php $_SERVER['PHP_SELF'] ?>'"> <!-- Autenticação de 1 hora  -->
    <title> Dados OpenBanking </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- bootstrap5 dataTables css cdn -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/staterestore/1.1.1/css/stateRestore.bootstrap5.min.css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <?= $mensagem ?>
            <div class="card mt-5 mb-5">
                <div class="card-header text-center">
                    <h5 class="card-title">
                        Cadastros Open Banking
                    </h5>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Cadastrar usuario
                    </button>
                </div>

                <div class="card-body">
                    <table id="teste" class="table table-striped nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Url Configuração</th>
                                <th>Cidade</th>
                                <th>Logo</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Foreach utilizado para percorrer cada item da API , e na sequência acessar os itens necessários -->
                            <?php foreach ($response as $test) :
                                $organization = $test['AuthorisationServers']['0']['CustomerFriendlyName'];
                                $urlconfig = $test['AuthorisationServers']['0']['DeveloperPortalUri'];
                                $city = $test['City'];
                                $logo = $test['AuthorisationServers']['0']['CustomerFriendlyLogoUri'];
                            ?>
                                <tr>
                                    <td><?= $organization ?></td>
                                    <td><?= $urlconfig ?></td>
                                    <td><?= $city ?></td>
                                    <td> <img src="<?= $logo ?>" width="60px" height="60px"></td>
                                </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal para cadastro de novos usuários -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="form-signin" action="" method="post">

                        <div class="form-label-group">
                            <label for="email">Usuário</label>
                            <input type="text" name="user" class="form-control" placeholder="Digite o usuário" autofocus required>
                        </div>

                        <div class="form-label-group">
                            <label for="senha">Senha</label>
                            <input type="password" name="pass" class="form-control" placeholder="Digite sua senha" required>
                        </div>

                        <?php include 'cadastrar.php'; ?>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- bootstrap5 dataTables js cdn -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.1.1/js/dataTables.stateRestore.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.1.1/js/stateRestore.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>

<!-- Aqui eu adiciono a biblioteca DataTable na página -->
<script>
    $(document).ready(function() {
        $('#tabela').DataTable();
    });
</script>

</html>
