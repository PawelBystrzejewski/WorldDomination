<?php

//sprawdzimy czy uzytkownik jest zalogowany, jezeli nie to przekierowujemy go na logowanie 
//jezeli nie jest to wysylamy na strone logowania (funkcja ktora wczesniej zdefiniujemy)
//
//sprawdzimy czy post zostal przeslany
//zapisujemy wpis jezeli zostal przeslany formularzem
//jako autora pobierzemy uzytkowniak po ID
//i zapiszemy to
//
//pobieramy wszystkie wpisy z bazy od najnowszego do najstarszeggo
//zeby opbrac wpisy wraz z nazwa autora musimy zrobic SELECT z JOIN
//z 2 tabeli dane
//
//
//wyswietlamy formularz do doawania nowego wpisu
//formularz sklada sie z pola <textera> i submita do przesylania go
//
//wyswietlamy wszystkie wpisy forachem
//wyswietlamy je tak ze np piszemy nazwe uzytkownika i date a ponizej tresc wpisu
//oder by ABc

//klikniecie na uzytkowniak przenosi na strone userInfo.php?user_id=$user->id; (GET przekazywanie info o uzytkowniku


//napisac html template zeby wyswietla