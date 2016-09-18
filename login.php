<!DOCTYPE html>

<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <title> Login </title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>

        <form action="#" method="POST">
            <label class="pole"> E-mail: <br> <input type="text" name="email"> </label>
            <label class="pole"> Password <br> <input type="text" name="password"> </label>
            <label class="pole"> <input type="submit" name="Send"> </label>
        </form> 
        <form action="register.php">
            <input type="submit" value="Register" />
        </form>
    </body>
</html>


<?php
// najpierw sprawdzi czy zostal przeslany formularz 
//// jezeli tak to znajdzie w bazie uzytkownika o podanym emailu
//sprawdzi czy wpisane haslo ($POST['PASSWORD']) jest poprawne zap omoca funkcji password verify
//jezeli haslo i nazwa sie zgadzaja zaloguje uzytkownika
//logowanie to wpisanie do sesji id uzytkownika, np. jako $_SESSION['logged_user_id']
//        po udanym zalogowaniu przeniesie na strone glowna: header('location::main.php');
//
//// jezeli logowanie nie powiodlo sie, wyswietli info ze login i haslo sa bledne
//
////wyswietli formularz logowania z polami e-mail i haslo(action="#", method="post")
//wyswietlamy link do rejestracji uzytkownika

require_once 'src/connection.php';
require_once 'src/init.php';
require_once 'src/Users.php';
require_once 'src/Tweet.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loggedUser = Users::loadUserByEmail($conn, $email);

    if ($loggedUser != null) {

        $hash = $loggedUser->getHashedPassword();

        if (password_verify($password, $hash)) {

            $loggedUserId = $loggedUser->getId();

            $_SESSION['logged_user_id'] = $loggedUserId;

            header('Location:: main.php');
        } else {

            echo "Wrong e-mail or password. Try again.";
        }
    } else {

        echo "Wrong e-mail or password. Try again.";
    }
}
?>

