<?php
include_once "includes/dbh.inc.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $titre = mysqli_real_escape_string($conn, $_POST["titre"]);
    $curr_date = date("Y-m-d");

    $query_check = "SELECT * FROM titles WHERE emp_no = '$id' AND to_date = '9999-01-01' AND from_date = '$curr_date'";
    $result = mysqli_query($conn, $query_check);
    $id_check = "SELECT * FROM titles WHERE emp_no='$id';";
    $res_id = mysqli_query($conn, $id_check);

    if ($res_id->num_rows > 0) {
        if ($result->num_rows == 0) {
            $query = "UPDATE titles SET to_date = '$curr_date' WHERE emp_no = '$id' AND to_date = '9999-01-01'; INSERT INTO titles (emp_no, title, from_date, to_date) VALUES ('$id', '$titre', '$curr_date', '9999-01-01');";
        } else {
            $query = "UPDATE titles SET title = '$titre' WHERE emp_no = '$id' AND to_date = '9999-01-01';";
        }

        $success = mysqli_multi_query($conn, $query);
        if ($success) {
            header("Location: changeTitleUI.php?success=true");
            exit();
        } else {
            header("Location: changeTitleUI.php?success=false2");
            exit();
        }
    } else {
        header("Location: changeTitleUI.php?success=false1");
        exit();
    }
}

