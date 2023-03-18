<?php
include_once "includes/loginCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mise à jour du salaire d'un employé</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="m-3">Mettre à jour le salaire d'un employé</h1>
    <form class="form m-3" method="POST" action="updateSalary.php">
        <div class="form-group">
            <label for="id" class="form-label">ID de l'employé</label>
            <input type="number" id="id" class="form-control" name="id" required <?php if (isset($_GET["id"])) { echo "value='".$_GET["id"]."'"; } ?>>
        </div>
        <div class="form-group">
            <label for="salary" class="form-label">Nouveau salaire</label>
            <input type="number" min="0" required id="salary" class="form-control" name="salary">
        </div>
        <input type="submit" value="Mettre à jour" class="btn btn-primary mt-3">
    </form>
</body>
</html>