<?php
header('Content-Type:application/json; charset=utf-8');
require 'Meting.php';
use Metowolf\Meting;
$api = new Meting($_GET['server']);
// echo gettype($api);

switch ($_GET['type']){
    case 'playlist':
        $raw = $api->format(true)->playlist($_GET['id']);
        // exit(json_encode($data));
        // echo $raw;
        $raw = json_decode($raw, true);//gettype可以发现不加true会返回object，https://www.php.net/manual/zh/function.json-decode.php
        $title = array_column($raw, 'name');
        // echo json_encode($title, JSON_UNESCAPED_UNICODE);
        $author = array_column($raw, 'artist');
        $url_id = array_column($raw, 'url_id');
        $pic_id = array_column($raw, 'pic_id');
        $lyric_id = array_column($raw, 'lyric_id');

        $data = array_map(function($title, $author, $url_id, $pic_id, $lyric_id){
            // $api = new Meting($_GET['server']);
            return array('title' => $title,
                                'author' => implode(" / ", $author),
                                'url' => "https://meting.v2beach.cn/api/index?server=netease&type=url&id=" . ($url_id),
                                'pic' => "https://meting.v2beach.cn/api/index?server=netease&type=pic&id=" . ($pic_id),
                                'lrc' => "https://meting.v2beach.cn/api/index?server=netease&type=lyric&id=" . ($lyric_id));
        }, $title, $author, $url_id, $pic_id, $lyric_id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    break;
    case 'url':
        $raw = $api->format(true)->url($_GET['id']);
        $data = json_decode($raw, true);
        $data = $data['url'];
        Header("Location:$data"); 
    break;
    case 'pic':
        $raw = $api->format(true)->pic($_GET['id']);
        $data = json_decode($raw, true);
        $data = $data['url'];
        // echo curl_file_get_contents($data);
        // echo file_get_contents($data);
        Header("Location:$data"); 
    break;
    case 'lyric':
        $raw = $api->format(true)->lyric($_GET['id']);
        $data = json_decode($raw, true);
        $data = $data['lyric'];
        echo $data;
    break;
}


// foreach ($raw as $key => $value){
//     echo $key;
//     echo "\n===\n";
//     echo json_encode($value);
//     echo "\n===\n";
//     echo $value['name'];
//     echo "\n===\n";
// }

// $fmt = array(
//     'title' => $raw[0]['name'],
//     'author' => $raw[0]['artist'],
// );
// echo json_encode($fmt, JSON_UNESCAPED_UNICODE);//JSON_UNESCAPED_UNICODE中文不变/u的UNICODE

// $data = $api->format(true)->url(553534151);
// // echo $data['url'];
// echo $data;
// echo "\n";
// $data = $api->format(false)->url(553534151);
// echo $data;

// require 'vendor/autoload.php';

// Initialize to netease API
// $api = new Meting('netease');

// Use custom cookie (option)
// $api->cookie('paste your cookie');

// Get data
// $data = $api->format(true)->search('Soldier', [
//     'page' => 1,
//     'limit' => 50
// ]);

// echo $data;
// [{"id":35847388,"name":"Hello","artist":["Adele"],"album":"Hello","pic_id":"1407374890649284","url_id":35847388,"lyric_id":35847388,"source":"netease"},{"id":33211676,"name":"Hello","artist":["OMFG"],"album":"Hello",...

// Parse link
// $data = $api->format(true)->url(35847388);

// echo $data;
// {"url":"http:\/\/...","size":4729252,"br":128}

//不需要这个，只需要URL跳转
function curl_file_get_contents($durl){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $durl);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回    
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回    
    $r = curl_exec($ch);  
    curl_close($ch);  
    return $r;  
} 

?>
