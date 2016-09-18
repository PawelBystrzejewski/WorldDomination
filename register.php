<?php
//sprawdzi czy zostal przeslany formularz rejest
//jezeli tak to zwaliduje dane i zapisze nowego uzytkownika
//jezeli zapis sie powiedzie(unnikalny email itp.) to zaloguje uzytkownika i przekieruje na glowna strone
//jezeli rejestracja sie nie powiodla wyswietl blad
//wyswietli formularz rejestracyjny pozwalajacy wypelnic wymagane dane


require_once 'src/connection.php';
require_once 'src/init.php';
require_once 'src/Users.php';
require_once 'src/Tweet.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2'])) {


        $username = $_POST['username'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if (Users::loadUserByEmail($conn, $email) != null) {
            echo "This e-mail is already in our database";
        } elseif ($_POST['password1'] != $_POST['password2']) {
            echo "Both passwords should be the same";
        } else {
            $newUser = new Users();
            $newUser->setEmail($email);
            $newUser->setUsername($username);
            $newUser->setPassword($password1);

            $result = $newUser->saveToDB($conn);

            if ($result) {
                echo "The user was added to databas" . $newUser->getUsername();
            }
        }
    } else {
        echo "Fill all the fields";
    }
}
?>


<!DOCTYPE html>

<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <title> Register </title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>

        <form action="#" method="POST">
            
            <label class="pole"> Username <br> <input type="text" name="username"> </label>
            <label class="pole"> Email <br> <input type="text" name="email"> </label>
            <label class="pole"> Password <br> <input type="text" name="password1"> </label>
            <label class="pole"> Repeat Password <br> <input type="text" name="password2"> </label>
            <label class="pole"> <input type="submit" name="Register"> </label>
        
        
        </form> 
        <form action="login.php">
            <input type="submit" value="Login" />
        </form>
    </body>
</html>


   