<?php

// najpierw sprawdzi czy zostal przeslany formularz 
//// jezeli tak to znajdzie w bazi uzytkownika o podanym emailu
//sprawdzi czy wpisane hasl ($POST['PASSWORD']) jest poprawne zap omoca funkcji password verify
//jezeli haslo i nazwa sie zgadzaja zaloguje uzytkownika
//logowanie to pwisanie do sesji id uzytkownika, np. jako $_SESSION['logged_user_id']
//        po udanym zalogowaniu przeniesie na strone glowna: header('location::main.php');
//
//// jezeli logowanie nie powiodlo sie, wyswietli info ze login i haslo sa bledne
//
////wyswietli formularz logowania z polami e-mail i haslo(action="#", method="post")
//wyswietlamy link do rejestracji uzytkownika