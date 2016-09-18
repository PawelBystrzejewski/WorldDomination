<?php
//sprawdzimy czy uzytkownik jest zalogowany
//pobierzemy z bazy wszystkie wiadomosci ktorych adresatem jest aktualnie zalogowany uzytkownik(z sesji)
//wyswietlimy liste tych wiadomosci(30 pierwszycch znakow)
//kazda wiadomosc jest klikalna i powoduje przeiekrowanie do strony ze szczegolami wiadomosci(messageDetail.php?message_id=$mesage->id);


require_once 'src/connection.php';
require_once 'src/init.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Message.php';

if (!isset($_SESSION['loggedUserId'])) {
    header('Location: login.php');
} else {
    $loggedUserId = $_SESSION['loggedUserId'];
    $loggedUser = Users::loadUserById($conn, $loggedUserId);
    echo "You are logged as:" . $loggedUser->getUsername() . "<br>";
    echo "<a href='logout.php'>Log-out</a><br>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['text']) &&
        isset($_POST['senderId']) &&
        isset($_POST['receiverId'])) {


    $newMessage = new Message();
    $newMessage->setText($_POST['text']);
    $newMessage->setCreationDate(date('Y-m-d H:i:s'));
    $newMessage->setSenderId($_POST['senderId']);
    $newMessage->setReceiverId($_POST['receiverId']);
    $result = $newMessage->saveToDB($conn);
}
$sentMessages = Message::loadAllMessagesBySenderId($conn, $loggedUserId);
$receivedMessages = Message::loadAllMessagesByReceiverId($conn, $loggedUserId);
?>


<!DOCTYPE html>

<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <title> User info Edit </title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php
        foreach ($receivedMessages as $message) {
            $messageId = $message->getId();
            $senderId = $message->getSenderId();
            $sender = Users::loadUserById($conn, $senderId)->getUsername();
            $creationDate = $message->getCreationDate();
            $text = $message->getText();
            ?>
            <table>
                <thead>
                    <tr>
                        <th> Received Messages </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> 123 </td>
                        <td> <?php echo $creationDate ?> </td>
                        <td> 123 </td>
                    </tr>
                </tbody>
            </table>


            <?php
            foreach ($sentMessages as $message) {
                $messageId = $message->getId();
                $receiverId = $message->getReceiverId();
                $receiver = Users::loadUserById($conn, $receiverId)->getUsername();
                $creationDate = $message->getCreationDate();
                $text = $message->getText();
                ?>
                <table>
                    <thead>
                        <tr>
                            <th> Sent Messages </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 123 </td>
                            <td> <?php echo $creationDate ?> </td>
                            <td> 123 </td>
                </tr>
            </tbody>
        </table>

    </body>
</html>



