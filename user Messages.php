<?php


//sprawdzimy czy uzytkownik jest zalogowany
//pobierzemy z bazy wszystkie wiadomosci ktorych adresatem jest aktualnie zalogowany uzytkownik(z sesji)

//wyswietlimy liste tych wiadomosci(30 pierwszycch znakow)
//kazda wiadomosc jest klikalna i powoduje przeiekrowanie do strony ze szczegolami wiadomosci(messageDetail.php?message_id=$mesage->id);