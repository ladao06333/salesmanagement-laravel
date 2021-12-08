<?php
ini_set('display_errors', 1); // 2 dong này de show lỗi trong file apache log
error_reporting(E_ALL); // 2 dong này de show lỗi trong file apache  log

$from = "narutonewgen@gmail.com";
$to = "nguyenlongqb052113@gmail.com";
$subject = "Checking send mail PHP";
$message = "PHP mail works just fine";
$headers = "From:" . $from;
if (mail($to, $subject, $message, $headers)) {
    echo "The email message was sent.";
} else {
    echo "error send mail";
}
