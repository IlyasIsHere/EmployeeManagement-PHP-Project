<?php
include_once "includes/dbh.inc.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $dept_num = mysqli_real_escape_string($conn, $_POST["dep"]);
    $curr_date = date("Y-m-d");

    $query_check = "SELECT * FROM dept_emp WHERE emp_no = '$id' AND to_date = '9999-01-01' AND from_date = '$curr_date'";
    $result = mysqli_query($conn, $query_check);

    $id_check = "SELECT * FROM dept_emp WHERE emp_no='$id';";
    $res_id = mysqli_query($conn, $id_check);
    if ($res_id->num_rows > 0) {
        if ($result->num_rows == 0) {
            $query = "UPDATE dept_emp SET dept_no = '$dept_num' WHERE emp_no = '$id' AND to_date = '9999-01-01'; INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) VALUES ('$id', '$dept_num', '$curr_date', '9999-01-01');";
        } else {
            $query = "UPDATE dept_emp SET dept_no = '$dept_num' WHERE emp_no = '$id' AND to_date = '9999-01-01';";
        }

        $success = mysqli_multi_query($conn, $query);
        if ($success) {
            header("Location: updateDepUI.php?success=true");
        } else {
            header("Location: updateDepUI.php?success=false2");
        }
    } else {
        header("Location: updateDepUI.php?success=false1");
    }
}



?>