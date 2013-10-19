<ul id="nav">
    <?php
    foreach ($resultArray as $key => $val) {
        ?>
        <li class="wrap">
            <a href="books.php?bookID=<?= $key ?>"><?= $val['book_title'] ?></a>
            <ul <?= $class ?>>
                <li>
                    <div>Автори:</div>
                    <div class="innerWrap">
                        <?php
                        foreach ($val['authors'] as $keyAuthor => $valAuthor) {
                            ?>
                            <a href="authors_books.php?id=<?= $keyAuthor ?>"><?= $valAuthor ?></a>
                        <?php
                        }

                        ?>
                    </div>
                </li>
                <li>
                    <div>Коментари: <?= $val['messageCount'] ?></div>
                </li>
            </ul>
        </li>

    <?php
    }

    ?>
</ul>