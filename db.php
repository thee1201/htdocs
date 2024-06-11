<?php
    $server = "127.0.0.1";
    $user_name = "root";
    $pass = "041201";
    $db_name = "catdiary";

    header("charset=UTF-8");
    $db = mysqli_connect($server,$user_name,$pass,$db_name);
    // if($db) {
    //     echo "DB Connect Success!";
    // } else {
    //     echo "DB Connect Fail!";
    // }
?>