<?php
    session_start();
    include "./db.php";

    $memberID = $_POST['uid'];
    $memberPW = $_POST['upw'];

    $sql = "SELECT user_id, user_pw, user_name, cat FROM users WHERE user_id=?;";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s",$memberID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($memberID, $hashedPW, $memberName, $membercat);
    $stmt->fetch();

    if ($stmt->num_rows() > 0 && password_verify($memberPW,$hashedPW)) {
        $_SESSION['uid'] = $memberID;
        $_SESSION['cat'] = $membercat;
        $_SESSION['name'] = $memberName;
        echo "로그인 성공";
        header("Location: main.html");
        exit();
    } else {
        echo "아이디 또는 비밀번호를 다시 입력하세요.";
    }

    $stmt->close();
    $db->close();
?>