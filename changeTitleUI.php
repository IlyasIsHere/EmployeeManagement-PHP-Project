<?php
include_once "includes/loginCheck.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Changer le titre d'un employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="m-3">Changer le titre d'un employé</h1>
    <form class="form m-3" method="POST" action="changeTitle.php">
        <div class="form-group mt-4">
            <label for="id" class="form-label">ID de l'employé</label>
            <input type="number" id="id" class="form-control" name="id" required <?php if (isset($_GET["id"])) { echo "value='".$_GET["id"]."'"; } ?>>
        </div>
        <div class="form-group mt-3">
            <label for="titre" class="form-label">Nouveau titre</label>
            <input type="text" required id="titre" class="form-control" name="titre">
        </div>
        <input type="submit" value="Changer" class="btn btn-primary mt-3">
    </form>

    <?php
    if (isset($_GET["success"])) {
        $suc = $_GET["success"];
        if ($suc == "true") { ?>
    <div class="text-white bg-success m-3 p-3">Succès. Le titre a été mis à jour.</div>
        <?php }
        elseif ($suc == "false1") { ?>
    <div class="text-white bg-danger m-3 p-3">Erreur. Il n'y a pas d'employé avec cet ID.</div>
    <?php }
        elseif ($suc == "false2") { ?>
    <div class="text-white bg-danger m-3 p-3">Erreur.</div>
        <?php }
    }
    ?>

</body>
</html>