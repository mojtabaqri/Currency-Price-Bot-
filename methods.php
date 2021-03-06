<?php
require_once 'config.php';
require 'simple_html_dom.php';
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . apiKey . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datas));
    $res = curl_exec($ch);
    if (curl_error($ch))
    {
        var_dump(curl_error($ch));
    }
    else
    {
        return json_decode($res);
    }
}


function connect($url,$jsonResponse=false){
    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
    );
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $url);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, $headers);
    $body = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    $jsonArrayResponse = json_decode($body);
    return $jsonArrayResponse;
}

function getPriceList(){
    $priceList=[
        'dolor'=>'%nan%',
        'ons'=>'%nan%',
        'gold18'=>'%nan%',
        'seke'=>'%nan%',
        'mesghal'=>'%nan%',
        'euro'=>'%nan%',
    ];
    $html=file_get_html("http://www.tgju.org");
    foreach ($html->find('#l-price_dollar_rl > .info-value >.info-price') as $e)
    {
        $priceList['dolor']=$e->innertext;
    }
    foreach ($html->find('#l-ons > .info-value >.info-price') as $e)
    {
        $priceList['ons']=$e->innertext;
    }
    foreach ($html->find('#l-geram18 > .info-value >.info-price') as $e)
    {
        $priceList['gold18']=$e->innertext;
    }
    foreach ($html->find('#l-irec_future > .info-value >.info-price') as $e)
    {
        $priceList['seke']=$e->innertext;
    }
    foreach ($html->find('#l-mesghal > .info-value >.info-price') as $e)
    {
        $priceList['mesghal']=$e->innertext;
    }
    foreach ($html->find('#l-price_eur > .info-value >.info-price') as $e)
    {
        $priceList['euro']=$e->innertext;
    }
    return $priceList;
}

//-----------------------------------------methods-------------------------------------------------------------

function sendMessage($chat_id, $text){
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>$text,
        'parse_mode'=>'MarkDown']);
}
function editMessage($messageId, $text,$chatId){
    bot('editMessageText',[
        'text'=>$text,
        'chat_id'=>$chatId,
        'message_id'=>$messageId,
        'parse_mode'=>'MarkDown']);
}

function sendphoto($chat_id, $photo, $captionl){
    bot('sendphoto',[
        'chat_id'=>$chat_id,
        'photo'=>$photo,
        'caption'=>$captionl,
    ]);
}
function sendaudio($chat_id, $audio, $caption, $title ,$performer){
    bot('sendaudio',[
        'chat_id'=>$chat_id,
        'audio'=>$audio,
        'caption'=>$caption,
        'title'=>$title,
        'performer'=>$performer
    ]);
}
function sendDocument($chat_id, $document, $caption=null){
    bot('senddocument',[
        'chat_id'=>$chat_id,
        'document'=>$document,
        'caption'=>$caption
    ]);
}

function sendvideo($chat_id, $video, $caption){
    bot('sendvideo',[
        'chat_id'=>$chat_id,
        'video'=>$video,
        'caption'=>$caption
    ]);
}
function sendvoice($chat_id, $voice, $caption){
    bot('sendvoice',[
        'chat_id'=>$chat_id,
        'voice'=>$voice,
        'caption'=>$caption
    ]);
}
