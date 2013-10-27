<?php
include 'inc' . DIRECTORY_SEPARATOR . 'functions.php';
include 'inc' . DIRECTORY_SEPARATOR . 'config.php';

$data = array();
$data['title'] = 'Добави Книга';
$data['authors'] = getAuthors($connection);

if ($data['authors'] === false) {
    $data['errors'][] = true;
}

if ($_POST) {
    $book_name = trim($_POST['book_name']);
    if (!isset($_POST['authors'])) {
        $_POST['authors'] = '';
    }
    $authors = $_POST['authors'];
    echo '<pre>' . print_r($authors, true) . '</pre>';
    if (mb_strlen($book_name) < 2) {
        $data['errors'][]='Името не трябва да е по-късо от 2 символа!';
    }
    if (!is_array($authors) || count($authors) == 0) {
        $data['errors'][]='Моля изберете поне един автор!';
    }
    if (!isAuthorIdExists($connection, $authors)) {
        $data['errors'][]='Не съшествуват тези автори!';
    }

    if(isset($data['errors']) && $data['errors'] > 0) {
        $data['messages'][]='Книгата не е добавена';
    }
    else {
        mysqli_query($connection, 'INSERT INTO books (book_title) VALUES("' .
            mysqli_real_escape_string($connection, $book_name) . '")');
        if (mysqli_error($connection)) {
            $data['messages'] = 'Книгата не е добавена';
        }
        $id = mysqli_insert_id($connection);
        foreach ($authors as $authorId) {
            mysqli_query($connection, 'INSERT INTO books_authors (book_id,author_id)
                VALUES (' . $id . ',' . $authorId . ')');
            if (mysqli_error($connection)) {
                $data['messages'] = 'Книгата не е добавена';
            }
        }
        $data['messages'][]='Книгата е добавена';
    }
}

$data['content'] = './templates/add_book_template.php';
render($data, './templates/layouts/default_layout.php');