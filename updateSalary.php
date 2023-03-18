<?php
include_once "includes/loginCheck.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    include_once 'includes/dbh.inc.php';

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $salary = mysqli_real_escape_string($conn, $_POST["salary"]);
    $curr_date = date("Y-m-d");

    $query_check = "SELECT * FROM salaries WHERE emp_no = '$id' AND to_date = '9999-01-01' AND from_date = '$curr_date';";
    $result = mysqli_query($conn, $query_check);

    if ($result -> num_rows == 0) {
        $query = "UPDATE salaries SET to_date = '$curr_date' WHERE emp_no = '$id' AND to_date = '9999-01-01'; INSERT INTO salaries (emp_no, salary, from_date, to_date) VALUES ('$id', '$salary', '$curr_date', '9999-01-01');";
    }
    else {
        $query = "UPDATE salaries SET salary = '$salary' WHERE emp_no = '$id' AND to_date = '9999-01-01';";
    }

    $success = mysqli_multi_query($conn, $query) && mysqli_affected_rows($conn) == 1;

    if ($success) { ?>
        <div class="text-white bg-success m-3 p-3">Succès. Le salaire a été mis à jour.</div>
    <?php
    }
    else if (mysqli_affected_rows($conn) == 0) {
        ?>
        <div class="text-white bg-danger m-3 p-3">Erreur. Il n'y a pas d'employé avec cet ID.</div>
    <?php }
    else { ?>
        <div class="text-white bg-danger m-3 p-3">Erreur.</div>
    <?php } ?>


</body>
</html>

<?php } ?>