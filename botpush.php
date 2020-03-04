<?php



require "vendor/autoload.php";

$access_token = 'FE+CLdBTuNluI/QANL93WgHGdOZca4365tHws29scdRnURdNOan0nbr0jlCMNHpDNLhM+yqJfGNfFNmw/Lvhity7gBevds7ggM5DFyIZggl0GtxxW2SDOHsLJ5xMacBkIqmxh59nidTzm62x4sKFNgdB04t89/1O/w1cDnyilFU=';

$channelSecret = '5d9bf6b36f97338fbf2b5a437c3c304b';

$pushID = 'Ud6d104d63ceca3e1cc6c988620be38b8';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();


?>