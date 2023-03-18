<?php
include_once 'includes/dbh.inc.php';

session_start();
if (!isset($_SESSION["USER_ID"])) {
    header("location:index.php");
    exit();
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Employee Profile</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylemp.css">
    <title>Log in</title>
</head>
<body>
    <div class="svg">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#5000ca" fill-opacity="1" d="M0,32L21.8,42.7C43.6,53,87,75,131,69.3C174.5,64,218,32,262,48C305.5,64,349,128,393,160C436.4,192,480,192,524,176C567.3,160,611,128,655,101.3C698.2,75,742,53,785,53.3C829.1,53,873,75,916,90.7C960,107,1004,117,1047,133.3C1090.9,149,1135,171,1178,160C1221.8,149,1265,107,1309,101.3C1352.7,96,1396,128,1418,144L1440,160L1440,0L1418.2,0C1396.4,0,1353,0,1309,0C1265.5,0,1222,0,1178,0C1134.5,0,1091,0,1047,0C1003.6,0,960,0,916,0C872.7,0,829,0,785,0C741.8,0,698,0,655,0C610.9,0,567,0,524,0C480,0,436,0,393,0C349.1,0,305,0,262,0C218.2,0,175,0,131,0C87.3,0,44,0,22,0L0,0Z"></path></svg>
    </div>
    <form method="get" action="index.php">
        <input type="submit" class="btn btn-outline-info mt-2 col-1 h-20 right" name="disconnect" value="Se déconnecter">
    </form>
   </div>
   
   <div class ="profile">
        <h1>Profile</h1>
        <?php

            $id = $_SESSION["USER_ID"];
            //user name
            $sql1 = "SELECT first_name, last_name, gender FROM employees WHERE emp_no = '$id';";
            $result = mysqli_query($conn, $sql1);
            $user_row = mysqli_fetch_assoc($result);
            $gender = $user_row['gender'];
            $user_name = $user_row['first_name'] . " ". $user_row['last_name'];
            //department
            $sql2 = "SELECT dept_no FROM dept_emp WHERE emp_no = '$id' AND to_date = '9999-01-01';";
            $result1 = mysqli_query($conn, $sql2);
            $dep_row = mysqli_fetch_assoc($result1);
            $dep = $dep_row['dept_no'];
            //department name
            $sql3 = "SELECT * FROM departments WHERE dept_no = '$dep'";   
            $result2 = mysqli_query($conn, $sql3);
            $dep_name_row = mysqli_fetch_assoc($result2);
            $dep_name = $dep_name_row['dept_name'];
            //title
            $sql4 = "SELECT title FROM titles WHERE emp_no = '$id' AND to_date = '9999-01-01';";
            $result = mysqli_query($conn, $sql4);
            $title_row = mysqli_fetch_assoc($result);
            $title = $title_row['title'];
            //salary
            $sql5 = "SELECT salary FROM salaries WHERE emp_no = '$id' AND to_date = '9999-01-01';";
            $result = mysqli_query($conn, $sql5);
            $salary_row = mysqli_fetch_assoc($result);
            $salary = $salary_row['salary'];
        ?>

        <div><img src="user.png"></div>
        <div class="info">
            <h3> ID :<?php echo $id ?></h3>
            <h3>NAME :<?php echo $user_name ?></h3>
            <h3>Title :<?php echo $title ?></h3>
            <h3> Department: <?php echo $dep_name ?></h3>
            <h3>Salary :<?php echo $salary ?></h3>
        </div>

   </div>

</body>
</html>