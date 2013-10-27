<?php
if (isset($data['error'])) {
    foreach ($data['error'] as $error) {
        ?>
        <div class='error'><?= $error ?></div>
    <?php
    }
}
?>

<a href="index.php">Списък</a>
<a href="add_book.php">Нова книга</a>
<form method="post" action="authors.php">
    Име: <input type="text" name="author_name"/>
    <input type="submit" value="Добави"/>
</form>

<table border='1'>
    <tr>
        <th>Автор</th>
    </tr>

    <?php
    foreach ($data['authors'] as $row) {
        echo '<tr><td>' . $row['author_name'] . '</td></tr>';
    }
    ?>
</table>

<?php
if(isset($data['messages'])) {
    foreach ($data['messages'] as $message) {
        ?>
        <div class='message'><?= $message ?></div>
        <?php
    }

}