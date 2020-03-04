<?php
require "vendor/autoload.php";
require_once ('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$API_URL = 'https://api.line.me/v2/bot/message/reply'; 
$ACCESS_TOKEN = 'FE+CLdBTuNluI/QANL93WgHGdOZca4365tHws29scdRnURdNOan0nbr0jlCMNHpDNLhM+yqJfGNfFNmw/Lvhity7gBevds7ggM5DFyIZggl0GtxxW2SDOHsLJ5xMacBkIqmxh59nidTzm62x4sKFNgdB04t89/1O/w1cDnyilFU=';
$CHANNEL_SECRET ='5d9bf6b36f97338fbf2b5a437c3c304b';

$POST_HEADER = array('Content-Type: applition/json','Authorization: Bearer'.$ACCESS_TOKEN);
$request = file_get_contents('php://input');
$request_array = json_decode($request,true);
file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);


if ( sizeof($request_array['events']) > 0 ) {
    foreach ($request_array['events'] as $event) {
    
    $reply_message = 'test';
    $reply_token = $event['replyToken'];
    $data = [
       'replyToken' => $reply_token,
       'messages' => [
          ['type' => 'text', 
           'text' => json_encode($request_array)]
       ]
    ];
    $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
    $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
    echo "Result: ".$send_result."\r\n";
 }
}
echo "OK";

function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
?>
