<?php

//echo $_POST["title"];
//echo $_POST["text"];

$filename = "../static/list.json";
$data = file_get_contents( $filename );
$jdata = json_decode($data, true);



for($i = 0; $i < count($jdata['data']); $i++){
    if ($jdata['data'][$i]["id"] == $_POST["id"]){
       	$jdata['data'][$i]["text"] = $_POST["text"]; 
       	$jdata['data'][$i]["title"] = $_POST["title"];
	echo $jdata['data'][$i]["id"];
	file_put_contents($filename, json_encode($jdata));

	break;
    }
}




?>
