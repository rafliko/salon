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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br><a href='index.php'><img id="logo" src="img/logo.png"></a><br>
    <?php
        echo "Jesteś zalogowany jako ".$_SESSION["log"];
    ?>
    <br><a href="wyloguj.php">wyloguj</a>
    <br><a href="koszyk.php">koszyk</a>
    <h1>Oferty:</h1>
    <?php
        require "connect.php";
        $sql = "SELECT * FROM samochod;";
        $ret = mysqli_query($con, $sql);

        if (mysqli_num_rows($ret) > 0) {
            while($row = mysqli_fetch_assoc($ret)) {
                $item = "";
                $item .= "<div>";
                $item .= "<img id='zdj' src='img/".$row["Zdjecie"]."'><br>";
                $item .= $row["Marka"]." ";
                $item .= $row["Model"]."<br>";
                $item .= $row["Cena"]."zł<br>";
                $item .= "<button>Do koszyka</button>";
                $item .= "</div><br>";
                echo $item;
            }
        } else {
            echo "0 results";
        }
          
        mysqli_close($con);
    ?>
</body>
</html>