<?php

require_once 'duomenu_baze.php';

if (isset($_GET['delete'])) {
    $stm = $db->prepare("DELETE FROM employees WHERE id=?");
    $stm->execute([$_GET['delete']]);
}

$result = $db->query('SELECT * FROM employees');
$darbuotojai = $result->fetchAll(PDO::FETCH_ASSOC);


$stm2 = $db->prepare("
SELECT 
COUNT(id) as darbuotoju_skaicius,
AVG(salary) as vidurkis,
MIN(salary) as min,
MAX(salary) as max

FROM employees;
");
$stm2->execute([]);
$suvestine = $stm2->fetchAll(PDO::FETCH_ASSOC);


print_r($suvestine);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<div class="container-md">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Darbuotojų sąrašas</h4>
                </div>
                <div class="card-body">
                    <a href="new.php" class="btn btn-success float-end">Įterpti naują darbuotoją</a>
                    <a href="about_projects.php" class="btn btn-success">Žiūrėti darbuotojus pagal priskirtą
                        projektą</a>
                    <table class="table">
                        <tr>
                            <th>Vardas</th>
                            <th>Pavardė</th>
                            <th>Išsilavinimas</th>
                            <th>Atlyginimas<br>"ant popieriaus"</th>
                        </tr>
                        <?php foreach ($darbuotojai as $darbuotojas) { ?>
                            <tr>
                                <td><?= $darbuotojas['name'] ?></td>
                                <td><?= $darbuotojas['surname'] ?></td>
                                <td><?= $darbuotojas['education'] ?></td>
                                <td><?= $darbuotojas['salary'] / 100 ?></td>
                                <td><a class="btn btn-success" href="darbuotojas.php?id=<?= $darbuotojas['id'] ?>">Plačiau</a>
                                </td>
                                <td><a class="btn btn-info" href="update.php?id=<?= $darbuotojas['id'] ?>">Koreguoti</a>
                                </td>
                                <td><a class="btn btn-danger"
                                       href="index.php?delete=<?= $darbuotojas['id'] ?>">Ištrinti</a></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto my-5">
            <div class="card">
                <div class="card-header">
                    <h4>Įmonės statistika</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Įmonėję dirbančių žmonių skaičius</td>
                            <td><?= $suvestine[0]['darbuotoju_skaicius'] ?> darbuotojų</td>
                        </tr>
                        <tr>
                            <td>Vidutinis darbo užmokestis</td>
                            <td><?= $suvestine[0]['vidurkis']/100 ?> EUR</td>
                        </tr>
                        <tr>
                            <td>Minimalus darbo užmokestis</td>
                            <td><?= $suvestine[0]['min']/100 ?> EUR</td>
                        </tr>
                        <tr>
                            <td>Maksimalus darbo užmokestis</td>
                            <td><?= $suvestine[0]['max']/100 ?> EUR</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>
