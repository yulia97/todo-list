<?php

//echo $_POST["title"];
//echo $_POST["text"];

$filename = "../static/list.json";//путь
$data = file_get_contents( $filename );//считали
$jdata = json_decode($data, true);//раскодировали json

for($i = 0; $i < count($jdata['data']); $i++){//ищем нужную запись и перезаписали ее параметры 
    if ($jdata['data'][$i]["id"] == $_POST["id"]){
       	$jdata['data'][$i]["text"] = $_POST["text"];
       	$jdata['data'][$i]["title"] = $_POST["title"];
	echo $jdata['data'][$i]["id"];
	file_put_contents($filename, json_encode($jdata));//записали обратно в файл

	break;
    }
}




?>
