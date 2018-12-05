<?php
//call data with ajax
require_once 'handleFunction.php';
$link = $_GET['url'] ?? null;
if ($link == null) {
    echo '<p class="error text-danger">Moi ban nhap link</p>' . PHP_EOL;
    die();
}
$linkMp3 = getLinkMp3Nhaccuatui($link, $name);
echo '<p class="name-mp3 p-1 mb-2 bg-success text-white text-center">name: ' . $name . '</p>';
echo '<audio class="play-mp3" src="' . $linkMp3 . '" controls></audio>';
