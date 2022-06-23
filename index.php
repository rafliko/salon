<?php
    session_start();
    if(!isset($_SESSION["log"]))
    {
        header("Location:login.php");
        exit();
    }
    if($_SESSION["log"] == 'admin')
    {
        header("Location:admin.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo "Jesteś zalogowany jako ".$_SESSION["log"];
    ?>
    <br><a href="wyloguj.php">wyloguj</a>
</body>
</html>