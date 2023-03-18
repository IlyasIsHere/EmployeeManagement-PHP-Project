<?php
    include_once "includes/loginCheck.php";
    include_once "includes/dbh.inc.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styleoptions.css">
</head>
<body>
    <form method="get" action="index.php">
        <div class="purple">
            <input type="submit" class="btn btn-outline-info disconnect" name="disconnect" value="Se déconnecter">
            <h1 class="center">Gestion des employés</h1>
        </div>
    </form>
    <?php
        $id = $_SESSION["USER_ID"];
        //user name
        $sql1 = "SELECT first_name, last_name FROM employees WHERE emp_no = '$id';";
        $result = mysqli_query($conn, $sql1);
        $user_row = mysqli_fetch_assoc($result);
        $user_name = $user_row['first_name'] . " ". $user_row['last_name'];
        //department
        $sql2 = "SELECT dept_no FROM dept_emp WHERE emp_no = '$id';";
        $result1 = mysqli_query($conn, $sql2);
        $dep_row = mysqli_fetch_assoc($result1);
        $dep = $dep_row['dept_no'];
        //department name
        $sql3 = "SELECT * FROM departments WHERE dept_no = '$dep'";   
        $result2 = mysqli_query($conn, $sql3);
        $dep_name_row = mysqli_fetch_assoc($result2);
        $dep_name = $dep_name_row['dept_name'];
        ?>
        <div class="profile">
            <div class="img">
                <img src="user.png">
            </div>
            <div class="info2">
                <h5>NAME :<?php echo $user_name ?></h5>
                <h5> Department: <?php echo $dep_name ?></h5>
            </div>
        </div>
    <div class="container options">
        <a href="addEmp.php" class="purple row">Ajouter un employé</a>
        <a href="updateSalaryUI.php" class="purple row">Mettre à jour le salaire d'un employé</a>
        <a href="changeTitleUI.php" class="purple row">Changer le titre d'un employé</a>
        <a href="updateDepUI.php" class="purple row">Changer le département d'un employé</a>
    </div>

    <div class="container">
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php
            $emps = mysqli_query($conn, "SELECT emp_no, first_name, last_name FROM employees LIMIT 100;");
            while ($row = mysqli_fetch_assoc($emps)) {
                echo "<tr>";
                echo "<td>".$row["emp_no"]."</td>";
                echo "<td>".$row["first_name"]."</td>";
                echo "<td>".$row["last_name"]."</td>";
                echo "<td><a href='updateSalaryUI.php?id=".$row["emp_no"]."'>Mettre à jour le salaire</a></td>";
                echo "<td><a href='changeTitleUI.php?id=".$row["emp_no"]."'>Changer le titre</a></td>";
                echo "<td><a href='updateDepUI.php?id=".$row["emp_no"]."'>Affecter un autre département à cet employé</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

<!--    <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#290f84" fill-opacity="1" d="M0,32L21.8,32C43.6,32,87,32,131,53.3C174.5,75,218,117,262,154.7C305.5,192,349,224,393,202.7C436.4,181,480,107,524,74.7C567.3,43,611,53,655,64C698.2,75,742,85,785,112C829.1,139,873,181,916,202.7C960,224,1004,224,1047,213.3C1090.9,203,1135,181,1178,170.7C1221.8,160,1265,160,1309,165.3C1352.7,171,1396,181,1418,186.7L1440,192L1440,320L1418.2,320C1396.4,320,1353,320,1309,320C1265.5,320,1222,320,1178,320C1134.5,320,1091,320,1047,320C1003.6,320,960,320,916,320C872.7,320,829,320,785,320C741.8,320,698,320,655,320C610.9,320,567,320,524,320C480,320,436,320,393,320C349.1,320,305,320,262,320C218.2,320,175,320,131,320C87.3,320,44,320,22,320L0,320Z"></path></svg>-->

</body>
</html>