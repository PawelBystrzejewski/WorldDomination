<?php
//sprawdzamy czy uzytkownik jest zalogowany
//sprawdzamy czy zostal przeslany formualrz i jezeli tak to zpaisujemy zmiany do bazy
// wyswietl info czy udalo sie zpaisac dane
//pobieramy dane aktualnie zalogowanego uzytkownika (id z $SESSION[;LOGGED_USER_ID']
//WYSWIETLIMY FORMULARZ DO EDYCJI DANYCH UZYTKOWNIKA wstepnie wypelnoony aktualnymi danymi uzytkownika
//sprawdzamy polaczenia
require_once 'src/connection.php';
require_once 'src/init.php';
require_once 'src/Users.php';
require_once 'src/Tweet.php';

//sprawdzamy czy uzytkownik jest zalogowany
if (!isset($_SESSION['loggedUserId'])) {

    header('Location: login.php');
} else {
//    
    $loggedUserId = $_SESSION['loggedUserId'];

    $loggedUser = Users::loadUserById($conn, $loggedUserId);

    echo "You are logged as:" . $loggedUser->getUsername() . "<br>";
    echo "<a href='logout.php'>Log-out</a><br>";
}
//sprawdzamy czy zostal przeslany formualrz i jezeli tak to zpaisujemy zmiany do bazy
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2'])) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

//sprawdz czy wpisano e-mail
        if ($email == "") {
            echo "You need to give an e-mail";
//sprawdz czy hasla dobie odpowiadaja            
        } else if ($password1 != $password2) {
            echo "Both passwords need to be the same";
        } else {


            $loggedUser->setEmail($email);
            $loggedUser->setUsername($username);
            $loggedUser->setPassword($password1);

            $result = $loggedUser->saveToDB($conn);

            if ($result) {
                echo "Your data has been edited" . $loggedUser->getUsername();
            }
        }
    } else {
        echo "Some data are missing";
    }
}
?>

<!DOCTYPE html>

<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <title> User info Edit </title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <form action="#" method="POST">
            <fieldset>
                <legend> Edit your profile </legend>
                <label class="pole"> Username <br> <input type="text" name="username"> </label>
                <label class="pole"> Email <br> <input type="text" name="email"> </label>
                <label class="pole"> Password <br> <input type="text" name="password1"> </label>
                <label class="pole"> Repeat Password <br> <input type="text" name="password2"> </label>
                <label class="pole"> <input type="submit" name="saveChanges"> </label>
            </fieldset>

        </form>
        <form action="login.php">
            <input type="submit" value="Login" />
        </form>
    </body>
</html>
