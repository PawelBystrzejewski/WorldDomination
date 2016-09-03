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