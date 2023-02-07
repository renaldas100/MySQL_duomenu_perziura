<?php

require_once 'duomenu_baze.php';

if(isset($_POST['add'])){

    if(isset($_POST['salary']) && $_POST['salary']!=""){
        $salary=$_POST['salary']*100;
    } else{
        $salary=NULL;
    }

    $stm = $db->prepare("INSERT INTO employees (name, surname, gender, phone, birthday, education, salary) VALUES (?,?,?,?,?,?,?)");
    $stm->execute([$_POST['name'],$_POST['surname'],$_POST['gender'],$_POST['phone'],$_POST['birthday'],$_POST['education'],$salary]);
    header("location: index.php");
    die();
}

$stm = $db->prepare("SELECT * FROM projects");
$stm->execute([]);
$projects=$stm->fetchAll(PDO::FETCH_ASSOC);




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
        <div class="col-md-12 my-4">
            <div class="card">
                <div class="card-header">
                    <h4>Pridėti naują darbuotoją</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="new.php">
                        <div class="mb-3">
                            <label class="form-label">Vardas</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pavardė</label>
                            <input type="text" class="form-control" name="surname">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lytis</label>
                            <select name="gender">
                                <option value="Vyras">Vyras</option>
                                <option value="Moteris">Moteris</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefonas</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gimimo data</label>
                            <input type="date" class="form-control" name="birthday">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Išsilavinimas</label>
                            <textarea class="form-control" name="education"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Atlyginimas "ant popieriaus"</label>
                            <input type="text" class="form-control" name="salary">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Priskyrimas projektams:</label><br>
                            <?php foreach ($projects as $project) { ?>
                                <input id="<?= $project['id'] ?>" type="checkbox" name="<?= $project['name'] ?>" value="<?= $project['id'] ?>">
                                <label><?= $project['name'] ?></label> <br>
                           <?php } ?>


                        </div>
                        <button class="btn btn-success" name="add" value="1">Pridėti darbuotoją</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>

