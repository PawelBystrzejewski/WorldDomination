<?php


//sprawdzimy czy uzytkownik jest zalogowany
//wyciagamy wiadomosc z bazy
////
//sprawdzimy czy wiadomosc ktora chce wyswietlic byla adresowana do zalogowaneo uzytkownika (czy id odbiorcy jest rowne id zalogowanego uzytkownika z sesji)
//jezeli wszystko ok to zmienimy jej statu z nieprzeczytanej na przeczytana
//zapiujemy w bazie po zmianie statusu
//wyswietlamy wiadomosc