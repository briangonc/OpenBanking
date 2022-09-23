<?php

//Aqui eu faço a leitura da API disponibilizada
$url = 'https://data.directory.openbankingbrasil.org.br/participants';

$response = file_get_contents($url);

$response = json_decode($response, 1);

// Página que será aberta no Browser
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Dados OpenBanking </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- bootstrap5 dataTables css cdn -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/staterestore/1.1.1/css/stateRestore.bootstrap5.min.css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="card mt-5 mb-5">
                <div class="card-header text-center">
                    <h5 class="card-title">
                        Cadastros Open Banking
                    </h5>
                </div>
                <div class="card-body">
                    <table id="tabela" class="table table-striped nowrap" style="width:100%">
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