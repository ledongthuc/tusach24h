<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://news.zing.vn/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');

$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
echo $output;
?>