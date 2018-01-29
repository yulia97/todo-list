<?php

//echo $_POST["title"];
//echo $_POST["text"];

$filename = "../static/list.json";//путь
$data = file_get_contents( $filename );//считали
$jdata = json_decode($data, true);//раскодировали json

$newIndex = $jdata["lastId"]++;//создадин новый id больше максимального на 1

$jdata["data"][] = array("id" => $newIndex,//создаем новую запись
			 "text"=>$_POST["text"],//передаем с помощью post
			 "title"=>$_POST["title"]);



file_put_contents($filename, json_encode($jdata));//записываем все обратно

echo $newIndex;//вернули пользователю id добавленой записи
?>
