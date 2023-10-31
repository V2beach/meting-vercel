<?php

require 'vendor/autoload.php';
// require 'Meting.php';

use Metowolf\Meting;

// Initialize to netease API
$api = new Meting('netease');

// Use custom cookie (option)
// $api->cookie('paste your cookie');

// Get data
$data = $api->format(true)->search('Soldier', [
    'page' => 1,
    'limit' => 50
]);

echo $data;
// [{"id":35847388,"name":"Hello","artist":["Adele"],"album":"Hello","pic_id":"1407374890649284","url_id":35847388,"lyric_id":35847388,"source":"netease"},{"id":33211676,"name":"Hello","artist":["OMFG"],"album":"Hello",...

// Parse link
$data = $api->format(true)->url(35847388);

echo $data;
// {"url":"http:\/\/...","size":4729252,"br":128}