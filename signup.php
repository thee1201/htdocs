<?php
    include "./db.php";

    $memberName = $_POST['uname'];
    $memberID = $_POST['uid'];
    $memberPW = password_hash($_POST['upw'], PASSWORD_DEFAULT);
    $memberCat = $_POST['cat'];
    
    $check_sql = "SELECT user_id FROM users WHERE user_id=?;";
    $check_stmt = $db->prepare($check_sql);
    $check_stmt->bind_param("s",$memberID);
    $check_stmt->execute();
    $check_stmt->store_result();
    
    if ($check_stmt->num_rows() > 0) {
        echo "중복된 아이디 존재";
    } else {
        $sql = "INSERT INTO users(user_id,user_pw,cat,user_name) VALUES (?,?,?,?);";
    
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssss",$memberID,$memberPW,$memberCat,$memberName);
        echo $sql;
    
        if ($stmt->execute() === true) {
            echo "회원 가입 성공";
            $stmt->close();
            
            $sql = "INSERT INTO stats(user_id) VALUE (?);";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s",$memberID);
            $stmt->execute();
            header("Location: ./login.html");
            exit();
            $stmt->close();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $check_stmt->close();
    $db->close();
?>