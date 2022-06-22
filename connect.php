<?php
    $serv = "localhost";
    $user = "root";
    $pwd ="Testowe@123";
    $bd = "salon1";
    $con = mysqli_connect($serv,$user,$pwd,$bd);

    if($con == false)
    {
        $err = "<p style = 'color:red'>Nie można połączyć się z bazą </p>";
    }
?>