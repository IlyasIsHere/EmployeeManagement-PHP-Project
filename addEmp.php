<?php
include_once "includes/loginCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>

    <div class="m-4 w-50">
        <h1 class="mt-3">Ajouter un nouveau employé</h1>
        <form action="includes/signup.inc.php" method="POST" class="form mt-4">
            <div class="form-group mb-3">
                <label class="form-label fs-5" for="bday">Date de naissance</label>
                <input class="form-control" type="date" id="bday" name="bday" required placeholder="Birthday">
            </div>
            <div class="form-group mb-3">
                <label class="form-label fs-5" for="fname">Prénom</label>
                <input class="form-control" type="text" id="fname" name="first" required placeholder="Firstname">
            </div>
            <div class="form-group mb-3">
                <label for="lname" class="form-label fs-5">Nom</label>
                <input class="form-control" type="text" name="last" required placeholder="Lastname">
            </div>
            <div class="form-group mb-3">
                <label for="gender" class="form-label fs-5">Genre</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="homme" value="M" required>
                    <label class="form-check-label" for="homme">Homme</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="femme" value="F">
                    <label class="form-check-label" for="femme">Femme</label>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="hiredate" class="form-label fs-5">Date d'embauche</label>
                <input class="form-control" type="date" name="hiredate" required placeholder="Hire Date">
            </div>
            <div class="form-group mb-3">
                <label for="salary" class="form-label fs-5">Salary</label>
                <input class="form-control" type="number" min="0" name="salary" required placeholder="Salary">
            </div>
            <div class="form-group mb-3">
                <label for="dep" class="form-label fs-5">Department</label>
                <?php
                include_once "includes/dbh.inc.php";
                $departName = "SELECT * FROM departments";
                $result = mysqli_query($conn, $departName);
                echo "<select name = 'dep' class='form-select'>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value =\"".$row['dept_no']."\">".$row['dept_name']."</option>";
                }
                echo "</select>";

                ?>
            </div>

            <button type="submit" class="btn btn-primary fs-5" name="submit">Ajouter</button>
        </form>
    </div>


    <?php
    if (isset($_GET["success"])) {
        if ($_GET["success"] == "false") { ?>
    <div class="bg-danger text-white fs-3 m-3 p-3">Erreur</div>
        <?php }
        else { ?>
    <div class="bg-success text-white fs-3 m-3 p-3">Employé ajouté avec succès.</div>
    <?php
        }
    }
    ?>

</body>
</html>