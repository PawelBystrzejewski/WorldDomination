<?php

class Users {

    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
    }

    public function setPassword($newPassword) {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getId($id) {
        return $this->id;
    }

    public function getUsername($username) {
        return $this->username;
    }

    public function getHashedPassword($hashedPassword) {
        return $this->hashedPassword;
    }

    public function getEmail($email) {
        return $this->email;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) { //jezeli nowy user
//Saving new user to DB
            $sql = "INSERT INTO users(username, email, hashed_password) 
                    VALUES ('$this->username', '$this->email', '$this->hashedPassword')"; //dokonanie inserta ale z danymmi obiektu ktore mamy

            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = $connection->insert_id; //jezeli uda sie dodac to nada numer wg bazy
                return true;
            }
        } else { //slajd 25 jezeli id rozne od -1 to znaczy ze pracujemy na obiekcie ktory juz pobralismy z bazy
            $sql = "UPDATE users SET username='$this->username',
                email='$this->email',
                hashed_password='$this->hashedPassword'
                WHERE id=$this->id";  //pojedyncze= bo sql
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    static public function loadUserById(mysqli $connection, $id) { //
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {  // zwraca nam 
            $row = $result->fetch_assoc(); //zwraca jako tablice asocajacyjna czyli tablice gdzie jako klucze sa nazwy naszych kolumn
            $loadedUser = new Users(); //nowy obiekt klasy users
            $loadedUser->id = $row['id']; //przypisuje wartosc ktore pobralismy z bazy
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }

    static public function loadAllUsers(mysqli $connection) { //POBIERANIE WSZYSTKICH UZYTKOWNIKOW
        $sql = "SELECT * FROM users";
        $ret = [];
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) { //wynik przypisujemy do return, jezeli wynik sie udal to wtedy foreachem kazdy rzad z naszego resulta i na koniec pakujemy do tablic red. RObimy tak dlugo az sa uzytkownicy i na koniec ret
            foreach ($result as $row) {
                $loadedUser = new Users();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    public function delete(mysqli $connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM users WHERE id=$this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1; //id znowu zostaje ustawione na -1
                return true;
            }
            return false;
        }
        return true;
    }

}
