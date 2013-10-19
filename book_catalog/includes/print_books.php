<ul id="nav">
    <?php
    foreach ($resultArray as $key => $val) {
        ?>
        <li class="wrap">
            <span><?= $val['book_title'] ?></span>
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
            </ul>
        </li>

    <?php
    }

    ?>
</ul>