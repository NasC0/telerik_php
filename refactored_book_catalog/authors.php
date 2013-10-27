<?php
$data['title'] = 'Автори';
include './inc/functions.php';
include './inc/config.php';

if ($_POST) {
    $author_name = trim($_POST['author_name']);
    if (mb_strlen($author_name) < 2) {
        $data['error'][] = 'Невалидно име';
    }
    else {
        $author_esc = mysqli_real_escape_string($connection, $author_name);
        $q = mysqli_query($connection, 'SELECT * FROM authors WHERE
        author_name="' . $author_esc . '"');
        if (mysqli_error($connection)) {
            $data['error'][] = 'Грешка при заявката към базата';
        }

        if (mysqli_num_rows($q) > 0) {
            $data['error'][] = 'Този автор вече съществува';
        }
        else {
            mysqli_query($connection, 'INSERT INTO authors (author_name)
            VALUES("' . $author_esc . '")');
            if (mysqli_error($connection)) {
                $data['messages'][] = 'Неуспешен запис';
            }
            else {
                $data['messages'][] = 'Успешен запис';
            }
        }
    }
}

$data['authors'] = getAuthors($connection);

if ($data['authors'] === false) {
    $data['error'] = 'Грешка';
}

$data['content'] = './templates/authors_template.php';
render($data, './templates/layouts/default_layout.php');
 
