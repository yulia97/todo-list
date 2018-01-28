<?php

$filename = "../static/list.json";
$data = file_get_contents( $filename );
$jdata = json_decode($data, true);

$id = $_GET["del"];

for($i = 0; $i < count($jdata["data"]); $i++){
    if ($jdata["data"][$i]["id"] == $id){
	unset($jdata["data"][$i]);
	$jdata["data"] = array_values($jdata["data"]);
	break;
    }
}

file_put_contents($filename, json_encode($jdata));

?>
