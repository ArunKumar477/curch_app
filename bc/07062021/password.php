
<?php
$url = 'https://www.md5online.org/api.php';
$key = 'YOUR_VIP_KEY';

//manage your input here, from a form, a file or a database
$md5 = "cc03e747a6afbbcbf8be7668acfebee5";

$result = file_get_contents($url."?p=".$key."&h=".$md5);

//do your post action here, with the result
echo $result;
?>