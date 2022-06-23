<?php
$users = "pages/users.txt";
//регистрация
function register($name, $password, $email){
    //Валидация данных
    $name = trim(htmlspecialchars($name));
    $password = trim(htmlspecialchars($password));
    $email = trim(htmlspecialchars($email));

    if ($name == '' || $password == '' || $email == '') {
        echo "<h3><span style='color: red;'>Fill All Rewuipewd Fields</span></h3>";
        return false;
    }
    if (strlen($name) < 3 || strlen($name) > 30 || strlen($password) < 3 || strlen($password) > 30) {
        echo "<h3><span style='color: red;'>Values length must be between 3 and 30!</span></h3>";
        return false;
    }

    //Проверка на уникальность логина
    global $users;
    $file = fopen($users, 'a+');
    while($line = fgets($file, 128)){
        $readname = substr($line, 0, strpos($line, ":"));
        if($readname == $name) {
            echo "<h3><span style='color: red;'>Such login is already used!</span></h3>";
            return false;
        }
    }

    //Запись данных о пользователе
    $line = $name . ':' . md5($password) . ':' . $email . "\r\n";
    fputs($file, $line);
    fclose($file);
    return true;
}

 //Авторизация  
function login($login, $password) {
    $login = trim(htmlspecialchars($login));
    $password = trim(htmlspecialchars($password));

    if($login == "" || $password == ""){
        echo "<h3><span style='color: red;'>Please input all required data!</span></h3>";
        return false;
    }
    if(strlen($login) < 3 || strlen($login) > 30 || strlen($password) < 3 || strlen($password) > 30){
        echo "<h3><span style='color: red;'>Please input data with length more then 3 and less then 30!</span></h3>";
        return false; 
    }

    global $users;
    $file = fopen($users, 'r');
    while ($line = fgets($file, 128)) {
        $data = explode(':', $line);
        if ($login == $data[0] && md5($password) == $data[1]){
            fclose($file);
            return true;
        }
    }
    return false;
}