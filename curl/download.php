<?php
require_once 'handleFunction.php';
$link = $_GET['url'] ?? null;

if ($link) {
    $linkMp3 = getLinkMp3Nhaccuatui($link, $name);
    echo "name: " . $name . PHP_EOL;
    echo 'star download' . PHP_EOL;
    $path = dirname(__FILE__) . "/download/" . $name . ".mp3";
    if (file_exists($path)) {
        echo "file exits";
    } else {
        $result = downLoadFile($linkMp3, $path);
        echo $result;
        if ($result) {

            echo "download complete" . PHP_EOL;
        } else {
            echo "download fail" . PHP_EOL;
        }
    }
}
