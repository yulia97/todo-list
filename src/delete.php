<?php

$filename = "../static/list.json";//путь к файлу
$data = file_get_contents( $filename );//считали
$jdata = json_decode($data, true);//раскодировали json

$id = $_GET["del"]; //получаем из query params id

for($i = 0; $i < count($jdata["data"]); $i++){ // ищем запись с нужным id
    if ($jdata["data"][$i]["id"] == $id){
	unset($jdata["data"][$i]);//удалили запись
	$jdata["data"] = array_values($jdata["data"]);//номализовали массив
	break;
    }
}

file_put_contents($filename, json_encode($jdata));//записываем файл обратно

?>
