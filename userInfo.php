<?php
//sprawdzamy czy uzytkownik jest zalogowany
//
//sprawdza czy nie zostal wyslany formularz z wiadomoscia do tego uzytkownika
//jezeli tak to zostaje on zpaisany w tabeli z wiadomosciami
//jako odbiorca zostanie ustawiony uzytkownik o id przekazanym w $_GET['user_id'];
//jako nadawca zostanie ustawiony uzytkownik z sesji  $_SESSION['logged_user_id'];

//pobierz dane o id=$_GET['user_id'];

//wyswietlamy formularz do wyswietlania wiadomosci do uzytkownika
//do uzytkownika method="post" action="#"
//zawiera pole <textera> na tresc wiadomosci


//wyswietl dane uzytkownika


require_once 'src/connection.php';
require_once 'src/init.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';
if(!isset($_SESSION['loggedUserId'])) {
    
    header('Location: login.php');
    
} else {
    
    $loggedUserId = $_SESSION['loggedUserId'];
    
    $loggedUser = Users::loadUserById($conn, $loggedUserId);
    
    echo "You are logged as:" .  $loggedUser->getUsername();
    echo "<a href='logout.php'>Logout</a><br>";
    
}