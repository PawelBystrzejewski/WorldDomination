<?php

class Tweet {

    private $tweetId;
    private $userId;
    private $text;
    private $creationDate;
    
    static public $ret2=  [];


    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
    }

    public function setUserId($newUserId) {

        if (is_numeric($newUserId) && $newUserId > 0) {
            $this->userId = $newUserId;
        }
        return $this;
    }

    public function setText($newText) {

        if (is_int($newText) && $newText > 0) {
            $this->text = $newText;
        }
        return $this;
    }

    public function setCreationDate($newCreationDate) {

        if (is_date($newCreationDate) && $newCreationDate > 0) {
            $this->$newCreationDate = $newCreationDate;
        }
        return $this;
    }

    public function getTweetId() {
        return $this->tweetId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getText() {
        return $this->text;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) { //jezeli nowy Tweet
//Saving new Tweet to DB
            $sql = "INSERT INTO Tweet (user_id, text, creation_date) 
                    VALUES ('$this-user_id', '$this->text', '$this->creationDate')"; //dokonanie inserta ale z danymmi obiektu ktore mamy

            $result = $connection->query($sql);

            if ($result == true) {
                $this->tweetId = $connection->insert_tweetId; //jezeli uda sie dodac to nada numer wg bazy
                return true;
            }
        }
        return false;
    }

    static public function loadTweetById(mysqli $connection, $tweetId) { //
        $sql = "SELECT * FROM Tweet WHERE id=$tweetId";
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {  // zwraca nam 
            $row = $result->fetch_assoc(); //zwraca jako tablice asocajacyjna czyli tablice gdzie jako klucze sa nazwy naszych kolumn
            $loadedTweet = new Tweet(); //nowy obiekt klasy users
            $loadedTweet->tweetId = $row['tweet_id']; //przypisuje wartosc ktore pobralismy z bazy
            $loadedTweet->userId = $row['user_id'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creation_date'];
            return $loadedTweet;
        }
        return null;
    }

    static public function loadAllTweetByUserId(mysqli $connection, $userId) { //POBIERANIE WSZYSTKICH UZYTKOWNIKOW
        $sql = "SELECT * FROM Tweet WHERE user_id=$userId";
        $ret1 = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) { //wynik przypisujemy do return, jezeli wynik sie udal to wtedy foreachem kazdy rzad z naszego resulta i na koniec pakujemy do tablic red. RObimy tak dlugo az sa uzytkownicy i na koniec ret
            foreach ($result as $row) {
                $loadedTweet = new Tweet(); //nowy obiekt klasy users
                $loadedTweet->tweetId = $row['tweet_id']; //przypisuje wartosc ktore pobralismy z bazy
                $loadedTweet->userId = $row['user_id'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creation_date'];
                $ret1[] = $loadedTweet;
            }
        }
        return $ret1;
    }

    static public function loadAllTweets(mysqli $connection) { //POBIERANIE WSZYSTKICH UZYTKOWNIKOW
        $sql = "SELECT * FROM Tweet";
        static $ret2 = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) { //wynik przypisujemy do return, jezeli wynik sie udal to wtedy foreachem kazdy rzad z naszego resulta i na koniec pakujemy do tablic red. RObimy tak dlugo az sa uzytkownicy i na koniec ret
            foreach ($result as $row) {
                $loadedTweet = new Tweet(); //nowy obiekt klasy users
                $loadedTweet->tweetId = $row['tweet_id']; //przypisuje wartosc ktore pobralismy z bazy
                $loadedTweet->userId = $row['user_id'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creation_date'];
                $ret2[] = $loadedTweet;
            }
        }
        return $ret2;
    }
    

}

echo $ret2
