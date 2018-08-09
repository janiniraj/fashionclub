<?php

$to = "mari.anjeli@malaysia-innovation.com";
$header = "From: mari.lubrica@gmail.com";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";

$mailcopyfile = "/home/webuser/helloworld/htdocs/mailcopy.txt";



if (mail($to, $subject, $body, $header)) {
echo("<p>Message successfully sent!</p>");
} else {
echo("<p>Message delivery failed...</p>");
}

$fp = fopen($mailcopyfile, "a"); 
fputs($fp, $to . " ". $subject. "\n" . $body . "\n" );
fclose($fp);

?>