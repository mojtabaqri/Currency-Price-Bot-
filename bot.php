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
    $priceList=getDolorPrice();;
    $data="🟢 هم اکنون قیمت دلار آزاد \n "."در تاریخ: ".jdate('y/m/d    H:i:s')."\n";
    $data.=$priceList."ریال میباشد "."\n";
    $data.="@myChannel \t 🔶";
    sendMessage(channels[1],$data);


