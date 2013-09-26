<?php
$pageTitle = 'Качване на файлове';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if($_SESSION['isLogged']) {
    if($_FILES) {
        if(move_uploaded_file($_FILES['upload']['tmp_name'], $userDir . DIRECTORY_SEPARATOR . $_FILES['upload']['name'])) {
            echo '<p>Файлът е качен успешно!</p>';
        }
        else {
            echo '<p>Файлът е качен неуспешно!</p>';
        }
    }
    ?>
    <form method="POST" enctype="multipart/form-data">
        <div>Качи файл: <input type="file" name="upload"></div>
        <div><input type="submit" value="Качи"> </div>
    </form>
    <?php
}
else {
    echo '<p>Трябва да сте регистрирани в ситемата за да можете да качвате файлове!</p>';
    echo '<a href="index.php">Към страницата за вход</a>';

}

include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
?>

