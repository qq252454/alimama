<?php
require "lib/http.php";
$handle = fopen("url.txt", "r");
$u = fread($handle, filesize("url.txt"));
fclose($handle);
$http = new \lib\http\alimama_Http();
$http->alimama_get($u);
echo "登陆成功！";
