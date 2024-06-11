<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/profile.css" />
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
    <div class="profile-box">
        <div class="profile-img-box">
          <?php
            session_start();
            include "./db.php";
            
            $cat = $_SESSION['cat'];
            $memberName = $_SESSION['name'];

            switch ($cat) {
              case 'shiro':
                echo '<img id="user-cat-profile" src="img\profilecat\profile-shiro.png" alt="shiro">';
                break;
              case 'nachiware':
                echo '<img id="user-cat-profile" src="img\profilecat\profile-nachiware.png" alt="nachiware">';
                break;
              case 'mike':
                echo '<img id="user-cat-profile" src="img\profilecat\profile-mike.png" alt="mike">';
                break;
              case 'pointed':
                echo '<img id="user-cat-profile" src="img\profilecat\pofile-pointed.png" alt="pointed">';
                break;
              case 'chashiro':
                echo '<img id="user-cat-profile" src="img\profilecat\profile-chashiro.png" alt="chashiro">';
                break;
              case 'sabashiro':
                echo '<img id="user-cat-profile" src="img\profilecat\profile-sabashiro.png" alt="sabashiro">';
                break;
              default:
                echo '<img id="user-cat-profile" src="img\profilecat\profile-chashiro.png" alt="sabashiro">';
                break;
            }
            echo '<p>'.$memberName.'</p>';
            $db->close();
          ?>
        </div>
        <div class="profile-information-box">
          <div id="profile-cat">
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                fetch('catImage.php')
                  .then(response => {
                    if (!response.ok) {
                      throw new Error('Network response was not ok');
                    }
                    return response.text();
                  })
                  .then(data => {
                    const catImageElement = document.getElementById('profile-cat');
                    if (catImageElement) {
                        catImageElement.innerHTML = data;
                    } else {
                        console.error('Error: catImage element not found');
                    }
                  })
                  .catch(error => console.error('Error fetching cat image:', error));
              });
            </script>
          </div>
          <div class="diary-count">
            <p id="text">diary counts</p>
            <?php
              session_start();
              include "./db.php";

              $memberID = $_SESSION['uid'];
              $sql = "SELECT diaries_total FROM stats WHERE user_id = '$memberID';";
              $result = $db->query($sql);
              $row = $result->fetch_assoc();
              echo '<p id="counts-text">'.$row['diaries_total'].'</p>';
              $db->close();
            ?>
          </div>
          <div class="emotion-count">
            <p id="text">your feelings</p>
            <p id="counts-text" style="font-size: 30pt; color: #c8b196;">is not update..</p>
          </div>
        </div>
    </div>
</body>
</html>