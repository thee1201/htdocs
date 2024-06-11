<?php
    session_start();
    

    if (!isset($_SESSION['cat'])) {
        echo "고양이 정보가 없습니다.";
        exit();
    }

    $cat = $_SESSION['cat'];
    $catImg = '';

    switch ($cat) {
        case 'shiro':
            $catImg = '<img id="user-cat" src="img/cat/medi-shiro.png" alt="shiro">';
            break;
        case 'nachiware':
            $catImg = '<img id="user-cat" src="img/cat/medi-nachiware.png" alt="nachiware">';
            break;
        case 'mike':
            $catImg = '<img id="user-cat" src="img/cat/medi-mike.png" alt="mike">';
            break;
        case 'pointed':
            $catImg = '<img id="user-cat" src="img/cat/medi-pointed.png" alt="pointed">';
            break;
        case 'chashiro':
            $catImg = '<img id="user-cat" src="img/cat/medi-chashiro.png" alt="chashiro">';
            break;
        case 'sabashiro':
            $catImg = '<img id="user-cat" src="img/cat/medi-sabashiro.png" alt="sabashiro">';
            break;
        default:
            $catImg = '<img id="user-cat" src="img/cat/fet-cheese.png" alt="fet-cheese">';
            break;
    }

    echo $catImg;
?>