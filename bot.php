<?php
require_once 'methods.php';
require_once 'config.php';
require 'jdf.php';
date_default_timezone_set("Asia/tehran");
//end require
$data=json_decode(file_get_contents("php://input"));
$fullMessage=$data->message; //get fullmesage

//Check User is admin
if($fullMessage->from->id!=admin){
    SendMessage($fullMessage->from->id,"شما مدیر نیستید! دسترسی برای شما محدود شده !");

}

//end Check


//----------------------------------------------------------------------------------------------------------
    $priceList=getPriceList();
    $now=jdate('y/m/d    H:i:s');
    $data="نرخ ارز و طلا به تاریخ امروز   :$now 📅\n
🔺دلار در بازار آزاد⬅️{$priceList["dolor"]} ریال \n
🔺یورو در بازار آزاد⬅️{$priceList["euro"]}  ریال \n
🔸انس طلا⬅️{$priceList["ons"]}ریال\n
🔷مثقال طلا⬅️{$priceList["mesghal"]}ریال \n
🔸طلا 18⬅️{$priceList["gold18"]} ریال \n
";
    $data.="@ircurn  \t 🔶";
    editMessage('2',$data,channels[1]);

