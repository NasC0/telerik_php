<?php
mb_internal_encoding('UTF-8');

$connection = mysqli_connect('localhost', 'root', '', 'books');

mysqli_set_charset($connection, 'utf8');