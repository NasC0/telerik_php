<?php
session_start();

// Credits to the StackOverflow community for the resources
// http://stackoverflow.com/questions/12094080/download-files-from-server-php
// http://stackoverflow.com/questions/10615797/utility-of-http-header-content-type-application-force-download-for-mobile
// Both very helpful and informative

$file = $_GET['file'];
$file = 'database' . DIRECTORY_SEPARATOR . $_SESSION['username'] . DIRECTORY_SEPARATOR . $file;

header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=" .basename($file));
header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: binary");
readfile($file);