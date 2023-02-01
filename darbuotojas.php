<?php

require_once 'duomenu_baze.php';

$id=$_GET['id'];
$stm = $db->prepare("SELECT * FROM employees WHERE id=?");
$stm->execute([$id]);
$darbuotojas = $stm->fetch(PDO::FETCH_ASSOC);


$NPD=540-(0.34*(($darbuotojas['salary'] / 100) -840));
$GPM=($darbuotojas['salary'] / 100)*0.2;
$PSD=($darbuotojas['salary'] / 100)*0.0698;
$VSD=($darbuotojas['salary'] / 100)*0.1252;
$sodra=($darbuotojas['salary'] / 100)*0.0177;
$garantinis=($darbuotojas['salary'] / 100)*0.002;

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
   <a class="btn btn-success text-decoration-none mt-2" href="javascript:history.go(-1)" title="Grįžti atgal">« Grįžti atgal</a>
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                    <h4>Darbuotojo suvestinė</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Tabelio Nr. (id)</th>
                            <th>Vardas</th>
                            <th>Pavardė</th>
                            <th>Lytis</th>
                            <th>Telefono numeris</th>
                            <th>Gimimo data</th>
                            <th>Išsilavinimas</th>
                            <th>Atlyginimas<br>"ant popieriaus"</th>
                        </tr>
                            <tr>
                                <td><?= $darbuotojas['id'] ?></td>
                                <td><?= $darbuotojas['name'] ?></td>
                                <td><?= $darbuotojas['surname'] ?></td>
                                <td><?= $darbuotojas['gender'] ?></td>
                                <td><?= $darbuotojas['phone'] ?></td>
                                <td><?= $darbuotojas['birthday'] ?></td>
                                <td><?= $darbuotojas['education'] ?></td>
                                <td><?= $darbuotojas['salary']/100 ?></td>
                            </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 my-5">
            <div class="card">
                <div class="card-header">
                    <h4>Darbo vietos sąnaudos</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>NPD:</td>
                            <td><?= $NPD  ?></td>
                        </tr>
                        <tr>
                            <td>Pajamų mok. 20%:</td>
                            <td><?= $GPM ?></td>
                        </tr>
                        <tr>
                            <td>Sveikatos draudimas 6.98%:</td>
                            <td><?= $PSD ?></td>
                        </tr>
                        <tr>
                            <td>Soc. draudimas 12.52%:</td>
                            <td><?= $VSD ?></td>
                        </tr>
                        <tr>
                            <td><b>Į rankas:</b></td>
                            <td><b><?= ($darbuotojas['salary']/100)-$GPM-$PSD-$VSD ?></b></td>
                        </tr>
                        <tr>
                            <td>Darbdavio sąnaudos</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Sodra 1.77%:</td>
                            <td><?= $sodra ?></td>
                        </tr>
                        <tr>
                            <td>Garantinis fondas 0.02%:</td>
                            <td><?= $garantinis ?></td>
                        </tr>
                        <tr>
                            <td><b>Visi mokesčiai:</b></td>
                            <td><b><?= ($darbuotojas['salary']/100)+$sodra+$garantinis ?></b></td>
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

