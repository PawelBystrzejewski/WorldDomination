<?php

class Message {

    private $messageId;
    private $senderId;
    private $receiverId;
    private $creationDate;
    private $text;
    private $read;

    public function __construct() {
        $this->messageId = -1;
        $this->senderId = " ";
        $this->receiverId = " ";
        $this->creationDate = " ";
        $this->text = " ";
        $this->read = " ";
    }

    public function setSenderId($newSenderId) {
        $this->senderId = $newSenderId;
    }

    public function setReceiverId($newReceiverId) {
        $this->receiverId = $newReceiverId;
    }

    public function setCreationDate($newCreationDate) {
        $this->creationDate = $newCreationDate;
    }

    public function setText($newText) {
        $this->text = $newText;
    }

//    public function setRead($read) {
//        $this->read = $read;
//    }
    public function getMessage_id() {
        return $this->message_id;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getText() {
        return $this->text;
    }

    public function getRead() {
        return $this->read;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->messageId == -1) { //jezeli nowa wiadomosc
//Saving new Message to DB
            $sql = "INSERT INTO Message (sender_id,receiver_id, creation_date, text, przeczytane) 
                    VALUES ('$this->senderId','$this->receiverId', '$this->creationDate', '$this->text', '$this->read')"; //dokonanie inserta ale z danymmi obiektu ktore mamy

            $result = $connection->query($sql);

            if ($result == true) {
                $this->messageId = $connection->insert_messageId; //jezeli uda sie dodac to nada numer wg bazy
                return true;
            }
        }
        return false;
    }

    static public function loadAllMessageByMessageId(mysqli $connection, $messageId) { //POBIERANIE WSZYSTKICH UZYTKOWNIKOW
        $sql = "SELECT * FROM Message WHERE message_id=$messageId";

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {  // zwraca nam 
            $row = $result->fetch_assoc(); //zwraca jako tablice asocajacyjna czyli tablice gdzie jako
            $loadedMessage = new Message(); //nowy obiekt klasy message
            $loadedMessage->messageId = $row['message_id']; //przypisuje wartosc ktore pobralismy z bazy
            $loadedMessage->senderId = $row['sender_id'];
            $loadedMessage->receiverId = $row['receiver_id'];
            $loadedMessage->creationDate = $row['creation_date'];
            $loadedMessage->text = $row['text'];
            $loadedMessage->read = $row['przeczytane'];

            return $loadedMessage;
        }
        return null;
    }

    static public function loadAllMessageBySenderId(mysqli $connection, $senderId) { //POBIERANIE WSZYSTKICH UZYTKOWNIKOW
        $sql = "SELECT * FROM Message WHERE sender_id=$senderId ORDER BY creation_date DESC";

        $result = $connection->query($sql);
        $ret = []; //czy w tej funkcji nie powinno byc kolejnosci senderId przed messageid jak ladujemy dane....??? do przemyslenia


        if ($result == true && $result->num_rows != 0) { //wynik przypisujemy do return, jezeli wynik sie udal to wtedy foreachem kazdy rzad z naszego resulta i na koniec pakujemy do tablic red. RObimy tak dlugo az sa uzytkownicy i na koniec ret
            foreach ($result as $row) {
                $loadedMessage = new Message(); //nowy obiekt klasy users
                $loadedMessage->messageId = $row['message_id']; //przypisuje wartosc ktore pobralismy z bazy
                $loadedMessage->senderId = $row['sender_id'];
                $loadedMessage->receiverId = $row['receiver_id'];
                $loadedMessage->creationDate = $row['creation_date'];
                $loadedMessage->text = substr($row['text'], 0, 30);
                $loadedMessage->read = $row['przeczytane'];
                $ret[] = $loadedMessage;
            }
        }
        return $ret;
    }

    static public function loadMessageByReceiverId(mysqli $connection, $receiverId) { //
        $sql = "SELECT * FROM Message WHERE receiver_id=$receiverId ORDER BY creation_date DESC";
        $ret = [];
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows != 0) {  // zwraca nam 
            foreach ($result as $row) {

                $loadedMessage = new Message(); //nowy obiekt klasy message
                $loadedMessage->messageId = $row['message_id']; //przypisuje wartosc ktore pobralismy z bazy
                $loadedMessage->senderId = $row['sender_id'];
                $loadedMessage->receiverId = $row['receiver_id'];
                $loadedMessage->creationDate = $row['creation_date'];
                $loadedMessage->text = substr($row['text'], 0, 30);
                $loadedMessage->read = $row['przeczytane'];
                $ret[] = $loadedMessage;
            }
        }
        return $ret;
    }

}
