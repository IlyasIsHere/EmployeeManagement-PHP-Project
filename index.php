<?php
include_once 'includes/dbh.inc.php';
session_start();

if (isset($_GET["disconnect"])) {
    session_unset();
    session_destroy();
}


if (isset($_SESSION["USER_ID"])) {
        if ($_SESSION["EMP_TYPE"] == "manager"){
            header("location:optionsUI.php");
        }
        else if ($_SESSION["EMP_TYPE"] == "employee") {
            header("location:emp.php");
        }
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Log in</title>
</head>
<body>
    <?php 
        $id = "";
        $emp_exists = false;
        $idError = $psdError = "";
        $submit = true;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $psd = mysqli_real_escape_string($conn, $_POST['psd']);
            $type =mysqli_real_escape_string($conn,$_POST['emp']);
            if (empty($id)) {
                $idError = "Veuillez entrer votre ID";
                $submit = false;
            }
            $sql = "SELECT * FROM employees;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if($row['emp_no'] == $id) {
                        $emp_exists = true;
                        $user_name = $row['first_name'] . " ". $row['last_name'];
                        $_SESSION["USER_NAME"] = $user_name;
                        $_SESSION["USER_ID"] = $id;
                        break;
                    }

                }
            }
            if(!$emp_exists) {
                $idError = "ID non valide";
                $submit = false;
            }
            if (empty($psd)) {
                $psdError = "Veuillez entrer votre mot de passe";
                $submit = false;
            }
            if(!empty($psd) && !empty($id) && $psd != $id . "123"){
                $psdError = "Mot de passe incorrect";
                $submit = false;
            }
        }
        else {
            $submit = false;
        }
        if($submit == false) { ?>
          <section>
        <div class="form-box">
            <div class="form-value">
                <form  method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <h2 >Login</h2>
                    <div class="inputbox">
                        <ion-icon name="id-card-outline"></ion-icon>
                        <input type="number" name="id"  id="id" >
                        <label for="id">ID</label>
                        <span class="text-danger"><?php echo $idError; ?></span>
                    </div>
                    
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="psd" id="psw">
                        <label for="psw">Mot de passe</label>
                        <span class="text-danger"><?php echo $psdError; ?></span>
                    </div>

                    <div class="typeemp">
                    <label for="manager"><input type="radio" id ="manager" name ="emp" value="manager">Manager</label>
                    <label for="employee"><input type="radio" id ="employee"name ="emp"value ="employee" checked>Employee</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Se souvenir de moi<a href="#">Mot de passe oublié</a></label> 
                    </div>
                    <button type="submit" >Log in</button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <?php
        } else {
            $emp_ismanager = false;
            $sql2 = "SELECT * FROM dept_manager WHERE to_date = '9999-01-01';";
            $result2 = mysqli_query($conn, $sql2);
            $resultCheck2 = mysqli_num_rows($result2);
            if ($resultCheck2 > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    if($row2['emp_no'] == $id) {
                        $emp_ismanager = true;
                        break;
                    }

                }
            }
            if($emp_ismanager){
                $_SESSION['EMP_TYPE'] = "manager";
                header("Location:optionsUI.php");
                exit();
            }
            else {
                $_SESSION["EMP_TYPE"] = "employee";
                header("Location:emp.php");
                exit();
            }
        }
    ?>
</body>
</html>