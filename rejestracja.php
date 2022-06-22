<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="rejestracja.php" method="POST">
        <table>
            <tr><td>Login: </td><td><input type="text" name="log"></td></tr>
            <tr><td>Email: </td><td><input type="text" name="em"></td></tr>
            <tr><td>Imię: </td><td><input type="text" name="im"></td></tr>
            <tr><td>Nazwisko: </td><td><input type="text" name="nz"></td></tr>
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
                        VALUES(NULL, '$login', '$email', '$pwd1', 'k');";

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

                $sql = "INSERT INTO klient
                        VALUES(NULL, '$maxid', '$im', '$nz', '$ul', '$num', '$kod', '$miasto', '$tel');";

                $ret = mysqli_query($con, $sql);

                if($ret == true)
                {
                    echo "<br> Zostałeś dodany przejdź na stronę <a href = 'login.php'> logowania </a>";
                }
                else
                {
                    echo "<br>Przykro mi ale nie zostałeś dodany";
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