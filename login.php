<?php
    session_start();
    $err = '';
    if(isset($_SESSION["log"]))
    {
        header("Location:index.php");
        exit();
    }
    if($_POST)
    {
        require "connect.php";
        $login = mysqli_real_escape_string($con, $_POST['log']);
        $pwd = mysqli_real_escape_string($con, $_POST['pwd']);
        $pwd = sha1($pwd);
        $sql = "SELECT * FROM konto JOIN klient ON konto.idKonto = klient.idKonto HAVING Login='$login' AND Haslo='$pwd'";
        $ret = mysqli_query($con, $sql);
        if(mysqli_num_rows($ret)==1)
        {
            $row = mysqli_fetch_assoc($ret);
            $_SESSION["log"] = $row['Login'];
            $_SESSION["id"] = $row['idKlient'];
            header("Location:index.php");
            exit();
        }

        $err = "<p style = 'color:red'>Złe dane logowania </p>";
        mysqli_close($con);
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
    <form action="login.php" method="POST">
        <table>
            <tr><td>Login: </td><td><input type="text" name="log"></td></tr>
            <tr><td>Hasło: </td><td><input type="password" name="pwd"></td></tr>
        </table>
        <input type="submit" value="zaloguj">
    </form>
    Jeżeli nie masz kobta <a href = 'rejestracja.php'> zarejestruj się </a>
    <?php
        echo $err;
    ?>
</body>
</html>