<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>alimama</title>
</head>
<body>
</body>
</html>
<?php
require "lib/http.php";
$http = new \lib\http\Http();

$file = fopen("headfile.txt", "w");
fwrite($file, $http->alimama_get("https://qrlogin.taobao.com/qrcodelogin/generateQRCode4Login.do?from=alimama&appkey=00000000&umid_token=75b514cb5ae5cc161980a0b713defa9e4939ccbc&_ksTS=1559286725495_30&callback="));
fclose($file);

$handle = fopen("headfile.txt", "r");
$contents = fread($handle, filesize("headfile.txt"));
$temp = strstr($contents, "{\"success\"");
fclose($handle);
# token

# end token
# start 二维码
$ewm = "";
$lgtoken = "";
$adtoken = "";
$time = time();
$mic = microtime() * 1000;
if ($temp && file_exists("headfile.txt")) {

    $json = json_decode($temp);
    foreach ($json as $key => $value) {
        switch ($key) {
            case "url":
                $ewm = "https:" . trim($value);
                break;
            case "lgToken":
                $lgtoken = trim($value);
                break;
            case "adToken":
                $adtoken = trim($value);
                break;
        }
    }
}
# end 二维码

$files = fopen("checkdo.txt", "w");
fwrite($files, $http->alimama_get("https://qrlogin.taobao.com/qrcodelogin/qrcodeLoginCheck.do?lgToken=" . $lgtoken . ""));
fclose($files);
$handles = fopen("checkdo.txt", "r");
$context = fread($handles, filesize("checkdo.txt"));

$t = strstr($context, "{\"code\":");
fclose($handles);
$code = "";
if ($t && file_exists("checkdo.txt")) {
    $jsons = json_decode($t);
    foreach ($jsons as $key => $value) {
        switch ($key) {
            case "code":
                $code = $value;
                break;
        }
    }
}
?>

<div>lgtoken:<?php echo $lgtoken; ?></div>
<div>adtoken:<?php echo $adtoken; ?></div>
<img src=<?php echo $ewm; ?>>

<?php
$t_j = "";
set_time_limit(0);
while ($code != "10006") {
    $temp_data = $http->alimama_get("https://qrlogin.taobao.com/qrcodelogin/qrcodeLoginCheck.do?lgToken=" . $lgtoken . "");

    if (ob_get_level() > 0) {
        ob_flush();
    }
    flush();
    ob_start();
    $v = strstr($temp_data, "{\"code\":");
    $t_j = json_decode($v, true);
    var_dump($t_j);
    for ($i = 0; $i < count($t_j); $i++) {
        if ($t_j['code'] == "10006") {
            $files = fopen("url.txt", "w");
            fwrite($files, $t_j['url']);
            fclose($files);
            if (!empty($t_j["url"])) {
                //跳转到login页面点击登录即可登录到阿里妈妈，妈的第二次登录就要再点一次手机验证
                echo "
                <script>
                    window.document.location.href = '".$t_j["url"]."';
                </script>";

                ob_end_flush();
                    $http->get_http("https://pub.alimama.com/promo/search/index.htm");
                exit();
            }
        }
    }
    sleep(5);
}

?>


