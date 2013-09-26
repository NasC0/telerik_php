<?php
$pageTitle = 'Качени файлове';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if($_SESSION['isLogged']) {
    $dirContents = scandir($userDir);
    echo '<p>Твоите файлове: </p>';

    if(count($dirContents) <= 2) {
        echo '<p>Няма качени файлове</p>';
    }
    else {
        echo '<table border="1">
             <thead><tr><th>Име</th><th>Размер</th></tr></thead>';
        
        for($i = 2; $i < count($dirContents); $i++) {

            $size = filesize($userDir . DIRECTORY_SEPARATOR . $dirContents[$i]);
            $size = formatSizeUnits($size);

            $link = '<a href="download.php?file=' . $dirContents[$i] . '" >';

            echo '<tr><td>'.$link. $dirContents[$i] .'</a></td><td>'.$size.'</td></tr>';
        }
        echo '</table>';
    }
}

?>