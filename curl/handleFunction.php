<?php
// $link    = "https://www.nhaccuatui.com/bai-hat/co-gai-ban-ben-boomba-mix-den-ft-lynk-lee.vNVVHavwJufP.html";
// $linkMp3 = getLinkMp3Nhaccuatui($link, $name);
// echo "link:" . $linkMp3 . PHP_EOL;
// echo "name:" . $name . PHP_EOL;
function getLinkMp3Nhaccuatui($url, &$nameMp3)
{
    set_time_limit(0);
    getData($url, $html);
    if (!$html) {
        trigger_error("cannot get html", E_USER_WARNING);
        return false;
    }

    $xmlURL = getXmlUrl($html);
    if (!$xmlURL) {
        trigger_error("cannot get xml URL", E_USER_WARNING);
        return false;
    }

    getData($xmlURL, $xml);
    if (!$xml) {
        trigger_error("cannot get xml", E_USER_WARNING);
        return false;
    }
    $mp3Url  = getMp3Url($xml);
    $nameMp3 = getNameMp3($xml);
    if (!$mp3Url) {
        trigger_error("cannot get mp3 URL", E_USER_WARNING);
        return false;
    }
    return $mp3Url;
}

function getXmlUrl($html)
{
    $result = preg_match('/xmlURL = "(.+)";/', $html, $matches);
    if (!$result) {
        return false;
    }
    return $xmlLink = $matches[1];

}
function getMp3Url($xml)
{
    $pattern = '/<!\[CDATA\[((?:http(?:s){0,1}):\/\/)(.*)\?st/';
    $result  = preg_match($pattern, $xml, $matches);
    if (!$result) {
        return false;
    }
    return $linkMp3 = $matches[1] . $matches[2];
}
function getNameMp3($xml)
{
    $pattern = '/<!\[CDATA\[(.+)]]>/';
    $result  = preg_match($pattern, $xml, $matches);
    if (!$result) {
        return false;
    }
    return $matches[1];
}
function getData($link, &$data = "")
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $link);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36");
    curl_setopt($ch, CURLOPT_REFERER, "https://www.google.com/");
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    $data  = curl_exec($ch);
    $error = curl_error($ch);
    if (empty($error)) {
        return true;
    }
    return false;
}

function downLoadFile($url, $path, $timeOut = 6000)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36");
    curl_setopt($ch, CURLOPT_REFERER, "https://www.google.com/");
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 6000);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    $output = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo $status;
    curl_close($ch);
    if ($status == 200) {
        file_put_contents($path, $output);
        return true;
    }
    return false;
    //down load to browser
    // if ($status == 200) {
    //     header("Content-type: application/octet-stream");
    //     header("Content-Disposition: attachment; filename=audio.mp3");
    //     echo $output;
    //     die();
    // }
}
