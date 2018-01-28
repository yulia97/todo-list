<?php

//echo $_POST["title"];
//echo $_POST["text"];

$filename = "../static/list.json";
$data = file_get_contents( $filename );
$jdata = json_decode($data, true);

$newIndex = $jdata["lastId"]++;

$jdata["data"][] = array("id" => $newIndex,
			 "text"=>$_POST["text"],
			 "title"=>$_POST["title"]);



file_put_contents($filename, json_encode($jdata));

echo $newIndex;
?>
