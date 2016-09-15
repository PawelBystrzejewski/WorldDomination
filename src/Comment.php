<?php

class Comment {

    private $commentId;
    private $userId;
    private $postId;
    private $creationDate;
    private $text;

    public function __construct() {
        $this->commentId = -1;
        $this->userId = " ";
        $this->postId = " ";
        $this->creationDate = " ";
        $this->text = 0;
    }

    function setAuthorId($newUserId) {
        $this->userId = $newUserId;
    }

    function setPostId($newPostId) {
        $this->postId = $newPostId;
    }

    function setCreationDate($newCreationDate) {
        $this->creationDate = $newCreationDate;
    }

    function setText($newText) {
        $this->text = $newText;
    }

    function getCommentId() {
        return $this->commentId;
    }

    function getAuthorId() {
        return $this->userId;
    }

    function getPostId() {
        return $this->postId;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function getText() {
        return $this->text;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->commentId == -1) { //jezeli nowy Tweet
//Saving new Tweet to DB
            $sql = "INSERT INTO Comment (user_id, post_id, creation_date, text) 
                    VALUES ('$this->userId', '$this->postId', '$this->creationDate','$this->text')"; //dokonanie inserta ale z danymmi obiektu ktore mamy

            $result = $connection->query($sql);

            if ($result == true) {
                $this->commentId = $connection->insert_commentId; //jezeli uda sie dodac to nada numer wg bazy
                return true;
            }
        }
        return false;
    }

    static public function loadCommentByCommentId(mysqli $connection, $commentId) { //POBIERANIE WSZYSTKICH UZYTKOWNIKOW
        $sql = "SELECT * FROM Comment WHERE comment_id=$commentId ORDER BY creation_date DESC";

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) { //wynik przypisujemy do return, jezeli wynik sie udal to wtedy foreachem kazdy rzad z naszego resulta i na koniec pakujemy do tablic red. RObimy tak dlugo az sa uzytkownicy i na koniec ret
            $row = $result->fetch_assoc();
            $loadedComment = new Comment(); //nowy obiekt klasy comment
            $loadedComment->commentId = $row['comment_id']; //przypisuje wartosc ktore pobralismy z bazy
            $loadedComment->userId = $row['user_id'];
            $loadedComment->postId = $row['post_id'];
            $loadedComment->creationDate = $row['creation_date'];
            $loadedComment->text = $row['text'];
            return $loadedComment;
        }

        return null;
    }

    static public function loadAllCommentByPostId(mysqli $connection, $postId) { //POBIERANIE WSZYSTKICH UZYTKOWNIKOW
        $sql = "SELECT * FROM Comment WHERE post_id=$postId ORDER BY creation_date DESC";

        $result = $connection->query($sql);
        $ret = [];

        if ($result == true && $result->num_rows != 0) { //wynik przypisujemy do return, jezeli wynik sie udal to wtedy foreachem kazdy rzad z naszego resulta i na koniec pakujemy do tablic red. RObimy tak dlugo az sa uzytkownicy i na koniec ret
            foreach ($result as $row) {
                $loadedComment = new Comment(); //nowy obiekt klasy comment
                $loadedComment->commentId = $row['comment_id']; //przypisuje wartosc ktore pobralismy z bazy
                $loadedComment->userId = $row['user_id'];
                $loadedComment->postId = $row['post_id'];
                $loadedComment->creationDate = $row['creation_date'];
                $loadedComment->text = $row['text'];
                $ret[] = $loadedComment;
            }
        }
        return $ret;
    }

}
