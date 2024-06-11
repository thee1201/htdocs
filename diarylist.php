<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>DiaryList</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/diary.css" />
</head>
<body class="Background">
  <nav class="menubar">
    <div class="menuButton">
      <img id="menuCatPad" src="img/고양이_발바닥.png" alt="메뉴열기" />
    </div>
    <nav id="menu">
      <ul>
        <li><a href="main.html" target="_self">home</a></li>
        <li><a href="diarylist.php" target="_self">diary</a></li>
        <li><a href="profile.php" target="_self">profile</a></li>
        <li><a href="logout.php">logout</a></li>
      </ul>
    </nav>
  </nav>
  <div class="diary-list-container" id="diary-list-container">
    <?php
      session_start();
      include "./db.php";
      
      $memderID = $_SESSION['uid'];
      
      $sql = "SELECT diary_date,emotion,contens FROM diary WHERE user_id='$memderID';";
      $result = $db->query($sql);

      while($row = $result->fetch_assoc()) {
          echo '<div class="Diary">';
          echo '<img id="diary-emotion" src="img/emotion/' . $row['emotion'] . '.png" alt="' . $row['emotion'] . '">';
          echo '<p id="diary-date">date/ ' . $row['diary_date'] . '</p>';
          echo '<br>';
          echo '<p id="diary-contents">' . $row['contens'] . '</p>';
          echo '</div>';
      }

      $db->close();
    ?>
  </div>
</body>
</html>