<?php
$pageTitle = 'Съобщения';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (isset($_GET['userID'])) {
    $userID = (int)$_GET['userID'];

    $query = 'SELECT books.book_id, books.book_title, messages.msg_id, messages.msg_body, messages.msg_datetime, users.user_id, users.username FROM books
              LEFT JOIN books_messages ON books.book_id = books_messages.book_id
              LEFT JOIN messages ON books_messages.msg_id = messages.msg_id
              LEFT JOIN users_messages ON messages.msg_id = users_messages.msg_id
              LEFT JOIN users ON users_messages.user_id = users.user_id
              WHERE users.user_id = ' . $userID . '
              ORDER BY msg_datetime DESC';

    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $username = '';
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];
            mysqli_data_seek($result, 0);
            unset($row);

            ?>
            <ul id="nav">
                <li class="wrap">
                    <div id="comments">Коментари на потребител <?= $username ?></div>
                    <ul>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $date = strtotime($row['msg_datetime']);
                            $date = date("d.m.Y H:i:s", $date);
                            ?>
                            <div class="messageWrap">
                                <div>Добавен на <?= $date ?> за <a style="color: #004276;"
                                                                   href="books.php?bookID= <?= $row['book_id'] ?>"><?= $row['book_title'] ?></a>
                                </div>
                                <div><?= $row['msg_body'] ?></div>
                            </div>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        <?php
        }
        else {
            echo 'Потребителята няма побликувани коментари!';
        }
    }
}

include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';

