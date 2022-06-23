<?php
    session_start();

    if($_GET && isset($_SESSION["log"]))
    {
        require 'connect.php';
        $idSam = $_GET["idSam"];
        $idKlient = $_SESSION["id"];

        $sql = "INSERT INTO koszyk VALUES (NULL, $idKlient, $idSam, CURDATE(), 1)";
        $ret = mysqli_query($con, $sql);

        mysqli_close($con);
    }

    header("Location:index.php");
    exit();
?>