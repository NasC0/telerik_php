<a href="authors.php">Автори</a>
<a href="add_book.php">Нова книга</a>
<table border="1">
    <thead>
    <tr>
        <td>Книга</td>
        <td>Автори</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($data['books'] as $book) {
        ?>
        <tr>
            <td><?= $book['book_title']; ?></td>
            <td>
                <?php
                $authorArray = array();
                foreach ($book['authors'] as $authorKey => $authorVal) {
                    $authorArray[] = '<a href="index.php?author_id='. $authorKey .'">'. $authorVal .'</a>';
                }
                echo implode(', ', $authorArray);
                ?>
            </td>
        </tr>
        <?php

    }

    ?>
    </tbody>
</table>