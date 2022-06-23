<?php
    session_start();
    if(!isset($_SESSION["log"]))
    {
        header("Location:login.php");
        exit();
    }
    if($_SESSION["log"] != 'admin')
    {
        header("Location:index.php");
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
    <br><br>
    <h2>Dodaj pracownika</h2>
    <form action="index.php" method="POST">
        <table>
            <tr><td>Login: </td><td><input type="text" name="log"></td></tr>
            <tr><td>Email: </td><td><input type="text" name="em"></td></tr>
            <tr><td>Imię: </td><td><input type="text" name="im"></td></tr>
            <tr><td>Nazwisko: </td><td><input type="text" name="nz"></td></tr>
            <tr><td>PESEL: </td><td><input type="number" name="pesel"></td></tr>
            <tr><td>Stanowisko: </td><td><input type="text" name="stan"></td></tr>
            <tr><td>Data zatrudnienia: </td><td><input type="date" name="data"></td></tr>
            <tr><td>Ulica: </td><td><input type="text" name="ul"></td></tr>
            <tr><td>Numer: </td><td><input type="text" name="num"></td></tr>
            <tr><td>Kod: </td><td><input type="text" name="kod"></td></tr>
            <tr><td>Miasto: </td><td><input type="text" name="miasto"></td></tr>
            <tr><td>Telefon: </td><td><input type="number" name="tel"></td></tr>
            <tr><td>Hasło: </td><td><input type="password" name="pwd1"></td></tr>
            <tr><td>Potwierdź hasło: </td><td><input type="password" name="pwd2"></td></tr>
        </table>
        <input type="submit" value="zaloguj">
    </form>
    <?php
        if($_POST)
        {
            $login = $_POST["log"];
            $email = $_POST["em"];
            $im = $_POST["im"];
            $nz = $_POST["nz"];
            $pesel = $_POST["pesel"];
            $stan = $_POST["stan"];
            $data = $_POST["data"];
            $ul = $_POST["ul"];
            $num = $_POST["num"];
            $kod = $_POST["kod"];
            $miasto = $_POST["miasto"];
            $tel = $_POST["tel"];
            $pwd1 = $_POST["pwd1"];
            $pwd2 = $_POST["pwd2"];

            if($pwd1 == $pwd2)
            {
                require "connect.php";

                $pwd1 = sha1($pwd1);
                
                $sql = "INSERT INTO konto
                        VALUES(NULL, '$login', '$email', '$pwd1', 'p');";

                $ret = mysqli_query($con, $sql);

                $sql = "SELECT MAX(konto.idKonto) FROM konto;";

                $ret = mysqli_query($con, $sql);

                if (mysqli_num_rows($ret) == 1) {
                    $row = mysqli_fetch_assoc($ret);
                    $maxid = $row["MAX(konto.idKonto)"];
                }
                else
                {
                    $maxid = '';
                }

                $sql = "INSERT INTO pracownik
                        VALUES(NULL, '$maxid', '$im', '$nz', '$pesel', '$stan', '$data', '$ul', '$num', '$kod', '$miasto', '$tel', '$email');";

                $ret = mysqli_query($con, $sql);

                if($ret == true)
                {
                    echo "<br> Pracownik został dodany";
                }
                else
                {
                    echo "<br>Pracownik nie został dodany";
                }
                mysqli_close($con);
            }
            else
            {
                echo "<br>Niezgodność haseł";
            }
        }
    ?>
</body>
</html>