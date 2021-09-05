<?php

$users = [
    ['email' => 'ivan@mail.ru', 'name' => 'Иван', 'id' => '1'],
    ['email' => 'julia@mail.ru', 'name' => 'Юлия', 'id' => '2'],
    ['email' => 'mikhail@mail.ru', 'name' => 'Михаил', 'id' => '3'],
];

if(isset($_POST['email']) && $_POST['email'] &&
    isset($_POST['password']) && $_POST['password'] &&
    isset($_POST['passwordRepeat']) && $_POST['passwordRepeat']){
    $checkEmail = checkEmail($_POST['email']);
    $resultUser = findUser($_POST['email']);
    $passwordCompare = passwordCompare($_POST['password'], $_POST['passwordRepeat']);
    echo json_encode(array(
        'checkEmail' => $checkEmail,
        'resultUser' => $resultUser,
        'resultPassword' => $passwordCompare
    ));
} 

function messageLog ($message) {
    $logMessage = date('Y-m-d H:i:s') . ' ' . $message;
    file_put_contents(__DIR__ . '/logs/log.txt', $logMessage . PHP_EOL, FILE_APPEND);
}

function checkEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function findUser($email) {
    global $users;
    foreach($users as $user) {
        if($email == $user['email']){
            messageLog("E-mail адрес '{$email}' уже существует.\n");
            return true;
        } 
    }
    messageLog("E-mail адрес '{$email}' не существует.\n");
    return false;
}

function passwordCompare($passwordOne, $passwordTwo) {
    $result = strcmp($passwordOne, $passwordTwo);
    return $result;
}

?>