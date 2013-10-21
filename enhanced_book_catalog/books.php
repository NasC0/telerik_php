<?php
$pageTitle = "Книги";
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (isset($_GET['bookID'])) {
    $bookID = (int)$_GET['bookID'];

    $query = 'SELECT books.book_id, books.book_title, authors.author_id, authors.author_name FROM books
              LEFT JOIN books_authors ON books.book_id = books_authors.book_id
              LEFT JOIN authors ON books_authors.author_id = authors.author_id
              WHERE books.book_id = "' . $bookID . '"';
    $result = mysqli_query($connection, $query);

    $resultArray = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $resultArray[$row['book_id']]['book_title'] = $row['book_title'];
            $resultArray[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
        }
    }

    $query = 'SELECT messages.msg_id, messages.msg_body, messages.msg_datetime, users.user_id, users.username FROM books
              LEFT JOIN books_messages ON books.book_id = books_messages.book_id
              LEFT JOIN messages ON books_messages.msg_id = messages.msg_id
              LEFT JOIN users_messages ON messages.msg_id = users_messages.msg_id
              LEFT JOIN users ON users_messages.user_id = users.user_id
              WHERE books.book_id = ' . $bookID . '
              ORDER BY messages.msg_datetime DESC';

    $messages = mysqli_query($connection, $query);
}
else {
    echo 'Не сте избрали книга!';
}

if (isset($_GET['bookID'])) {
    if (mysqli_num_rows($result) > 0) {

        ?>
        <ul id="nav">
            <li class="wrap">
                <a href="books.php?bookID=<?= $bookID ?>"><?= $resultArray[$bookID]['book_title'] ?></a>
                <ul>
                    <li>
                        <div>Автори:</div>
                        <div class="innerWrap">
                            <?php
                            foreach ($resultArray[$bookID]['authors'] as $keyAuthor => $valAuthor) {
                                ?>
                                <a href="authors_books.php?id=<?= $keyAuthor ?>"><?= $valAuthor ?></a>
                            <?php
                            }

                            ?>
                        </div>
                    </li>
                    <li>
                        <div>Коментари:</div>
                        <?php
                        while ($row = mysqli_fetch_assoc($messages)) {
                            if ($row['msg_body']) {
                                $date = strtotime($row['msg_datetime']);
                                $date = date("d.m.Y H:i:s", $date);
                                ?>
                                <div class="messageWrap">
                                    <div>Добавен от <a
                                            href="user_messages.php?userID=<?= $row['user_id'] ?>"><?= $row['username'] ?></a>
                                        на <?= $date ?>
                                    </div>
                                    <div><?= $row['msg_body'] ?></div>
                                </div>

                            <?php
                            }
                            else {
                                echo 'Няма коментари за тази книга';
                            }
                        }
                        ?>
                    </li>
                    <?php
                    ?>
                </ul>
            </li>
        </ul>
        <?php


        if (isset($_SESSION['isLogged'])) {

            if (isset($_POST['comment'])) {
                $message = mysqli_real_escape_string($connection, trim($_POST['message']));

                $query = 'INSERT INTO messages
                  (msg_body, msg_datetime)
                  VALUES("' . $message . '", NOW())';
                $insertResult = mysqli_query($connection, $query);
                if ($insertResult) {
                    $msgID = mysqli_insert_id($connection);

                    $query = 'INSERT INTO books_messages
                      (book_id, msg_id)
                      VALUES(' . $bookID . ', ' . $msgID . ')';
                    $booksRelation = mysqli_query($connection, $query);

                    $query = 'INSERT INTO users_messages
                      (user_id, msg_id)
                      VALUES(' . $_SESSION['userID'] . ', ' . $msgID . ')';
                    $usersRelation = mysqli_query($connection, $query);

                    if ($booksRelation && $usersRelation) {
                        $query = 'UPDATE BOOKS
                                  SET msg_count = msg_count + 1
                                  WHERE book_id = ' . $bookID;
                        mysqli_query($connection, $query);
                        header("Location: books.php?bookID=" . $bookID);
                        exit;
                    }
                }
                else {
                    echo 'Възникнва проблем при добяването на съобщението!';
                }
            }

            ?>
            <form method="POST" name="addComment">
                Съобщение:
                <div><textarea rows="4" cols="50" name="message"></textarea></div>
                <div><input type="submit" name="comment" value="Коментирай"></div>
            </form>
        <?php

        }
    }
    else {
        echo 'Няма намерени резултати за тази книга!';
    }
}

include 'includes' . DIRECTORY_SEPARATOR . 'footer.php';