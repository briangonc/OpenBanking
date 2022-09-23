<?php

//Aqui eu faço a leitura da API disponibilizada
$url = 'https://data.directory.openbankingbrasil.org.br/participants';

$response = file_get_contents($url);

$response = json_decode($response, 1);

?>
<!DOCTYPE html>
<html>

<head>
    <title> Dados OpenBanking </title>
</head>

<!-- Estilização simples somente com borda para separar as colunas e campos -->
<style>
    thead, tr, th, td {
        border: 2px solid grey;
    }
</style>

<body>
    <table style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Url Configuração</th>
                <th>Cidade</th>
                <th>Logo</th>
            </tr>
        </thead>
        <tbody>

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

</body>

</html>