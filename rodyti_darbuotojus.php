<?php

require_once 'duomenu_baze.php';

if(isset($_GET['pr'],$_GET['po'])){
    $pr = $_GET['pr'];
    $po = $_GET['po'];

    $stm = $db->prepare("
SELECT 
po.name as Pareigos,
em.name as vardas,
em.surname,
em.salary,
pr.name

FROM employees em

LEFT JOIN cross_reference cr ON em.id=cr.employees_id
LEFT JOIN projects pr ON cr.projects_id=pr.id
LEFT JOIN positions po ON em.positions_id=po.id

WHERE pr.id=? AND po.id=?;
");
    $stm->execute([$pr,$po]);
    $project_chose=$stm->fetchAll(PDO::FETCH_ASSOC);

}

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
                    <h4>Darbuotojai priskirti projektui pagal pareigybę :</h4>
                </div>
                <div class="card-body col-md-12">
                    <div class="row">
                        <p>Pasirinkto projekto pavadinimas: <b><?= $project_chose[0]['name'] ?></b></p>
                    </div>
                    <table class="table">
                        <tr>
                            <th>Pareigos</th>
                            <th>Vardas</th>
                            <th>Pavardė</th>
                            <th>Atlyginimas ant popieriaus</th>
                        </tr>
                        <?php foreach ($project_chose as $chosen) { ?>
                            <tr>
                                <td><?= $chosen['Pareigos'] ?></td>
                                <td><?= $chosen['vardas'] ?></td>
                                <td><?= $chosen['surname'] ?></td>
                                <td><?= $chosen['salary']/100 ?> EUR</td>
                            </tr>
                        <?php } ?>
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

