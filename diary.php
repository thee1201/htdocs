<?php
    session_start();
    include "./db.php";
    $date = date("Y-m-d");
    $emotion = $_POST['emotion'];
    $content = $_POST['contents'];

    $memberID = $_SESSION['uid'];
    
    $sql = 'INSERT INTO diary(user_id, diary_date, emotion, contens) VALUES (?,?,?,?);';
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssss",$memberID,$date,$emotion,$content);
    $stmt->execute();
    $stmt->close();

    $sql = 'UPDATE stats SET diaries_total = diaries_total + 1 WHERE user_id = ?;';
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s",$memberID);
    $stmt->execute();
    $stmt->close();

    $sql = 'SELECT emotion, COUNT(*) as count FROM diary WHERE user_id = ? GROUP BY emotion ORDER BY count DESC LIMIT 1';
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s",$memberID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $most_emotion = $row['emotion'];
    $stmt->close();

    $sql = "UPDATE stats SET emotion_total = ? WHERE user_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $most_emotion, $userID);
    $stmt->execute();
    $stmt->close();
    
    $db->close();

    header("Location: main.html");
    exit();
    // if ($stmt->execute()) {
    //     echo "일기 저장";
    //     header("Location: main.html");
    // } else {
    //     echo "일기 저장 오류!";
    // }
?>