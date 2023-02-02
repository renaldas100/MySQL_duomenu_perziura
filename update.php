<?php

require_once 'duomenu_baze.php';

$id=$_GET['id'];
$stm = $db->prepare("SELECT * FROM employees WHERE id=?");
$stm->execute([$id]);
$darbuotojas = $stm->fetch(PDO::FETCH_ASSOC);



if(isset($_POST['update'])){
    $stm = $db->prepare("UPDATE employees SET name=?, surname=?, gender=?, phone=?, birthday=?, education=?, salary=? WHERE id=?");
    $stm->execute([$_POST['name'],$_POST['surname'],$_POST['gender'],$_POST['phone'],$_POST['birthday'],$_POST['education'],$_POST['salary']*100, $id]);
    header("location: index.php");
    die();
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
        <div class="col-md-12 my-4">
            <div class="card">
                <div class="card-header">
                    <h4>Redaguoti darbuotojo duomenis</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="update.php?id=<?= $darbuotojas['id'] ?>">
                        <div class="mb-3">
                            <label class="form-label">Vardas</label>
                            <input type="text" class="form-control" name="name" value="<?= $darbuotojas['name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pavardė</label>
                            <input type="text" class="form-control" name="surname" value="<?= $darbuotojas['surname'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lytis</label>
                            <select name="gender">
                                <option value="Vyras" <?= $darbuotojas['gender']=="Vyras"? "selected":"" ?>>Vyras</option>
                                <option value="Moteris"<?= $darbuotojas['gender']=="Moteris"? "selected":"" ?>>Moteris</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefonas</label>
                            <input type="text" class="form-control" name="phone" value="<?= $darbuotojas['phone'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gimimo data</label>
                            <input type="date" class="form-control" name="birthday" value="<?= $darbuotojas['birthday'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Išsilavinimas</label>
                            <textarea class="form-control" name="education"><?= $darbuotojas['education'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Atlyginimas "ant popieriaus"</label>
                            <input type="text" class="form-control" name="salary" value="<?= $darbuotojas['salary']/100 ?>">
                        </div>
                        <button class="btn btn-success" name="update" value="1">Redaguoti duomenis</button>
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


