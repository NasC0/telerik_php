<a href="index.php">Списък</a>

<?php
if (isset($data['errors'])) {
    foreach ($data['errors'] as $error) {
        ?>
        <div class='error'><?= $error ?></div>
    <?php
    }
}
?>
<form method="post" action="add_book.php">
    Име: <input type="text" name="book_name"/>

    <div>Автори:<select name="authors[]" multiple style="width: 200px">
            <?php
            foreach ($data['authors'] as $row) {
                echo '<option value="' . $row['author_id'] . '">
                    ' . $row['author_name'] . '</option>';
            }
            ?>
        </select></div>
    <input type="submit" value="Добави"/>
</form>
<?php
if(isset($data['messages'])) {
    foreach ($data['messages'] as $message) {
        ?>
        <div class='messages'><?= $message ?></div>
    <?php
    }
}


