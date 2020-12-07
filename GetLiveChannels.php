<?php

$url = "domain.com";
$port = 1234;
$protocol = "http";


$pls_header = "#EXTM3U";

$json = json_decode(file_get_contents("{$protocol}://{$url}:{$port}/panel_api.php?username={$_GET['username']}&password={$_GET['password']}"), true);
$link = "{$protocol}://{$json['server_info']['url']}:{$json['server_info']['port']}";

if(!isset($_GET['type']) || empty($_GET['type'])){
	$extension = 'ts';
}else{
	$extension = $_GET['type'];
}

$playlist = [[]];
$i = 0;
$id = 1;

foreach ($json['available_channels'] as $channel) {
	$playlist[$i]['name'] = "#EXTINF:0 channel-id=\"{$id}\" tvg-id=\"{$channel['name']}\" tvg-logo=\"{$channel['stream_icon']}\" channel-id=\"{$channel['name']}\" group-title=\"{$channel['category_name']}|{$channel['stream_type']}\",{$channel['name']}";
	$playlist[$i]['url'] = $link."/{$channel['stream_type']}/{$json['user_info']['username']}/{$json['user_info']['password']}/".$channel['stream_id'].".".$extension;
	$id++;
	$i++;
}

$playlist_final = $pls_header."\n";
foreach($playlist as $line){
	$playlist_final .= "{$line['name']}\n"."{$line['url']}\n";
}

header("Content-type: text/plain");
header("Content-Disposition: attachment; filename={$_GET['name']}");
echo $playlist_final;
